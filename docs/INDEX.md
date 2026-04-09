# GoosShippers Codebase Index

## Overview
GoosShippers is a B2C logistics forwarding platform with an integrated in-house product store, built with Laravel 11 and Filament.

---

## Documentation Files

| File | Description |
|------|-------------|
| [README.md](../README.md) | Laravel default documentation |
| [Technical Specification.md](../Technical%20Specification.md) | Original technical specification |
| [Technical Specification updated.md](../Technical%20Specification%20updated.md) | Latest technical specification (v2) |
| [project reference.md](../project%20reference.md) | Project reference and technology details |
| [CODE_INDEX.md](CODE_INDEX.md) | Code component index |
| [DESIGN.md](DESIGN.md) | Design documentation |

---

## Root Configuration Files

| File | Description |
|------|-------------|
| [.editorconfig](../.editorconfig) | Editor configuration |
| [.env.example](../.env.example) | Environment variables template |
| [.gitattributes](../.gitattributes) | Git attributes |
| [.gitignore](../.gitignore) | Git ignore rules |
| [.htaccess](../.htaccess) | Apache configuration |
| [artisan](../artisan) | Laravel CLI entry point |
| [composer.json](../composer.json) | PHP dependencies |
| [composer.lock](../composer.lock) | PHP dependency lock file |
| [deploy.sh](../deploy.sh) | Deployment script |
| [package.json](../package.json) | Node.js dependencies |
| [package-lock.json](../package-lock.json) | Node.js dependency lock file |
| [phpunit.xml](../phpunit.xml) | PHPUnit configuration |
| [postcss.config.js](../postcss.config.js) | PostCSS configuration |
| [tailwind.config.js](../tailwind.config.js) | Tailwind CSS configuration |
| [vite.config.js](../vite.config.js) | Vite build configuration |

---

## Application Layer (`app/`)

### Models (`app/Models/`)
| Model | File | Description |
|-------|------|-------------|
| User | [User.php](../app/Models/User.php) | User authentication and profiles |
| Order | [Order.php](../app/Models/Order.php) | Shop-For-Me orders |
| OrderItem | [OrderItem.php](../app/Models/OrderItem.php) | Order line items |
| Parcel | [Parcel.php](../app/Models/Parcel.php) | Customer parcels |
| ParcelPhoto | [ParcelPhoto.php](../app/Models/ParcelPhoto.php) | Parcel documentation photos |
| Shipment | [Shipment.php](../app/Models/Shipment.php) | Consolidated shipments |
| Invoice | [Invoice.php](../app/Models/Invoice.php) | Invoices and billing |
| InvoiceItem | [InvoiceItem.php](../app/Models/InvoiceItem.php) | Invoice line items |
| Ticket | [Ticket.php](../app/Models/Ticket.php) | Support tickets |
| TicketMessage | [TicketMessage.php](../app/Models/TicketMessage.php) | Ticket replies |
| Warehouse | [Warehouse.php](../app/Models/Warehouse.php) | Storage warehouses |
| ShippingMode | [ShippingMode.php](../app/Models/ShippingMode.php) | Shipping mode options |
| StatusLog | [StatusLog.php](../app/Models/StatusLog.php) | Shipment status tracking |

### Controllers (`app/Http/Controllers/`)
| Controller | File | Description |
|------------|------|-------------|
| Controller | [Controller.php](../app/Http/Controllers/Controller.php) | Base controller |
| DashboardController | [DashboardController.php](../app/Http/Controllers/DashboardController.php) | Main dashboard |
| PublicController | [PublicController.php](../app/Http/Controllers/PublicController.php) | Public-facing pages |
| OrderController | [OrderController.php](../app/Http/Controllers/OrderController.php) | Order management |
| ParcelController | [ParcelController.php](../app/Http/Controllers/ParcelController.php) | Parcel management |
| ShipmentController | [ShipmentController.php](../app/Http/Controllers/ShipmentController.php) | Shipment management |
| InvoiceController | [InvoiceController.php](../app/Http/Controllers/InvoiceController.php) | Invoice handling |
| TicketController | [TicketController.php](../app/Http/Controllers/TicketController.php) | Support tickets |
| TrackingController | [TrackingController.php](../app/Http/Controllers/TrackingController.php) | Package tracking |
| PaymentController | [PaymentController.php](../app/Http/Controllers/PaymentController.php) | Payment processing |
| ProfileController | [ProfileController.php](../app/Http/Controllers/ProfileController.php) | User profile management |
| AdminController | [AdminController.php](../app/Http/Controllers/AdminController.php) | Admin panel |

### Auth Controllers (`app/Http/Controllers/Auth/`)
| Controller | File | Description |
|------------|------|-------------|
| AuthenticatedSessionController | [AuthenticatedSessionController.php](../app/Http/Controllers/Auth/AuthenticatedSessionController.php) | Login handling |
| ConfirmablePasswordController | [ConfirmablePasswordController.php](../app/Http/Controllers/Auth/ConfirmablePasswordController.php) | Password confirmation |
| EmailVerificationNotificationController | [EmailVerificationNotificationController.php](../app/Http/Controllers/Auth/EmailVerificationNotificationController.php) | Email verification |
| EmailVerificationPromptController | [EmailVerificationPromptController.php](../app/Http/Controllers/Auth/EmailVerificationPromptController.php) | Email verification prompt |
| NewPasswordController | [NewPasswordController.php](../app/Http/Controllers/Auth/NewPasswordController.php) | Password reset |
| PasswordController | [PasswordController.php](../app/Http/Controllers/Auth/PasswordController.php) | Password management |
| PasswordResetLinkController | [PasswordResetLinkController.php](../app/Http/Controllers/Auth/PasswordResetLinkController.php) | Password reset links |
| RegisteredUserController | [RegisteredUserController.php](../app/Http/Controllers/Auth/RegisteredUserController.php) | User registration |
| VerifyEmailController | [VerifyEmailController.php](../app/Http/Controllers/Auth/VerifyEmailController.php) | Email verification |

### Middleware (`app/Http/Middleware/`)
| Middleware | File | Description |
|------------|------|-------------|
| AdminAuthMiddleware | [AdminAuthMiddleware.php](../app/Http/Middleware/AdminAuthMiddleware.php) | Admin authentication |
| RedirectIfAdminAuthenticated | [RedirectIfAdminAuthenticated.php](../app/Http/Middleware/RedirectIfAdminAuthenticated.php) | Admin redirect |

### Requests (`app/Http/Requests/`)
| Request | File | Description |
|---------|------|-------------|
| ProfileUpdateRequest | [ProfileUpdateRequest.php](../app/Http/Requests/ProfileUpdateRequest.php) | Profile update validation |
| StoreOrderRequest | [StoreOrderRequest.php](../app/Http/Requests/StoreOrderRequest.php) | Order creation validation |
| LoginRequest | [LoginRequest.php](../app/Http/Requests/Auth/LoginRequest.php) | Login validation |

### Actions (`app/Actions/`)
| Action | File | Description |
|--------|------|-------------|
| CreateShipment | [CreateShipment.php](../app/Actions/CreateShipment.php) | Shipment creation |
| SendQuote | [SendQuote.php](../app/Actions/SendQuote.php) | Quote generation |
| GenerateInvoice | [GenerateInvoice.php](../app/Actions/GenerateInvoice.php) | Invoice generation |
| ApproveQuote | [ApproveQuote.php](../app/Actions/ApproveQuote.php) | Quote approval |

### Services (`app/Services/`)
| Service | File | Description |
|---------|------|-------------|
| OrderService | [OrderService.php](../app/Services/OrderService.php) | Order business logic |
| PricingService | [PricingService.php](../app/Services/PricingService.php) | Pricing calculations |
| StorageFeeService | [StorageFeeService.php](../app/Services/StorageFeeService.php) | Storage fee calculations |

### Jobs (`app/Jobs/`)
| Job | File | Description |
|-----|------|-------------|
| ProcessPaymentWebhookJob | [ProcessPaymentWebhookJob.php](../app/Jobs/ProcessPaymentWebhookJob.php) | Payment processing |
| CalculateStorageFeesJob | [CalculateStorageFeesJob.php](../app/Jobs/CalculateStorageFeesJob.php) | Daily storage fee calculation |

### Notifications (`app/Notifications/`)
| Notification | File | Description |
|--------------|------|-------------|
| InvoiceGeneratedNotification | [InvoiceGeneratedNotification.php](../app/Notifications/InvoiceGeneratedNotification.php) | Invoice generated alert |
| OrderCreatedNotification | [OrderCreatedNotification.php](../app/Notifications/OrderCreatedNotification.php) | Order created alert |
| ParcelArrivedNotification | [ParcelArrivedNotification.php](../app/Notifications/ParcelArrivedNotification.php) | Parcel arrived alert |
| PaymentConfirmedNotification | [PaymentConfirmedNotification.php](../app/Notifications/PaymentConfirmedNotification.php) | Payment confirmed alert |
| QuoteSentNotification | [QuoteSentNotification.php](../app/Notifications/QuoteSentNotification.php) | Quote sent alert |
| TicketReplyNotification | [TicketReplyNotification.php](../app/Notifications/TicketReplyNotification.php) | Ticket reply alert |
| SmsChannel | [SmsChannel.php](../app/Notifications/Channels/SmsChannel.php) | SMS notification channel |

### Observers (`app/Observers/`)
| Observer | File | Description |
|----------|------|-------------|
| InvoiceObserver | [InvoiceObserver.php](../app/Observers/InvoiceObserver.php) | Invoice events |
| OrderObserver | [OrderObserver.php](../app/Observers/OrderObserver.php) | Order events |
| ParcelObserver | [ParcelObserver.php](../app/Observers/ParcelObserver.php) | Parcel events |
| ShipmentObserver | [ShipmentObserver.php](../app/Observers/ShipmentObserver.php) | Shipment events |

### Providers (`app/Providers/`)
| Provider | File | Description |
|----------|------|-------------|
| AppServiceProvider | [AppServiceProvider.php](../app/Providers/AppServiceProvider.php) | Application service provider |
| AdminPanelProvider | [AdminPanelProvider.php](../app/Providers/Filament/AdminPanelProvider.php) | Filament admin panel |

### Livewire Components (`app/Livewire/`)
| Component | File | Description |
|-----------|------|-------------|
| StatsOverview | [StatsOverview.php](../app/Livewire/StatsOverview.php) | Dashboard statistics |

### View Components (`app/View/Components/`)
| Component | File | Description |
|-----------|------|-------------|
| AppLayout | [AppLayout.php](../app/View/Components/AppLayout.php) | Main application layout |
| GuestLayout | [GuestLayout.php](../app/View/Components/GuestLayout.php) | Guest layout |

---

## Filament Admin Panel (`app/Filament/`)

### Admin Resources (`app/Filament/Admin/Resources/`)
| Resource | Directory | Description |
|----------|-----------|-------------|
| Orders | [Orders/](../app/Filament/Admin/Resources/Orders/) | Order management |
| Parcels | [Parcels/](../app/Filament/Admin/Resources/Parcels/) | Parcel management |
| Shipments | [Shipments/](../app/Filament/Admin/Resources/Shipments/) | Shipment management |
| Invoices | [Invoices/](../app/Filament/Admin/Resources/Invoices/) | Invoice management |
| Tickets | [Tickets/](../app/Filament/Admin/Resources/Tickets/) | Support ticket management |
| Users | [Users/](../app/Filament/Admin/Resources/Users/) | User management |
| Warehouses | [Warehouses/](../app/Filament/Admin/Resources/Warehouses/) | Warehouse management |
| ShippingModes | [ShippingModes/](../app/Filament/Admin/Resources/ShippingModes/) | Shipping mode management |

### Resource Structure (Example: Orders)
Each resource contains:
- `OrderResource.php` - Resource definition
- `Pages/` - CRUD pages (Create, Edit, List)
- `Schemas/` - Form schemas
- `Tables/` - Table configurations

#### Orders Resource Structure
| File | Description |
|------|-------------|
| [OrderResource.php](../app/Filament/Admin/Resources/Orders/OrderResource.php) | Resource definition |
| [Pages/CreateOrder.php](../app/Filament/Admin/Resources/Orders/Pages/CreateOrder.php) | Create page |
| [Pages/EditOrder.php](../app/Filament/Admin/Resources/Orders/Pages/EditOrder.php) | Edit page |
| [Pages/ListOrders.php](../app/Filament/Admin/Resources/Orders/Pages/ListOrders.php) | List page |
| [Schemas/OrderForm.php](../app/Filament/Admin/Resources/Orders/Schemas/OrderForm.php) | Form schema |
| [Tables/OrdersTable.php](../app/Filament/Admin/Resources/Orders/Tables/OrdersTable.php) | Table configuration |

#### Parcels Resource Structure
| File | Description |
|------|-------------|
| [ParcelResource.php](../app/Filament/Admin/Resources/Parcels/ParcelResource.php) | Resource definition |
| [Pages/CreateParcel.php](../app/Filament/Admin/Resources/Parcels/Pages/CreateParcel.php) | Create page |
| [Pages/EditParcel.php](../app/Filament/Admin/Resources/Parcels/Pages/EditParcel.php) | Edit page |
| [Pages/ListParcels.php](../app/Filament/Admin/Resources/Parcels/Pages/ListParcels.php) | List page |
| [Schemas/ParcelForm.php](../app/Filament/Admin/Resources/Parcels/Schemas/ParcelForm.php) | Form schema |
| [Tables/ParcelsTable.php](../app/Filament/Admin/Resources/Parcels/Tables/ParcelsTable.php) | Table configuration |

#### Shipments Resource Structure
| File | Description |
|------|-------------|
| [ShipmentResource.php](../app/Filament/Admin/Resources/Shipments/ShipmentResource.php) | Resource definition |
| [Pages/CreateShipment.php](../app/Filament/Admin/Resources/Shipments/Pages/CreateShipment.php) | Create page |
| [Pages/EditShipment.php](../app/Filament/Admin/Resources/Shipments/Pages/EditShipment.php) | Edit page |
| [Pages/ListShipments.php](../app/Filament/Admin/Resources/Shipments/Pages/ListShipments.php) | List page |
| [Schemas/ShipmentForm.php](../app/Filament/Admin/Resources/Shipments/Schemas/ShipmentForm.php) | Form schema |
| [Tables/ShipmentsTable.php](../app/Filament/Admin/Resources/Shipments/Tables/ShipmentsTable.php) | Table configuration |

#### Invoices Resource Structure
| File | Description |
|------|-------------|
| [InvoiceResource.php](../app/Filament/Admin/Resources/Invoices/InvoiceResource.php) | Resource definition |
| [Pages/CreateInvoice.php](../app/Filament/Admin/Resources/Invoices/Pages/CreateInvoice.php) | Create page |
| [Pages/EditInvoice.php](../app/Filament/Admin/Resources/Invoices/Pages/EditInvoice.php) | Edit page |
| [Pages/ListInvoices.php](../app/Filament/Admin/Resources/Invoices/Pages/ListInvoices.php) | List page |
| [Schemas/InvoiceForm.php](../app/Filament/Admin/Resources/Invoices/Schemas/InvoiceForm.php) | Form schema |
| [Tables/InvoicesTable.php](../app/Filament/Admin/Resources/Invoices/Tables/InvoicesTable.php) | Table configuration |

#### Tickets Resource Structure
| File | Description |
|------|-------------|
| [TicketResource.php](../app/Filament/Admin/Resources/Tickets/TicketResource.php) | Resource definition |
| [Pages/CreateTicket.php](../app/Filament/Admin/Resources/Tickets/Pages/CreateTicket.php) | Create page |
| [Pages/EditTicket.php](../app/Filament/Admin/Resources/Tickets/Pages/EditTicket.php) | Edit page |
| [Pages/ListTickets.php](../app/Filament/Admin/Resources/Tickets/Pages/ListTickets.php) | List page |
| [RelationManagers/MessagesRelationManager.php](../app/Filament/Admin/Resources/Tickets/RelationManagers/MessagesRelationManager.php) | Messages relation |
| [Schemas/TicketForm.php](../app/Filament/Admin/Resources/Tickets/Schemas/TicketForm.php) | Form schema |
| [Tables/TicketsTable.php](../app/Filament/Admin/Resources/Tickets/Tables/TicketsTable.php) | Table configuration |

#### Users Resource Structure
| File | Description |
|------|-------------|
| [UserResource.php](../app/Filament/Admin/Resources/Users/UserResource.php) | Resource definition |
| [Pages/CreateUser.php](../app/Filament/Admin/Resources/Users/Pages/CreateUser.php) | Create page |
| [Pages/EditUser.php](../app/Filament/Admin/Resources/Users/Pages/EditUser.php) | Edit page |
| [Pages/ListUsers.php](../app/Filament/Admin/Resources/Users/Pages/ListUsers.php) | List page |
| [Schemas/UserForm.php](../app/Filament/Admin/Resources/Users/Schemas/UserForm.php) | Form schema |
| [Tables/UsersTable.php](../app/Filament/Admin/Resources/Users/Tables/UsersTable.php) | Table configuration |

#### Warehouses Resource Structure
| File | Description |
|------|-------------|
| [WarehouseResource.php](../app/Filament/Admin/Resources/Warehouses/WarehouseResource.php) | Resource definition |
| [Pages/CreateWarehouse.php](../app/Filament/Admin/Resources/Warehouses/Pages/CreateWarehouse.php) | Create page |
| [Pages/EditWarehouse.php](../app/Filament/Admin/Resources/Warehouses/Pages/EditWarehouse.php) | Edit page |
| [Pages/ListWarehouses.php](../app/Filament/Admin/Resources/Warehouses/Pages/ListWarehouses.php) | List page |
| [Schemas/WarehouseForm.php](../app/Filament/Admin/Resources/Warehouses/Schemas/WarehouseForm.php) | Form schema |
| [Tables/WarehousesTable.php](../app/Filament/Admin/Resources/Warehouses/Tables/WarehousesTable.php) | Table configuration |

#### ShippingModes Resource Structure
| File | Description |
|------|-------------|
| [ShippingModeResource.php](../app/Filament/Admin/Resources/ShippingModes/ShippingModeResource.php) | Resource definition |
| [Pages/CreateShippingMode.php](../app/Filament/Admin/Resources/ShippingModes/Pages/CreateShippingMode.php) | Create page |
| [Pages/EditShippingMode.php](../app/Filament/Admin/Resources/ShippingModes/Pages/EditShippingMode.php) | Edit page |
| [Pages/ListShippingModes.php](../app/Filament/Admin/Resources/ShippingModes/Pages/ListShippingModes.php) | List page |
| [Schemas/ShippingModeForm.php](../app/Filament/Admin/Resources/ShippingModes/Schemas/ShippingModeForm.php) | Form schema |
| [Tables/ShippingModesTable.php](../app/Filament/Admin/Resources/ShippingModes/Tables/ShippingModesTable.php) | Table configuration |

---

## Database (`database/`)

### Migrations (`database/migrations/`)
| Migration | File | Description |
|-----------|------|-------------|
| Users | [0001_01_01_000000_create_users_table.php](../database/migrations/0001_01_01_000000_create_users_table.php) | Users table |
| Cache | [0001_01_01_000001_create_cache_table.php](../database/migrations/0001_01_01_000001_create_cache_table.php) | Cache table |
| Jobs | [0001_01_01_000002_create_jobs_table.php](../database/migrations/0001_01_01_000002_create_jobs_table.php) | Jobs table |
| Warehouses | [2026_03_16_000001_create_warehouses_table.php](../database/migrations/2026_03_16_000001_create_warehouses_table.php) | Warehouses table |
| ShippingModes | [2026_03_16_000002_create_shipping_modes_table.php](../database/migrations/2026_03_16_000002_create_shipping_modes_table.php) | Shipping modes table |
| Orders | [2026_03_16_000003_create_orders_table.php](../database/migrations/2026_03_16_000003_create_orders_table.php) | Orders table |
| OrderItems | [2026_03_16_000004_create_order_items_table.php](../database/migrations/2026_03_16_000004_create_order_items_table.php) | Order items table |
| Parcels | [2026_03_16_000005_create_parcels_table.php](../database/migrations/2026_03_16_000005_create_parcels_table.php) | Parcels table |
| ParcelPhotos | [2026_03_16_000006_create_parcel_photos_table.php](../database/migrations/2026_03_16_000006_create_parcel_photos_table.php) | Parcel photos table |
| Shipments | [2026_03_16_000007_create_shipments_table.php](../database/migrations/2026_03_16_000007_create_shipments_table.php) | Shipments table |
| ShipmentParcels | [2026_03_16_000008_create_shipment_parcels_table.php](../database/migrations/2026_03_16_000008_create_shipment_parcels_table.php) | Shipment parcels pivot table |
| Invoices | [2026_03_16_000009_create_invoices_table.php](../database/migrations/2026_03_16_000009_create_invoices_table.php) | Invoices table |
| InvoiceItems | [2026_03_16_000010_create_invoice_items_table.php](../database/migrations/2026_03_16_000010_create_invoice_items_table.php) | Invoice items table |
| StatusLogs | [2026_03_16_000011_create_status_logs_table.php](../database/migrations/2026_03_16_000011_create_status_logs_table.php) | Status logs table |
| Tickets | [2026_03_16_000012_create_tickets_table.php](../database/migrations/2026_03_16_000012_create_tickets_table.php) | Tickets table |
| TicketMessages | [2026_03_16_000013_create_ticket_messages_table.php](../database/migrations/2026_03_16_000013_create_ticket_messages_table.php) | Ticket messages table |
| Permissions | [2026_03_16_130000_create_permission_tables.php](../database/migrations/2026_03_16_130000_create_permission_tables.php) | Permission tables |
| Notifications | [2026_03_17_011518_create_notifications_table.php](../database/migrations/2026_03_17_011518_create_notifications_table.php) | Notifications table |

### Seeders (`database/seeders/`)
| Seeder | File | Description |
|--------|------|-------------|
| DatabaseSeeder | [DatabaseSeeder.php](../database/seeders/DatabaseSeeder.php) | Main database seeder |
| CmsSeeder | [CmsSeeder.php](../database/seeders/CmsSeeder.php) | CMS data seeder |
| RolesAndPermissionsSeeder | [RolesAndPermissionsSeeder.php](../database/seeders/RolesAndPermissionsSeeder.php) | Roles and permissions |

### Factories (`database/factories/`)
| Factory | File | Description |
|---------|------|-------------|
| UserFactory | [UserFactory.php](../database/factories/UserFactory.php) | User factory |

---

## Configuration (`config/`)
| Config | File | Description |
|--------|------|-------------|
| app | [app.php](../config/app.php) | Application configuration |
| auth | [auth.php](../config/auth.php) | Authentication configuration |
| cache | [cache.php](../config/cache.php) | Cache configuration |
| database | [database.php](../config/database.php) | Database configuration |
| filesystems | [filesystems.php](../config/filesystems.php) | Filesystem configuration |
| logging | [logging.php](../config/logging.php) | Logging configuration |
| mail | [mail.php](../config/mail.php) | Mail configuration |
| permission | [permission.php](../config/permission.php) | Permission configuration |
| queue | [queue.php](../config/queue.php) | Queue configuration |
| services | [services.php](../config/services.php) | Services configuration |
| session | [session.php](../config/session.php) | Session configuration |

---

## Resources (`resources/`)

### Views (`resources/views/`)
| View | File | Description |
|------|------|-------------|
| home | [home.blade.php](../resources/views/home.blade.php) | Homepage |
| about | [about.blade.php](../resources/views/about.blade.php) | About page |
| contact | [contact.blade.php](../resources/views/contact.blade.php) | Contact page |
| faq | [faq.blade.php](../resources/views/faq.blade.php) | FAQ page |
| how-it-works | [how-it-works.blade.php](../resources/views/how-it-works.blade.php) | How it works page |
| calculator | [calculator.blade.php](../resources/views/calculator.blade.php) | Shipping calculator |
| track-shipment | [track-shipment.blade.php](../resources/views/track-shipment.blade.php) | Shipment tracking |
| dashboard | [dashboard.blade.php](../resources/views/dashboard.blade.php) | User dashboard |
| welcome | [welcome.blade.php](../resources/views/welcome.blade.php) | Welcome page |
| cart-empty | [cart-empty.blade.php](../resources/views/cart-empty.blade.php) | Empty cart |

### Auth Views (`resources/views/auth/`)
| View | File | Description |
|------|------|-------------|
| login | [login.blade.php](../resources/views/auth/login.blade.php) | Login page |
| register | [register.blade.php](../resources/views/auth/register.blade.php) | Registration page |
| forgot-password | [forgot-password.blade.php](../resources/views/auth/forgot-password.blade.php) | Forgot password |
| reset-password | [reset-password.blade.php](../resources/views/auth/reset-password.blade.php) | Reset password |
| confirm-password | [confirm-password.blade.php](../resources/views/auth/confirm-password.blade.php) | Confirm password |
| verify-email | [verify-email.blade.php](../resources/views/auth/verify-email.blade.php) | Email verification |

### Admin Views (`resources/views/admin/`)
| View | File | Description |
|------|------|-------------|
| dashboard | [dashboard.blade.php](../resources/views/admin/dashboard.blade.php) | Admin dashboard |
| login | [login.blade.php](../resources/views/admin/login.blade.php) | Admin login |
| layouts/app | [layouts/app.blade.php](../resources/views/admin/layouts/app.blade.php) | Admin layout |

### Invoice Views (`resources/views/invoices/`)
| View | File | Description |
|------|------|-------------|
| index | [index.blade.php](../resources/views/invoices/index.blade.php) | Invoice list |
| show | [show.blade.php](../resources/views/invoices/show.blade.php) | Invoice details |

### Ticket Views (`resources/views/tickets/`)
| View | File | Description |
|------|------|-------------|
| index | [index.blade.php](../resources/views/tickets/index.blade.php) | Ticket list |
| create | [create.blade.php](../resources/views/tickets/create.blade.php) | Create ticket |
| show | [show.blade.php](../resources/views/tickets/show.blade.php) | Ticket details |

### Tracking Views (`resources/views/tracking/`)
| View | File | Description |
|------|------|-------------|
| index | [index.blade.php](../resources/views/tracking/index.blade.php) | Tracking page |

### Warehouse Views (`resources/views/warehouses/`)
| View | File | Description |
|------|------|-------------|
| index | [index.blade.php](../resources/views/warehouses/index.blade.php) | Warehouse list |
| show | [show.blade.php](../resources/views/warehouses/show.blade.php) | Warehouse details |

### Assets (`resources/css/`, `resources/js/`)
| Asset | File | Description |
|-------|------|-------------|
| app.css | [app.css](../resources/css/app.css) | Main CSS |
| app.js | [app.js](../resources/js/app.js) | Main JavaScript |
| bootstrap.js | [bootstrap.js](../resources/js/bootstrap.js) | Bootstrap JS |

---

## Routes (`routes/`)
| Route | File | Description |
|-------|------|-------------|
| web | [web.php](../routes/web.php) | Web routes |
| auth | [auth.php](../routes/auth.php) | Authentication routes |
| console | [console.php](../routes/console.php) | Console routes |

---

## Bootstrap (`bootstrap/`)
| File | File | Description |
|------|------|-------------|
| app | [app.php](../bootstrap/app.php) | Application bootstrap |
| providers | [providers.php](../bootstrap/providers.php) | Service providers |

---

## Public (`public/`)
| File | File | Description |
|------|------|-------------|
| index | [index.php](../public/index.php) | Application entry point |
| .htaccess | [.htaccess](../public/.htaccess) | Apache rewrite rules |
| robots | [robots.txt](../public/robots.txt) | Robots file |
| favicon | [favicon.ico](../public/favicon.ico) | Favicon |

---

## Frontend Pages (`fontend-pages/`)
Static HTML prototypes for reference:
- [home page.html](../fontend-pages/home%20page.html)
- [login.html](../fontend-pages/login.html)
- [Register.html](../fontend-pages/Register.html)
- [About Us.html](../fontend-pages/About%20Us.html)
- [Contact US.html](../fontend-pages/Contact%20US.html)
- [FAQ.html](../fontend-pages/FAQ.html)
- [How It Works.html](../fontend-pages/How%20It%20Works.html)
- [Our Services.html](../fontend-pages/Our%20Services.html)
- [Our Warehouses.html](../fontend-pages/Our%20Warehouses.html)
- [Store Catalog.html](../fontend-pages/Store%20Catalog.html)
- [Product Details.html](../fontend-pages/Product%20Details.html)
- [cart.html](../fontend-pages/cart.html)
- [emty cart.html](../fontend-pages/emty%20cart.html)
- [Checkout.html](../fontend-pages/Checkout.html)
- [Shipping Cost Calculator.html](../fontend-pages/Shipping%20Cost%20Calculator.html)
- [Track Shipment.html](../fontend-pages/Track%20Shipment.html)
- [Warehouse Details.html](../fontend-pages/Warehouse%20Details.html)
- [Forgot Password.html](../fontend-pages/Forgot%20Password.html)
- [Forgot Password Success.html](../fontend-pages/Forgot%20Password%20Success.html)

---

## Utility Scripts
| Script | File | Description |
|--------|------|-------------|
| fix_filament_types | [fix_filament_types.php](../fix_filament_types.php) | Filament type fix script |

---

## Error Logs
| Log | File | Description |
|-----|------|-------------|
| error.log | [error.log](../error.log) | Application error log |
| error.txt | [error.txt](../error.txt) | Error messages |
| error_migrate.txt | [error_migrate.txt](../error_migrate.txt) | Migration errors |

---

## GitHub Configuration (`.github/`)
GitHub workflows and configuration files.

---

## Claude Configuration (`.claude/`)
Claude AI assistant configuration.

---

## Storage (`storage/`)
Application storage for logs, sessions, and cached files.

---

## Tests (`tests/`)
PHPUnit test files.

---

## Demo Accounts

### Admin User
| Field | Value |
|-------|-------|
| Email | admin@goosshippers.com |
| Password | password |
| Role | super_admin |
| Warehouse Suite ID | BD-0001 |

### Demo User (Customer)
| Field | Value |
|-------|-------|
| Email | user@goodsshippers.com |
| Password | password123 |
| Phone | +8801711000000 |

---

## Key Documentation Sections

### Technical Specification (Updated)
1. Project Overview
2. Finalized Tech Stack
3. System Architecture & Data Flow
4. Database Schema
5. Module Specifications
6. User Roles & Permissions
7. API Endpoints
8. Payment Integration
9. Notifications
10. Security Considerations
11. Deployment

---

## External Resources
- [Laravel Documentation](https://laravel.com/docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [Tailwind CSS](https://tailwindcss.com)
- [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze)
