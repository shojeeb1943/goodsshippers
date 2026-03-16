1. Platform Overview

The system will be a logistics forwarding platform that allows users to:

Request Shop-For-Me purchases

Send packages to international warehouses

Track parcels and shipments

Receive quotes and invoices

Pay shipping and service fees

Operations are staff-driven, not automated carrier integrations.

Core characteristics:

Manual quoting

Warehouse intake managed by staff

Shipment consolidation possible

Internal tracking system

Invoice-based payments

Customer dashboard

Admin operational panel

2. Final Technology Stack
Backend

Laravel 11

Reasons:

Mature ecosystem

Strong ORM

Queue system

Easy deployment

Filament admin integration

Frontend

Laravel Blade + Alpine.js

Purpose:

Lightweight

Fast

Minimal JavaScript

Suitable for dashboards

Admin Panel

Filament

Used for:

Order management

Parcel intake

Shipment creation

Invoice management

User administration

Authentication

Laravel Breeze

Provides:

Login

Registration

Password reset

Email verification

Database

MySQL

Used for:

Users

Orders

Parcels

Shipments

Invoices

Status logs

Tickets

Notifications

Channels:

Email

SMS

Dashboard notifications

Laravel Notifications system will be used.

Payment System

Supported methods:

SSLCommerz

Manual Bank Transfer

Payment structure:

Single invoice including:

product cost

shipping cost

service fee

Server Infrastructure

Deployment target:

VPS

Architecture:

Nginx
│
Laravel Application
│
├ Web Interface (Blade)
├ API / Business Logic
├ Filament Admin
├ Queue Jobs
│
MySQL Database
│
File Storage

Queue workers handle:

SMS sending

Email sending

storage fee calculation

payment webhooks

3. Core Platform Services

The platform provides three main services.

1. Shop For Me

Workflow:

User submits product links.

Staff reviews the request.

Staff sends a quote.

User approves quote.

Staff purchases product.

Product shipped to warehouse.

Important rules:

Orders can contain multiple product links.

Staff manually enter pricing.

No automatic product scraping.

2. Ship For Me

User buys product themselves.

Workflow:

User ships package to your warehouse.

Package arrives with personal suite ID.

Warehouse staff records parcel details.

Parcel stored until shipment is created.

Parcel intake includes:

weight

dimensions

photos

condition

3. Bulk Shipment

For businesses shipping large numbers of parcels.

Characteristics:

multiple parcels shipped together

custom pricing rules

separate quote logic

4. Warehouse System

Warehouses are owned by the company.

Examples:

London

New York

Kuala Lumpur

Features:

warehouses stored in database

new warehouses can be added from CMS

user selects warehouse when ordering

Each user receives:

Warehouse Suite ID

Example:

BD-2045

Used to identify parcels.

5. Shipment Lifecycle

The system will support simplified tracking statuses.

Initial statuses:

Product Requested
Quote Sent
Quote Approved
Order Purchased
Arrived at Warehouse
Ready for Shipment
Shipment Created
In Transit
Customs Clearance
Out for Delivery
Delivered

Statuses will be configurable via CMS.

6. Pricing Model

Quotes are manual, but weight calculations exist.

Weight rules:

Volumetric Weight = (Length × Width × Height) / 5000
Chargeable Weight = max(actual weight, volumetric weight)

Possible charges:

service fee

warehouse handling

consolidation fee

insurance

tax

Admin can either:

define predefined charges

or manually add charges per invoice.

Pricing also supports:

Country-to-country matrix

Examples:

USA → Bangladesh
UK → Bangladesh
Malaysia → Bangladesh
7. Parcel Management

Warehouse staff create parcel entries when packages arrive.

Parcel data includes:

tracking number

weight

dimensions

condition

photos

warehouse location

Parcel statuses:

Arrived
Stored
Ready for Shipment
Shipped
Delivered
8. Shipment System

Shipments group parcels.

Structure:

Shipment
 ├ Parcel
 ├ Parcel
 └ Parcel

Shipment contains:

shipment number

shipping mode

chargeable weight

status

Example shipment number:

SH-BD-000124
9. Storage Fee System

Policy:

Free storage: 10 days
After that: storage fees apply

Implementation:

Laravel scheduler checks parcels daily and applies fees automatically.

10. Tracking System

Tracking is internal, not carrier-based.

Users can track via:

shipment number

parcel tracking number

Tracking page shows:

timeline of status updates.

11. Customer Dashboard

Dashboard modules:

Dashboard
My Orders
My Parcels
Shipments
Invoices
Tracking
Addresses
Support Tickets
Profile

Dashboard widgets:

active orders

parcels in warehouse

shipments in transit

unpaid invoices

12. Admin Panel (Filament)

Admin manages:

Users
Orders
Order Items
Parcels
Shipments
Invoices
Payments
Warehouses
Shipping Modes
Statuses
Support Tickets

Staff actions include:

send quote

create parcel entry

create shipment

generate invoice

update shipment status

13. Role System

Roles:

Super Admin
Operations Staff

Permissions handled with:

spatie/laravel-permission

14. Support Ticket System

Users can create support tickets.

Features:

message threads

attachments

staff responses

email alerts

Tables:

tickets
ticket_messages
15. File Storage

Files stored locally.

Types:

parcel photos

ID verification

product screenshots

invoice attachments

Storage structure:

/storage
  /users
  /parcels
  /products
  /invoices
16. CMS Features

CMS allows managing dynamic content:

Warehouses
Shipping Modes
Status Definitions
FAQ
Pages
Announcements
17. Background Jobs

Queue jobs include:

Send SMS notifications
Send email notifications
Calculate storage fees
Generate invoice alerts
Process payment webhooks
18. Security Model

Security measures:

role permissions

CSRF protection

rate limiting

secure file uploads

payment webhook verification

input validation

19. Development Structure

Recommended Laravel project structure:

app/

Services/
OrderService
ShipmentService
PricingService

Actions/
CreateShipment
SendQuote
GenerateInvoice

Repositories/
OrderRepository
ParcelRepository

Avoid placing business logic inside controllers.

20. Next Steps (Project Roadmap)
Phase 1 — Core System

Build:

authentication

user dashboard

shop-for-me order flow

manual quote system

parcel intake

shipment creation

invoice system

Phase 2 — Operations

Add:

warehouse management

storage fee automation

shipment tracking

notifications

Phase 3 — Advanced Features

Add:

bulk shipment workflows

analytics dashboard

pricing matrix automation

Final Summary

The platform will be a manual-operations logistics forwarding system built with:

Laravel 11 backend

Blade + Alpine frontend

Filament admin panel

MySQL database

SMS / email notifications

SSLCommerz payments

It focuses on manual quoting,warehouse parcel management and shipment tracking, designed to scale as operations grow.