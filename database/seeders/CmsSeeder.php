<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use App\Models\ShippingMode;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        // Warehouses
        $warehouses = [
            ['name' => 'London Warehouse',       'country' => 'United Kingdom',  'address' => '123 Logistics Lane, London, UK',          'is_active' => true],
            ['name' => 'New York Warehouse',      'country' => 'United States',   'address' => '456 Freight Ave, New York, NY, USA',       'is_active' => true],
            ['name' => 'Kuala Lumpur Warehouse',  'country' => 'Malaysia',        'address' => '789 Warehouse Road, Kuala Lumpur, Malaysia','is_active' => true],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::firstOrCreate(['name' => $warehouse['name']], $warehouse);
        }

        // Shipping Modes
        $modes = [
            ['name' => 'Air Freight',    'description' => 'Fast air delivery, typically 5-10 business days.',       'is_active' => true],
            ['name' => 'Sea Freight',    'description' => 'Economy sea shipping, typically 30-45 business days.',    'is_active' => true],
            ['name' => 'Express Air',    'description' => 'Priority express air, typically 3-5 business days.',      'is_active' => true],
        ];

        foreach ($modes as $mode) {
            ShippingMode::firstOrCreate(['name' => $mode['name']], $mode);
        }
    }
}
