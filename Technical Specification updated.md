# Technical Implementation Specification
## Logistics Forwarding Platform + In-House Store (Laravel 11)

---

## 1. Project Overview

A B2C logistics forwarding platform **with an integrated in-house product store**
enabling customers to:

- Submit "Shop For Me" requests (staff-purchased products shipped to warehouse)
- Send their own parcels to company warehouses using a personal Suite ID
- **Browse and order in-house products sold directly by the company**
- Track parcels and shipments through an internal status system
- Receive manual quotes, invoices, and pay via SSLCommerz or bank transfer

Operations are **fully staff-driven** — no carrier API integrations. Staff manage all
quoting, parcel intake, shipment creation, product fulfillment, and invoicing through
a Filament admin panel.

Target market: Bangladesh-based customers importing from USA, UK, Malaysia, and other
origins — plus purchasing directly from the company's own product catalog.

---

## 2. Finalized Tech Stack

| Layer              | Technology                        |
|--------------------|-----------------------------------|
| Backend Framework  | Laravel 11                        |
| Frontend           | Laravel Blade + Alpine.js         |
| CSS Framework      | Tailwind CSS                      |
| Admin Panel        | Filament v3                       |
| Authentication     | Laravel Breeze                    |
| Database           | MySQL 8.x                         |
| Queue Driver       | Redis (or database for MVP)       |
| Scheduler          | Laravel Scheduler (Cron)          |
| Payments           | SSLCommerz + Manual Bank Transfer |
| Notifications      | Laravel Notifications (Mail + SMS)|
| SMS Provider       | Configured BD SMS gateway         |
| Role Permissions   | spatie/laravel-permission         |
| File Storage       | Laravel local disk (public)       |
| Web Server         | Nginx + PHP-FPM                   |
| Deployment         | VPS (Ubuntu)                      |

---

## 3. System Architecture & Data Flow
```
Internet
   │
   ▼
Nginx (reverse proxy)
   │
   ▼
Laravel 11 Application
   │
   ├── Web Routes (Blade + Alpine.js)
   │     ├── Customer Dashboard
   │     ├── Order / Parcel / Tracking views
   │     ├── Invoice & Payment pages
   │     └── [NEW] Product Store (catalog, cart, product orders)
   │
   ├── Filament Admin Routes (/admin)
   │     ├── Order Management (Shop For Me)
   │     ├── Parcel Intake
   │     ├── Shipment Builder
   │     ├── Invoice Generator
   │     ├── [NEW] Product Catalog Management
   │     ├── [NEW] Product Order Fulfillment
   │     └── CMS (Warehouses, Modes, Statuses)
   │
   ├── Business Logic Layer
   │     ├── Services/
   │     │     ├── OrderService.php         (Shop For Me)
   │     │     ├── ShipmentService.php
   │     │     ├── PricingService.php
   │     │     ├── StorageFeeService.php
   │     │     └── [NEW] ProductOrderService.php
   │     ├── Actions/
   │     │     ├── CreateShipment.php
   │     │     ├── SendQuote.php
   │     │     ├── GenerateInvoice.php
   │     │     └── [NEW] FulfillProductOrder.php
   │     └── Repositories/
   │           ├── OrderRepository.php
   │           ├── ParcelRepository.php
   │           └── [NEW] ProductRepository.php
   │
   ├── Queue Workers (Redis)
   │     ├── SendQuoteEmailJob
   │     ├── SendSMSNotificationJob
   │     ├── CalculateStorageFeesJob
   │     ├── SendInvoiceNotificationJob
   │     ├── ProcessPaymentWebhookJob
   │     └── [NEW] SendProductOrderNotificationJob
   │
   └── Laravel Scheduler (Daily)
         └── StorageFeeCalculationJob

   │
   ▼
MySQL Database
   │
   ▼
Local File Storage
/storage/app/public
   ├── /users
   ├── /parcels
   ├── /invoices
   ├── /products          ← [NEW]
   └── /product-orders    ← [NEW]
```

### Key Data Flows

**In-House Product Order Flow:**
```
Customer browses product catalog (public or authenticated)
  → Adds products to cart (Alpine.js, session-based)
  → Places order → ProductOrderService::create()
  → Invoice auto-generated (product cost + delivery fee)
  → Notification: "Order Received" (email + SMS)
  → Customer pays via SSLCommerz or bank transfer
     OR chooses to combine with existing shipping invoice
  → Staff sees order in Filament → fulfills manually
  → FulfillProductOrder Action → updates status
  → Notification: "Order Dispatched" / "Order Delivered"
```

**Combined Payment Flow (Product + Shipping):**
```
Customer has unpaid shipping invoice + new product order
  → At checkout, customer can select "Add to existing invoice"
  → ProductOrderService appends product line items to shipment invoice
  → Single payment covers both
  → On payment confirmation: both order + shipment marked paid
```

**Shop For Me Flow:**
```
Customer submits order (URLs + notes)
  → OrderService::create()
  → Notification: "Order Received" (email + SMS)
  → Staff reviews in Filament → fills quoted_price
  → SendQuote Action → Notification: "Quote Sent"
  → Customer approves in dashboard
  → Staff marks "Order Purchased"
  → Product ships to warehouse → Staff creates Parcel entry
  → Parcel linked to user via Suite ID
```

**Ship For Me Flow:**
```
Customer ships parcel to warehouse (includes Suite ID on package)
  → Staff records parcel in Filament (weight, dims, photos)
  → Parcel.storage_started_at = arrival_date
  → Notification: "Parcel Arrived"
  → Daily scheduler checks storage age → applies fees after 10 days
  → Staff creates Shipment, attaches Parcels
  → PricingService calculates chargeable weight
  → Invoice generated → Customer pays → Status updated
```

**Tracking Flow:**
```
Customer enters tracking_number or shipment_number or product_order_number
  → TrackingController queries status_logs table
  → Returns ordered timeline of status events
  → Rendered as visual timeline in Blade view
```

---

## 4. Database Schema

### Existing Tables (unchanged)
- `users` — `id, name, email, phone, password, warehouse_suite_id, role, status`
- `orders` — Shop For Me orders
- `order_items` — Product URLs per order
- `parcels` — Warehouse parcel records
- `parcel_photos`
- `shipments`
- `shipment_parcels`
- `invoices` — now shared between shipments AND product orders
- `invoice_items`
- `status_logs`
- `warehouses`, `shipping_modes`
- `tickets`, `ticket_messages`

### New Tables for In-House Store
```sql
-- Product categories
product_categories
  id
  name
  slug
  description
  is_active
  created_at

-- Product catalog
products
  id
  product_category_id  (FK)
  name
  slug
  description
  price                 (BDT, base price)
  sku
  images                (JSON array of file paths)
  is_active
  sort_order
  created_at
  updated_at

-- Customer product orders (separate from Shop-For-Me orders)
product_orders
  id
  user_id               (FK)
  invoice_id            (FK, nullable — set when invoice generated)
  product_order_number  (e.g. PO-BD-000012)
  status                (Pending Payment → Confirmed → Processing → Dispatched → Delivered → Cancelled)
  delivery_address      (JSON — name, phone, address, city, postcode)
  delivery_fee          (decimal)
  subtotal              (decimal)
  total_amount          (decimal)
  notes
  created_at
  updated_at

-- Line items within a product order
product_order_items
  id
  product_order_id      (FK)
  product_id            (FK)
  product_name          (snapshot at time of order)
  unit_price            (snapshot at time of order)
  quantity
  subtotal
```

### Modified Tables
```sql
-- invoices: add nullable FK to support both shipment and product order invoices
invoices
  id
  user_id
  shipment_id           (FK, nullable)
  product_order_id      (FK, nullable)   ← NEW
  invoice_number
  invoice_type          (shipment | product_order | combined)  ← NEW
  status
  total_amount
  payment_method
  payment_status
  created_at
```

---

## 5. File Structure
```
app/
├── Actions/
│   ├── CreateShipment.php
│   ├── GenerateInvoice.php
│   ├── SendQuote.php
│   ├── ApproveQuote.php
│   └── FulfillProductOrder.php          ← NEW
│
├── Filament/
│   └── Resources/
│       ├── OrderResource.php
│       ├── ParcelResource.php
│       ├── ShipmentResource.php
│       ├── InvoiceResource.php
│       ├── UserResource.php
│       ├── WarehouseResource.php
│       ├── TicketResource.php
│       ├── ProductResource.php          ← NEW
│       ├── ProductCategoryResource.php  ← NEW
│       └── ProductOrderResource.php     ← NEW
│
├── Http/
│   ├── Controllers/
│   │   ├── DashboardController.php
│   │   ├── OrderController.php
│   │   ├── ParcelController.php
│   │   ├── ShipmentController.php
│   │   ├── InvoiceController.php
│   │   ├── TrackingController.php
│   │   ├── TicketController.php
│   │   ├── PaymentController.php
│   │   ├── ProductController.php        ← NEW (browse catalog)
│   │   ├── CartController.php           ← NEW (session cart)
│   │   └── ProductOrderController.php   ← NEW (place + track orders)
│   └── Requests/
│       ├── StoreOrderRequest.php
│       ├── StoreProductOrderRequest.php ← NEW
│       └── ...
│
├── Jobs/
│   ├── SendQuoteEmailJob.php
│   ├── SendSMSNotificationJob.php
│   ├── CalculateStorageFeesJob.php
│   ├── SendInvoiceNotificationJob.php
│   ├── ProcessPaymentWebhookJob.php
│   └── SendProductOrderNotificationJob.php  ← NEW
│
├── Models/
│   ├── User.php
│   ├── Order.php
│   ├── OrderItem.php
│   ├── Parcel.php
│   ├── ParcelPhoto.php
│   ├── Shipment.php
│   ├── ShipmentParcel.php
│   ├── Invoice.php                      (updated: invoice_type, product_order_id)
│   ├── InvoiceItem.php
│   ├── StatusLog.php
│   ├── Warehouse.php
│   ├── ShippingMode.php
│   ├── Ticket.php
│   ├── TicketMessage.php
│   ├── Product.php                      ← NEW
│   ├── ProductCategory.php              ← NEW
│   ├── ProductOrder.php                 ← NEW
│   └── ProductOrderItem.php             ← NEW
│
├── Notifications/
│   ├── OrderCreatedNotification.php
│   ├── QuoteSentNotification.php
│   ├── ParcelArrivedNotification.php
│   ├── InvoiceGeneratedNotification.php
│   ├── PaymentConfirmedNotification.php
│   ├── ProductOrderPlacedNotification.php    ← NEW
│   ├── ProductOrderConfirmedNotification.php ← NEW
│   └── ProductOrderDispatchedNotification.php ← NEW
│
├── Repositories/
│   ├── OrderRepository.php
│   ├── ParcelRepository.php
│   └── ProductRepository.php            ← NEW
│
└── Services/
    ├── OrderService.php
    ├── ShipmentService.php
    ├── PricingService.php
    ├── StorageFeeService.php
    ├── PaymentService.php               (updated: handle product order payments)
    └── ProductOrderService.php          ← NEW

resources/
└── views/
    ├── layouts/
    │   ├── app.blade.php
    │   └── guest.blade.php
    ├── dashboard/
    │   └── index.blade.php              (updated: add product order widget)
    ├── orders/                          (Shop For Me)
    ├── parcels/
    ├── shipments/
    ├── invoices/
    ├── tracking/
    ├── tickets/
    ├── profile/
    └── store/                           ← NEW
        ├── index.blade.php              (product catalog grid)
        ├── show.blade.php               (single product detail)
        ├── cart.blade.php               (cart review page)
        ├── checkout.blade.php           (address + payment selection)
        └── orders/
            ├── index.blade.php          (my product orders list)
            └── show.blade.php           (order detail + tracking timeline)

routes/
├── web.php                              (updated: add store routes)
└── auth.php
```

---

## 6. Core Features Checklist

### Authentication & Users *(unchanged)*
- [ ] Register / Login / Password Reset (Breeze)
- [ ] Email verification
- [ ] Auto-generate Suite ID on registration
- [ ] Role system: Super Admin, Operations Staff

### Customer Dashboard *(updated)*
- [ ] Dashboard widgets: Active Orders, Parcels in Warehouse, Shipments in Transit,
      Unpaid Invoices, **Active Product Orders**
- [ ] Sidebar: Dashboard, **Store**, My Orders, **My Product Orders**, My Parcels,
      Shipments, Invoices, Tracking, Addresses, Support Tickets, Profile

### In-House Product Store *(NEW)*
- [ ] Public product catalog page (browsable without login)
- [ ] Product category filtering
- [ ] Single product detail page (images, description, price)
- [ ] Session-based cart (Alpine.js) — add, remove, update quantity
- [ ] Cart persists across page navigation (Alpine.js `$persist` or session)
- [ ] Checkout page: delivery address form + payment method selection
- [ ] Option to **combine with existing unpaid shipping invoice** (if one exists)
- [ ] `ProductOrderService::create()` — persists product_order + items
- [ ] Auto-generate product order number: `PO-BD-XXXXXX`
- [ ] Auto-generate invoice on order placement
- [ ] SSLCommerz payment for product orders
- [ ] Manual bank transfer option
- [ ] Combined payment: append product items to existing shipment invoice
- [ ] Product order statuses:
      `Pending Payment → Confirmed → Processing → Dispatched → Delivered → Cancelled`
- [ ] Status changes logged to `status_logs`
- [ ] Customer "My Product Orders" page with timeline per order

### Product Catalog Management (Filament) *(NEW)*
- [ ] Product Category CRUD (name, slug, active toggle)
- [ ] Product CRUD:
  - [ ] Name, SKU, description, price
  - [ ] Multiple image uploads (stored to `/storage/app/public/products/`)
  - [ ] Category assignment
  - [ ] Active/inactive toggle
  - [ ] Sort order control
- [ ] Product Order management:
  - [ ] List all product orders with status filter
  - [ ] View order detail (items, customer, delivery address)
  - [ ] Update order status (Confirmed → Processing → Dispatched → Delivered)
  - [ ] `FulfillProductOrder` Action triggers status update + notification
  - [ ] Add delivery tracking note on dispatch

### Shop For Me (Orders) *(unchanged)*
- [ ] Multi-item order creation
- [ ] Quote flow (send → approve → purchase)
- [ ] Status history in status_logs

### Parcel Management *(unchanged)*
- [ ] Staff parcel entry with photos
- [ ] Suite ID linking
- [ ] Storage fee tracking

### Storage Fee System *(unchanged)*
- [ ] Daily scheduler, 10-day free period

### Shipment System *(unchanged)*
- [ ] Multi-parcel shipments
- [ ] Chargeable weight calculation

### Pricing & Invoices *(updated)*
- [ ] Invoice type field: `shipment | product_order | combined`
- [ ] Combined invoice: product order items appended to shipment invoice
- [ ] Product order invoice line items: Product Cost, Delivery Fee, Tax
- [ ] Shipment invoice line items: Shipping Cost, Service Fee, Handling, Insurance, Tax,
      Storage Fee
- [ ] Combined invoice merges both line item sets under one invoice number

### Payment System *(updated)*
- [ ] SSLCommerz: handles both shipment and product order invoices
- [ ] `PaymentService` resolves invoice type and marks correct entity as paid
- [ ] Manual bank transfer for product orders
- [ ] Combined payment webhook: marks both product_order + shipment as paid

### Tracking System *(updated)*
- [ ] Search by: `tracking_number`, `shipment_number`, **`product_order_number`**
- [ ] Timeline for product orders:
      `Order Placed → Payment Confirmed → Processing → Dispatched → Delivered`

### Notification System *(updated)*
- [ ] Product order placed (email + SMS)
- [ ] Product order confirmed by staff (email + SMS)
- [ ] Product order dispatched with note (email + SMS)
- [ ] Product order delivered (email)

### Support Ticket System *(unchanged)*
- [ ] Message threads, attachments, staff replies

### Admin Panel *(updated)*
- [ ] All existing Filament resources
- [ ] Product Category Resource
- [ ] Product Resource (with image gallery)
- [ ] Product Order Resource (with fulfillment actions)
- [ ] Dashboard stats: total product orders, product revenue

### CMS *(updated)*
- [ ] Warehouses, Shipping Modes, Status Definitions, FAQ, Pages, Announcements
- [ ] **Product delivery fee settings** (flat fee or per-area rate)

---

## 7. Step-by-Step Implementation Plan

---

### Phase 1 — Scaffolding & Foundation

**Goal:** Working app skeleton with auth, database, and admin panel.

1. **Project Setup**
   - `laravel new logistics-platform`
   - Install: `filament/filament`, `spatie/laravel-permission`, `laravel/breeze`
   - Configure `.env`: DB, Mail, Queue, Redis
   - Timezone: `Asia/Dhaka`

2. **Database Migrations** — in dependency order:
   - `users` (+ `warehouse_suite_id`, `role`, `status`, `phone`)
   - `warehouses`, `shipping_modes`
   - `product_categories`, `products`                        ← NEW
   - `orders`, `order_items`
   - `product_orders`, `product_order_items`                 ← NEW
   - `parcels`, `parcel_photos`
   - `shipments`, `shipment_parcels`
   - `invoices` (+ `invoice_type`, `product_order_id`)       ← UPDATED
   - `invoice_items`
   - `status_logs`
   - `tickets`, `ticket_messages`

3. **Models & Relationships**
   - All existing models with relationships
   - `Product` — belongsTo `ProductCategory`, hasMany `ProductOrderItems`
   - `ProductCategory` — hasMany `Products`
   - `ProductOrder` — belongsTo `User`, belongsTo `Invoice` (nullable),
     hasMany `ProductOrderItems`
   - `ProductOrderItem` — belongsTo `ProductOrder`, belongsTo `Product`
   - `Invoice` — updated: nullable `shipment_id`, nullable `product_order_id`,
     `invoice_type` enum

4. **Authentication (Breeze)**
   - Scaffold Breeze views
   - Add `phone` to registration
   - Auto-generate Suite ID on user creation
   - Email verification middleware

5. **Role & Permission Seeding**
   - Roles: `super_admin`, `operations_staff`
   - Permissions include: `manage-products`, `manage-product-orders`         ← NEW
   - Seed default Super Admin

6. **Filament Setup**
   - Install and configure Filament
   - Stub all Resource classes (including Product, ProductCategory,
     ProductOrder)
   - Role-based panel access

7. **CMS & Demo Seeders**
   - Warehouses, shipping modes, status definitions
   - Sample product categories (e.g. Electronics, Accessories, Clothing)    ← NEW
   - Sample products with placeholder images                                 ← NEW

---

### Phase 2 — Core Business Logic

**Goal:** All workflows functional end-to-end.

8. **PricingService**
   - `calculateVolumetricWeight($l, $w, $h): float`
   - `calculateChargeableWeight($actual, $volumetric): float`

9. **ProductOrderService** *(NEW)*
```
   ProductOrderService::create(User $user, array $cartItems, array $deliveryAddress,
                                string $paymentMethod, ?Invoice $existingInvoice): ProductOrder

   - Validates cart items against active products
   - Calculates subtotal, delivery fee, total
   - Creates product_order record
   - Creates product_order_items (snapshot product name + price)
   - Generates invoice (or appends to existing invoice if combined)
   - Sets invoice_type = 'product_order' | 'combined'
   - Dispatches ProductOrderPlacedNotification
   - Logs initial status to status_logs
```

10. **FulfillProductOrder Action** *(NEW)*
```
    FulfillProductOrder::execute(ProductOrder $order, string $newStatus, ?string $note)

    - Updates product_order.status
    - Logs to status_logs
    - Dispatches appropriate notification
      (Confirmed → ProductOrderConfirmedNotification)
      (Dispatched → ProductOrderDispatchedNotification with note)
```

11. **Session Cart (CartController)** *(NEW)*
    - `addToCart($productId, $qty)` — stores in session
    - `updateCart($productId, $qty)`
    - `removeFromCart($productId)`
    - `getCart()` — resolves product records from DB, returns enriched cart
    - Cart view rendered with Alpine.js reactive quantity controls

12. **Checkout Flow** *(NEW)*
    - `CheckoutController::show()` — renders checkout form
    - Delivery address fields (name, phone, address, city, postcode)
    - Payment method: SSLCommerz | Bank Transfer | Combine with existing invoice
    - "Combine" option: queries user's unpaid shipment invoices,
      shows dropdown to select
    - `CheckoutController::store()` → calls `ProductOrderService::create()`

13. **Combined Invoice Logic** *(NEW)*
    - If customer selects "combine with existing invoice":
      - `ProductOrderService` fetches the selected `Invoice`
      - Appends new `InvoiceItems` to that invoice
      - Updates `invoice.invoice_type = 'combined'`
      - Links `invoice.product_order_id`
      - Total recalculated
    - On payment: `PaymentService` marks both shipment + product_order as paid

14. **Order Flow (Shop For Me)** *(unchanged)*
    - Multi-item order creation, quote flow, approve/reject

15. **Parcel Intake (Filament)** *(unchanged)*

16. **Shipment Builder (Filament)** *(unchanged)*

17. **Invoice System** *(updated)*
    - `GenerateInvoice` Action: detect invoice_type, build appropriate line items
    - Product order invoice items: Product Name × Qty, Delivery Fee, Tax
    - Combined invoice: merge both sets of line items
    - Shared invoice number format regardless of type

18. **Storage Fee Scheduler** *(unchanged)*

19. **SSLCommerz Payment Integration** *(updated)*
    - `PaymentService::initiate(Invoice $invoice)` — works for all invoice types
    - Webhook: resolve invoice type → mark correct entity/entities as paid
    - Combined invoice: marks both shipment + product_order paid in one webhook

20. **Status Logging** *(updated)*
    - Eloquent observers on: Order, Parcel, Shipment, Invoice, **ProductOrder**

21. **Tracking System** *(updated)*
    - `TrackingController::search()`:
      - Checks `parcels.tracking_number`
      - Checks `shipments.shipment_number`
      - Checks `product_orders.product_order_number`              ← NEW
    - Returns unified timeline view regardless of entity type

22. **Notification System** *(updated)*
    - All 6 existing notifications
    - 3 new product order notifications (Mail + SMS + Database, queued)

23. **Support Ticket System** *(unchanged)*

24. **File Uploads** *(updated)*
    - Product images: multiple upload stored to
      `storage/app/public/products/{product_id}/`
    - Image reorder support (sort_order field)
    - All existing upload types unchanged

---

### Phase 3 — UI, Polish & Customer Dashboard

**Goal:** Complete, polished customer-facing interface including full store.

25. **Layout & Navigation** *(updated)*
    - Sidebar updated: **Store** link added above My Orders
    - **My Product Orders** added below My Orders
    - Active state per route

26. **Dashboard Widgets** *(updated)*
    - Existing 4 widgets
    - **Active Product Orders** count card ← NEW

27. **Product Catalog Pages** *(NEW)*
    - `store/index.blade.php`:
      - Category filter tabs (Alpine.js)
      - Product grid cards (image, name, price, "Add to Cart" button)
      - Alpine.js cart state — button changes to "In Cart ✓" when added
      - Floating cart icon with item count badge
    - `store/show.blade.php`:
      - Image gallery (Alpine.js lightbox or simple switcher)
      - Product description, price
      - Quantity selector + Add to Cart
      - Related products

28. **Cart Page** *(NEW)*
    - `store/cart.blade.php`:
      - Line items: image thumbnail, name, unit price, qty stepper, subtotal
      - Remove item button
      - Order summary: subtotal, delivery fee, total
      - "Proceed to Checkout" button (requires login — redirect if guest)

29. **Checkout Page** *(NEW)*
    - `store/checkout.blade.php`:
      - Delivery address form (pre-filled from profile if available)
      - Payment method radio buttons:
        - Pay with SSLCommerz
        - Manual Bank Transfer
        - Combine with existing invoice (conditional — shows only if unpaid
          shipment invoice exists, with dropdown)
      - Order summary sidebar
      - Place Order button

30. **My Product Orders** *(NEW)*
    - `store/orders/index.blade.php`:
      - Table: order number, date, total, item count, status badge, View button
    - `store/orders/show.blade.php`:
      - Order items table
      - Delivery address
      - Invoice link
      - Status timeline (same component as shipment tracking)
      - Delivery note from staff (shown on Dispatched status)

31. **Filament Product Management Polish** *(NEW)*
    - `ProductResource`: image gallery upload with preview, category select,
      active toggle, sort order drag handle
    - `ProductCategoryResource`: simple CRUD with active toggle
    - `ProductOrderResource`:
      - Table: order number, customer, total, status badge, created_at
      - Filters: status, date range
      - Detail view: items list, delivery address panel, invoice link
      - Action buttons: Confirm, Mark Processing, Mark Dispatched (with note
        modal), Mark Delivered
      - Color-coded status badges

32. **Order Views (Shop For Me)** *(unchanged)*

33. **Parcel / Shipment / Invoice Views** *(unchanged)*

34. **Tracking Page** *(updated)*
    - Search accepts product_order_number in addition to existing formats
    - Timeline auto-detected from entity type

35. **Support Ticket, Profile Pages** *(unchanged)*

36. **Filament Dashboard Stats** *(updated)*
    - Existing stats widgets
    - Product Orders Today (count)
    - Product Revenue (total paid)
    - Pending Fulfillment count (orders in Confirmed/Processing status)

37. **Final Hardening**
    - CSRF on all forms
    - Rate limiting: login, order creation, cart actions, checkout
    - Form Request classes for all inputs including `StoreProductOrderRequest`
    - Payment webhook signature verification (SSLCommerz)
    - Secure file upload validation (mime + size) for product images
    - Prevent price tampering: product prices snapshotted into
      `product_order_items` at order creation — never re-fetched from frontend
    - 404/403 branded error pages
    - Queue failure logging
    - `php artisan optimize` for production

---

## 8. Notes for Claude Code

- **Never put business logic in controllers.** Controllers call Services or Actions only.
- **All notifications must be queued** — never send inline.
- **Use Form Request classes** for all validation.
- **All status changes must write to `status_logs`** — use Eloquent observers on
  Order, Parcel, Shipment, Invoice, and ProductOrder.
- **Suite ID format:** `BD-` + zero-padded user ID. Generated once on registration.
- **Chargeable weight lives only in `PricingService`.**
- **Storage fee logic lives only in `StorageFeeService`.**
- **Product prices must be snapshotted** into `product_order_items.unit_price` at
  order creation time. Never reference `products.price` after the order is placed.
- **Cart is session-based** — no cart table in DB. On checkout, cart is resolved
  against live product records to verify prices and active status before persisting.
- **Combined invoice logic lives only in `ProductOrderService`** — it detects the
  existing invoice, appends items, updates `invoice_type = 'combined'`, never
  creates a duplicate invoice.
- **`PaymentService::handleWebhook()`** must read `invoice.invoice_type` to decide
  which entities to mark paid — shipment only, product_order only, or both.
- **SSLCommerz IPN webhook must verify the transaction** before marking anything paid.
- **Product images** stored as JSON array of file paths in `products.images` column.
  Use an Eloquent accessor to return the array; always append new images, never
  overwrite existing ones without explicit removal.