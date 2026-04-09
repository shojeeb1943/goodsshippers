# Codebase Index

## Models (`app/Models/`)
| Model | Description |
|-------|-------------|
| User | User authentication and profiles |
| Order | Shop-For-Me orders |
| Parcel | Customer parcels |
| Shipment | Consolidated shipments |
| Invoice | Invoices and billing |
| Ticket | Support tickets |
| Warehouse | Storage warehouses |
| ShippingMode | Shipping mode options |
| StatusLog | Shipment status tracking |
| ParcelPhoto | Parcel documentation photos |
| InvoiceItem | Invoice line items |
| OrderItem | Order line items |
| TicketMessage | Ticket replies |

## Controllers (`app/Http/Controllers/`)
| Controller | Description |
|------------|-------------|
| DashboardController | Main dashboard |
| PublicController | Public-facing pages |
| OrderController | Order management |
| ParcelController | Parcel management |
| ShipmentController | Shipment management |
| InvoiceController | Invoice handling |
| TicketController | Support tickets |
| TrackingController | Package tracking |
| PaymentController | Payment processing |
| ProfileController | User profile management |

## Filament Resources (`app/Filament/Admin/Resources/`)
| Resource | Description |
|----------|-------------|
| Orders | Order management |
| Parcels | Parcel management |
| Shipments | Shipment management |
| Invoices | Invoice management |
| Tickets | Support ticket management |
| Users | User management |
| Warehouses | Warehouse management |
| ShippingModes | Shipping mode management |

## Services (`app/Services/`)
| Service | Description |
|---------|-------------|
| OrderService | Order business logic |
| PricingService | Pricing calculations |
| StorageFeeService | Storage fee calculations |

## Actions (`app/Actions/`)
| Action | Description |
|--------|-------------|
| CreateShipment | Shipment creation |
| SendQuote | Quote generation |
| GenerateInvoice | Invoice generation |
| ApproveQuote | Quote approval |

## Jobs (`app/Jobs/`)
| Job | Description |
|-----|-------------|
| ProcessPaymentWebhookJob | Payment processing |
| CalculateStorageFeesJob | Daily storage fee calculation |

## Notifications (`app/Notifications/`)
- InvoiceGeneratedNotification
- OrderCreatedNotification
- ParcelArrivedNotification
- PaymentConfirmedNotification
- QuoteSentNotification
- TicketReplyNotification
- Channels/SmsChannel

## Observers (`app/Observers/`)
- InvoiceObserver
- OrderObserver
- ParcelObserver
- ShipmentObserver
