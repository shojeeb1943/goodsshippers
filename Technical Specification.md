# Technical Implementation Specification
## Logistics Forwarding Platform (Laravel 11)

---

## 1. Project Overview

A B2C logistics forwarding platform enabling customers to:
- Submit "Shop For Me" requests (staff-purchased products shipped to warehouse)
- Send their own parcels to company warehouses using a personal Suite ID
- Track parcels and shipments through an internal status system
- Receive manual quotes, invoices, and pay via SSLCommerz or bank transfer

Operations are **fully staff-driven** — no carrier API integrations. Staff manage all quoting,
parcel intake, shipment creation, and invoicing through a Filament admin panel.

Target market: Bangladesh-based customers importing from USA, UK, Malaysia, and other origins.

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
| SMS Provider       | (e.g., Twilio / local BD gateway) |
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
   │     └── Invoice & Payment pages
   │
   ├── Filament Admin Routes (/admin)
   │     ├── Order Management
   │     ├── Parcel Intake
   │     ├── Shipment Builder
   │     ├── Invoice Generator
   │     └── CMS (Warehouses, Modes, Statuses)
   │
   ├── Business Logic Layer
   │     ├── Services/  (OrderService, ShipmentService, PricingService)
   │     ├── Actions/   (CreateShipment, SendQuote, GenerateInvoice)
   │     └── Repositories/ (OrderRepository, ParcelRepository)
   │
   ├── Queue Workers (Redis)
   │     ├── SendQuoteEmail
   │     ├── SendSMSNotification
   │     ├── CalculateStorageFees
   │     ├── SendInvoiceNotification
   │     └── ProcessPaymentWebhook
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
   └── /products
```

### Key Data Flows

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
  → Staff scans/records parcel in Filament (weight, dims, photos)
  → Parcel.storage_started_at = arrival_date
  → Notification: "Parcel Arrived"
  → Daily scheduler checks storage age → applies fees after 10 days
  → Staff creates Shipment, attaches Parcels
  → PricingService calculates chargeable weight
  → Invoice generated → Customer pays → Status updated
```

**Tracking Flow:**
```
Customer enters tracking_number or shipment_number
  → TrackingController queries status_logs table
  → Returns ordered timeline of status events
  → Rendered as visual timeline in Blade view
```

---

## 4. File Structure
```
app/
├── Actions/
│   ├── CreateShipment.php
│   ├── GenerateInvoice.php
│   ├── SendQuote.php
│   └── ApproveQuote.php
│
├── Filament/
│   └── Resources/
│       ├── OrderResource.php
│       ├── ParcelResource.php
│       ├── ShipmentResource.php
│       ├── InvoiceResource.php
│       ├── UserResource.php
│       ├── WarehouseResource.php
│       └── TicketResource.php
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
│   │   └── PaymentController.php
│   └── Middleware/
│
├── Jobs/
│   ├── SendQuoteEmailJob.php
│   ├── SendSMSNotificationJob.php
│   ├── CalculateStorageFeesJob.php
│   ├── SendInvoiceNotificationJob.php
│   └── ProcessPaymentWebhookJob.php
│
├── Models/
│   ├── User.php
│   ├── Order.php
│   ├── OrderItem.php
│   ├── Parcel.php
│   ├── ParcelPhoto.php
│   ├── Shipment.php
│   ├── ShipmentParcel.php
│   ├── Invoice.php
│   ├── InvoiceItem.php
│   ├── StatusLog.php
│   ├── Warehouse.php
│   ├── ShippingMode.php
│   ├── Ticket.php
│   └── TicketMessage.php
│
├── Notifications/
│   ├── OrderCreatedNotification.php
│   ├── QuoteSentNotification.php
│   ├── ParcelArrivedNotification.php
│   ├── InvoiceGeneratedNotification.php
│   └── PaymentConfirmedNotification.php
│
├── Repositories/
│   ├── OrderRepository.php
│   └── ParcelRepository.php
│
└── Services/
    ├── OrderService.php
    ├── ShipmentService.php
    ├── PricingService.php
    ├── StorageFeeService.php
    └── PaymentService.php

database/
└── migrations/
    ├── create_users_table.php           (+ warehouse_suite_id, role, status)
    ├── create_orders_table.php
    ├── create_order_items_table.php
    ├── create_parcels_table.php
    ├── create_parcel_photos_table.php
    ├── create_shipments_table.php
    ├── create_shipment_parcels_table.php
    ├── create_invoices_table.php
    ├── create_invoice_items_table.php
    ├── create_status_logs_table.php
    ├── create_warehouses_table.php
    ├── create_shipping_modes_table.php
    ├── create_tickets_table.php
    └── create_ticket_messages_table.php

resources/
└── views/
    ├── layouts/
    │   ├── app.blade.php
    │   └── guest.blade.php
    ├── dashboard/
    │   └── index.blade.php
    ├── orders/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── show.blade.php
    ├── parcels/
    │   ├── index.blade.php
    │   └── show.blade.php
    ├── shipments/
    │   ├── index.blade.php
    │   └── show.blade.php
    ├── invoices/
    │   ├── index.blade.php
    │   └── show.blade.php
    ├── tracking/
    │   └── index.blade.php
    ├── tickets/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── show.blade.php
    └── profile/
        └── edit.blade.php

routes/
├── web.php         (customer-facing routes)
└── auth.php        (Breeze auth routes)
```

---

## 5. Core Features Checklist

### Authentication & Users
- [ ] Register / Login / Password Reset (Laravel Breeze)
- [ ] Email verification on registration
- [ ] Auto-generate warehouse Suite ID on registration (format: BD-XXXX)
- [ ] User profile management
- [ ] Role system: Super Admin, Operations Staff (spatie/laravel-permission)

### Customer Dashboard
- [ ] Dashboard widgets: Active Orders, Parcels in Warehouse, Shipments in Transit, Unpaid Invoices
- [ ] Left sidebar navigation: Dashboard, My Orders, My Parcels, Shipments, Invoices, Tracking, Addresses, Support Tickets, Profile

### Shop For Me (Orders)
- [ ] Create order with multiple product URLs (order_items)
- [ ] Order statuses: Product Requested → Quote Sent → Quote Approved → Order Purchased → Cancelled
- [ ] Customer can approve or reject a quote
- [ ] Status history logged to status_logs on every transition

### Parcel Management
- [ ] Parcel entry by staff (tracking number, weight, dims, condition, photos)
- [ ] Parcel statuses: Arrived → Stored → Ready For Shipment → Shipped → Delivered
- [ ] Multiple photos per parcel (parcel_photos)
- [ ] Link parcel to user via Suite ID
- [ ] storage_started_at set on arrival

### Storage Fee System
- [ ] Laravel Scheduler runs daily StorageFeeCalculationJob
- [ ] Free storage: first 10 days
- [ ] After 10 days: daily fee added as invoice_item
- [ ] Fee amount configurable in CMS

### Shipment System
- [ ] Create shipment, attach multiple parcels
- [ ] Auto-generate shipment number (SH-BD-XXXXXX)
- [ ] Chargeable weight calculation: MAX(actual, volumetric)
- [ ] Volumetric weight: (L × W × H) / 5000
- [ ] Shipment statuses: Created → In Transit → Customs Clearance → Out for Delivery → Delivered

### Pricing & Invoices
- [ ] Manual invoice generation per shipment or order
- [ ] Auto-generate invoice number
- [ ] Invoice line items: Product Cost, Shipping Cost, Service Fee, Handling Fee, Insurance, Tax, Storage Fee
- [ ] Invoice statuses: Draft → Sent → Paid → Cancelled
- [ ] Invoice PDF generation (optional: using Laravel DomPDF)

### Payment System
- [ ] SSLCommerz integration (redirect-based checkout)
- [ ] Manual Bank Transfer option (staff marks as paid)
- [ ] Payment webhook handler (ProcessPaymentWebhookJob)
- [ ] Payment confirmation notification to customer

### Tracking System
- [ ] Public/authenticated tracking page
- [ ] Search by tracking_number or shipment_number
- [ ] Visual timeline rendered from status_logs
- [ ] Full status list from "Product Requested" through "Delivered"

### Notification System
- [ ] Email notifications via Laravel Mail (queued)
- [ ] SMS notifications via configured gateway (queued)
- [ ] Dashboard notifications (Laravel database channel)
- [ ] Trigger points: Order created, Quote sent, Parcel arrived, Shipment created, Invoice generated, Payment confirmed

### Support Ticket System
- [ ] Customer creates ticket with subject + message
- [ ] Staff replies via Filament
- [ ] File attachments on messages
- [ ] Email alert on new reply
- [ ] Ticket statuses: Open, In Progress, Resolved, Closed

### Admin Panel (Filament)
- [ ] User management (list, view, edit role/status)
- [ ] Order management (view, send quote, update status)
- [ ] Parcel intake form (create parcel entry, upload photos)
- [ ] Shipment builder (create shipment, attach parcels, set mode)
- [ ] Invoice management (generate, edit line items, mark paid)
- [ ] Warehouse management (CRUD)
- [ ] Shipping modes management (CRUD)
- [ ] Status definitions management (CMS)
- [ ] Support ticket management
- [ ] FAQ and pages management (CMS)
- [ ] Announcements management

### CMS
- [ ] Warehouses (name, country, address, active)
- [ ] Shipping Modes (name, description, active)
- [ ] Status Definitions (configurable labels)
- [ ] FAQ entries
- [ ] Static pages
- [ ] Announcements / banners

---

## 6. Step-by-Step Implementation Plan

---

### Phase 1 — Scaffolding & Foundation

**Goal:** Working app skeleton with auth, database, and admin panel.

1. **Project Setup**
   - `laravel new logistics-platform`
   - Install packages: `filament/filament`, `spatie/laravel-permission`, `laravel/breeze`
   - Configure `.env`: DB, Mail, Queue, Redis
   - Set timezone to `Asia/Dhaka`

2. **Database Migrations** — create all tables in this order:
   - `users` (add: `warehouse_suite_id`, `role`, `status`, `phone`)
   - `warehouses`, `shipping_modes`
   - `orders`, `order_items`
   - `parcels`, `parcel_photos`
   - `shipments`, `shipment_parcels`
   - `invoices`, `invoice_items`
   - `status_logs`
   - `tickets`, `ticket_messages`

3. **Models & Relationships**
   - Define all Eloquent models with relationships as specified in Domain Model section
   - Add `HasRoles` trait to User model (spatie)
   - Add `SoftDeletes` to Order, Parcel, Shipment, Invoice

4. **Authentication (Breeze)**
   - Scaffold Breeze views
   - Add `phone` field to registration
   - Auto-generate Suite ID on user registration: `'BD-' . str_pad(User::max('id') + 1, 4, '0', STR_PAD_LEFT)`
   - Add email verification middleware

5. **Role & Permission Seeding**
   - Seed roles: `super_admin`, `operations_staff`
   - Seed permissions: manage-orders, manage-parcels, manage-shipments, manage-invoices, manage-users
   - Seed a default Super Admin user

6. **Filament Setup**
   - Install and configure Filament
   - Create all Resource classes (stubbed, to be filled in Phase 2)
   - Set up Filament auth guard
   - Apply role-based panel access

7. **CMS Seeders**
   - Seed: 3 warehouses (London, New York, Kuala Lumpur)
   - Seed: shipping modes (Air, Sea, Express)
   - Seed: all status definitions

---

### Phase 2 — Core Business Logic

**Goal:** All workflows functional end-to-end.

8. **PricingService**
```php
   // PricingService::calculateVolumetricWeight($l, $w, $h): float
   // PricingService::calculateChargeableWeight($actual, $volumetric): float
```

9. **Order Flow (Shop For Me)**
   - Customer order creation form (multi-item, dynamic with Alpine.js x-for)
   - `OrderService::create()` — persists order + items, dispatches notification
   - Staff Filament view: fill quoted_price per item, click "Send Quote"
   - `SendQuote` Action — updates status, dispatches `QuoteSentNotification`
   - Customer dashboard: approve/reject quote button
   - `ApproveQuote` Action — updates status to Quote Approved

10. **Parcel Intake (Filament)**
    - Filament form: tracking number, weight, dimensions, condition, warehouse, suite ID lookup
    - Photo upload (multiple) stored to `storage/app/public/parcels/{parcel_id}/`
    - Sets `arrival_date` and `storage_started_at` on save
    - Dispatches `ParcelArrivedNotification`

11. **Shipment Builder (Filament)**
    - Create shipment: select user, warehouse, shipping mode
    - Attach parcels (filter by user + status = Stored)
    - Auto-generate shipment number: `SH-BD-` + zero-padded ID
    - On save: call `PricingService` to calculate weights, update shipment record
    - Update linked parcel statuses to "Ready For Shipment"

12. **Invoice System**
    - `GenerateInvoice` Action: creates invoice + default line items from shipment/order
    - Staff can add/edit line items in Filament
    - Auto-generate invoice number
    - Dispatches `InvoiceGeneratedNotification`

13. **Storage Fee Scheduler**
    - `CalculateStorageFeesJob`: query parcels where `storage_started_at` < now - 10 days and status not Shipped/Delivered
    - Calculate days beyond free period × daily rate
    - Upsert invoice_item for storage fee
    - Register in `Console/Kernel.php`: `->daily()`

14. **SSLCommerz Payment Integration**
    - Install SSLCommerz Laravel package
    - `PaymentController::initiate()` — build payload, redirect to SSLCommerz
    - `PaymentController::success/fail/cancel/ipn()` — handle callbacks
    - `ProcessPaymentWebhookJob` — verify, update invoice payment_status, dispatch notification
    - Manual bank transfer: staff marks invoice as paid in Filament

15. **Status Logging**
    - Create `StatusLog` model
    - Every status change on Order, Parcel, Shipment, Invoice calls:
      `StatusLog::record($entity, $status, $note, $actor_id)`
    - Use Eloquent observers or model events

16. **Tracking System**
    - `TrackingController::search()` — accepts query param
    - Searches `parcels.tracking_number` and `shipments.shipment_number`
    - Eager loads `statusLogs` ordered by `created_at`
    - Returns to `tracking/index.blade.php` with timeline data

17. **Notification System**
    - Implement all 6 Notification classes (Mail + SMS + Database channels)
    - SMS channel: create custom channel class wrapping SMS gateway API
    - Queue all notifications (implement `ShouldQueue`)
    - Test each trigger point

18. **Support Ticket System**
    - Customer creates ticket (subject, message, optional attachment)
    - Staff replies via Filament Ticket resource
    - New reply triggers `TicketReplyNotification` (email to customer)
    - Customer can reply back (append to thread)

19. **File Uploads**
    - Configure `filesystems.php` for public disk
    - Run `php artisan storage:link`
    - Validate file types and sizes in all upload forms
    - Parcel photos: multiple upload with preview (Alpine.js)

---

### Phase 3 — UI, Polish & Customer Dashboard

**Goal:** Complete, polished customer-facing interface.

20. **Layout & Navigation**
    - Build `layouts/app.blade.php` with left sidebar
    - Sidebar links: Dashboard, My Orders, My Parcels, Shipments, Invoices, Tracking, Addresses, Support Tickets, Profile
    - Active state on current route (Alpine.js or Blade)
    - Mobile responsive hamburger menu

21. **Dashboard Widgets (Alpine.js)**
    - Active Orders count card (link to orders index)
    - Parcels In Warehouse count card
    - Shipments In Transit count card
    - Unpaid Invoices count + total amount card
    - Recent activity feed (last 5 status_logs for user)

22. **Order Views**
    - `orders/index`: table with status badges, date, item count, actions
    - `orders/create`: dynamic form — add multiple product URLs with Alpine.js (`x-data`, `x-for`)
    - `orders/show`: quote details, approve/reject buttons (conditionally shown), status timeline

23. **Parcel Views**
    - `parcels/index`: list with status, arrival date, warehouse
    - `parcels/show`: photos gallery, dimensions, weight, status timeline

24. **Shipment Views**
    - `shipments/index`: shipment number, status, parcel count, chargeable weight
    - `shipments/show`: parcel list, invoice link, status timeline

25. **Invoice Views**
    - `invoices/index`: invoice number, amount, status badges (Paid/Unpaid)
    - `invoices/show`: itemized breakdown table, Pay Now button (SSLCommerz) or bank transfer instructions

26. **Tracking Page**
    - Public tracking page (no login required)
    - Search bar (tracking or shipment number)
    - Vertical timeline component with status icons, timestamps, notes

27. **Support Ticket Views**
    - `tickets/index`: list with status badges
    - `tickets/create`: subject + message + file upload
    - `tickets/show`: message thread (chat-bubble style), reply form at bottom

28. **Profile Page**
    - Edit name, phone, password
    - Display Suite ID (read-only, prominent)
    - Display assigned warehouse info

29. **Filament Admin Polish**
    - Add stats widgets to Filament dashboard (total orders, parcels, revenue)
    - Add bulk actions (bulk update status, bulk assign to shipment)
    - Add filters on all resource tables (status, date range, warehouse)
    - Add global search across orders, parcels, shipments
    - Color-code status badges in all tables

30. **Final Hardening**
    - CSRF on all forms (already default in Laravel)
    - Rate limiting on login, order creation, ticket creation
    - Input validation on all form requests (use Form Request classes)
    - Payment webhook signature verification
    - Secure file upload validation (mime type + size checks)
    - 404/403 error pages (branded)
    - Queue failure logging and retry configuration
    - Write seeders for demo data (for testing)
    - Final `php artisan optimize` and config cache for production

---

## Notes for Claude Code

- **Never put business logic in controllers.** Controllers call Services or Actions only.
- **All notifications must be queued** — never send inline.
- **Use Form Request classes** for all validation, never validate in controllers.
- **All status changes must write to `status_logs`** — use Eloquent observers.
- **Suite ID format:** `BD-` followed by zero-padded numeric ID (e.g., BD-1042). Generate once on user creation, never regenerate.
- **Chargeable weight calculation lives only in `PricingService`** — called from `CreateShipment` Action.
- **Storage fee logic lives only in `StorageFeeService`** — called only from `CalculateStorageFeesJob`.
- **SSLCommerz IPN webhook must verify the transaction** before marking invoice as paid.