<?php

namespace Database\Seeders;

use App\Models\ShippingMode;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        $usaSettings = [
            'slug' => 'usa',
            'flag' => '🇺🇸',
            'address_short' => 'New Jersey, USA',
            'city_state' => 'Jersey City, NJ 07302',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhU3VgJ1I4TKasWv6uhg4wZYooB70zwTuwb4ebDGfv1foCqoYzgbeuggXqphotFSTkElp9kUVz4dpskBW0E7KHlk1hzjiAPm7na9Uj5bqyP9M4m_rYQMqoe7nVqsBOiV_LmB05ia389RFtPmatf3tIoC3WIztfDF4Ek1xiVHaM9FIDlZcbJLYojOhJ9_mdVGqmaqMDit-HLmHbFyKNB4Qg4DKKf3ucfvp029CRqdl1CBUTDJUhXRMZQssv4WoYC5xYE2F82MkYowg',
            'steps' => [
                ['Register & Get Suite ID', 'Create a free account to receive your unique GS-XXXXX Suite ID.'],
                ['Shop at Any US Store', 'Use your suite address when checking out on Amazon, eBay, Walmart, etc.'],
                ['We Receive & Inspect', 'We receive, photograph, and log your package within 24 hours.'],
                ['Request Shipment', 'Log in, select your packages, choose air or sea, and check out.'],
                ['Delivered to Bangladesh', 'Your package ships directly to your home or office in Bangladesh.'],
            ],
            'stores' => ['Amazon', 'eBay', 'Walmart', 'Best Buy', 'Target', 'Costco', 'Nike', 'Apple', 'Sephora', 'Gap'],
            'stats' => [
                ['Dispatch Schedule', '3x Weekly'],
                ['Air Transit Time', '10-15 Days'],
                ['Sea Transit Time', '45-60 Days'],
                ['Free Storage', '21 Days'],
                ['Air Rate', '$14/kg'],
                ['Sea Rate', '$4.5/kg'],
            ],
            'policies' => [
                'Free storage up to 21 days after arrival.',
                'Photographic inspection included at no cost.',
                'Consolidation of multiple packages into one shipment.',
                'Dangerous goods and restricted items are prohibited.',
                'Package weight limit: 70kg per item for air freight.',
            ],
            'rates' => ['air' => 14, 'sea' => 4.5, 'currency' => 'USD'],
            'free_storage_days' => 21,
            'dispatch_frequency' => '3x Weekly',
            'air_transit_days' => [10, 15],
            'sea_transit_days' => [45, 60],
        ];

        $ukSettings = [
            'slug' => 'uk',
            'flag' => '🇬🇧',
            'address_short' => 'London, United Kingdom',
            'city_state' => 'London, E15 2QR',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD4Lx1xKX2xQ9v9wize1nXPl0YeEnMTbHNE_MbBEh8-ru5-1o657l0tQOq_pLlNf80X3wNx4LkaG0xlt1HvczFy-njX_KNb_Ok7NL-ExmDyYZLiuJHDV0Fe2-ntSIiyNM23IYQEp_7lRqLGLAx9zn5ynXDlCYqVFCh5wu5rvuxXskihZHP0NHmDz7nQpBlrWWhbNh6Vmr76HV7KbweZWpesfAN0ibQFwt1OfgO0CDGX3ighHu9BdrWWDttOVhUJrZHypojY3aIXv5g',
            'steps' => [
                ['Register & Get Suite ID', 'Create a free account to receive your unique GS-XXXXX Suite ID.'],
                ['Shop at Any UK Store', 'Use your suite address at ASOS, Next, Marks & Spencer, etc.'],
                ['We Receive & Inspect', 'Package received and photographed within 24 hours.'],
                ['Request Shipment', 'Log in, select packages, choose shipping method, and pay.'],
                ['Delivered to Bangladesh', 'Door-to-door delivery across Bangladesh.'],
            ],
            'stores' => ['ASOS', 'Amazon UK', 'Argos', 'Marks & Spencer', 'John Lewis', 'Boots', 'Next', 'Harvey Nichols', 'Ted Baker', 'Topshop'],
            'stats' => [
                ['Dispatch Schedule', '2x Weekly'],
                ['Air Transit Time', '7-12 Days'],
                ['Sea Transit Time', '40-55 Days'],
                ['Free Storage', '30 Days'],
                ['Air Rate', '£11/kg'],
                ['Sea Rate', '£3.5/kg'],
            ],
            'policies' => [
                'Free storage up to 30 days — the longest in our network.',
                'Photographic inspection included at no cost.',
                'Specialised handling available for luxury and fragile goods.',
                'Dangerous goods strictly prohibited.',
                'Package weight limit: 70kg per item for air freight.',
            ],
            'rates' => ['air' => 11, 'sea' => 3.5, 'currency' => 'GBP'],
            'free_storage_days' => 30,
            'dispatch_frequency' => '2x Weekly',
            'air_transit_days' => [7, 12],
            'sea_transit_days' => [40, 55],
        ];

        $malaysiaSettings = [
            'slug' => 'malaysia',
            'flag' => '🇲🇾',
            'address_short' => 'Kuala Lumpur, Malaysia',
            'city_state' => 'Kuala Lumpur, 50450',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD4Lx1xKX2xQ9v9wize1nXPl0YeEnMTbHNE_MbBEh8-ru5-1o657l0tQOq_pLlNf80X3wNx4LkaG0xlt1HvczFy-njX_KNb_Ok7NL-ExmDyYZLiuJHDV0Fe2-ntSIiyNM23IYQEp_7lRqLGLAx9zn5ynXDlCYqVFCh5wu5rvuxXskihZHP0NHmDz7nQpBlrWWhbNh6Vmr76HV7KbweZWpesfAN0ibQFwt1OfgO0CDGX3ighHu9BdrWWDttOVhUJrZHypojY3aIXv5g',
            'steps' => [
                ['Register & Get Suite ID', 'Create a free account to receive your unique GS-XXXXX Suite ID.'],
                ['Shop at Any Malaysian Store', 'Use your suite address at Lazada, Shopee, Zalora, etc.'],
                ['We Receive & Inspect', 'Package received and photographed within 24 hours.'],
                ['Request Shipment', 'Log in, select packages, choose shipping method, and pay.'],
                ['Delivered to Bangladesh', 'Door-to-door delivery across Bangladesh.'],
            ],
            'stores' => ['Lazada', 'Shopee', 'Zalora', 'Amazon MY', 'Fashion Valet', 'Hijabtrend', 'Love, Bonito'],
            'stats' => [
                ['Dispatch Schedule', 'Weekly'],
                ['Air Transit Time', '5-10 Days'],
                ['Sea Transit Time', '35-45 Days'],
                ['Free Storage', '21 Days'],
                ['Air Rate', 'RM 35/kg'],
                ['Sea Rate', 'RM 12/kg'],
            ],
            'policies' => [
                'Free storage up to 21 days after arrival.',
                'Photographic inspection included at no cost.',
                'Best rates for Southeast Asian goods.',
                'Dangerous goods strictly prohibited.',
                'Package weight limit: 70kg per item for air freight.',
            ],
            'rates' => ['air' => 35, 'sea' => 12, 'currency' => 'MYR'],
            'free_storage_days' => 21,
            'dispatch_frequency' => 'Weekly',
            'air_transit_days' => [5, 10],
            'sea_transit_days' => [35, 45],
        ];

        $warehouses = [
            ['name' => 'USA Warehouse', 'country' => 'United States', 'address' => '123 Logistics Park, Suite 500, Jersey City, NJ 07302', 'is_active' => true, 'settings' => json_encode($usaSettings)],
            ['name' => 'UK Warehouse', 'country' => 'United Kingdom', 'address' => '45 Stratford Commerce Park, Unit 7, London, E15 2QR', 'is_active' => true, 'settings' => json_encode($ukSettings)],
            ['name' => 'Malaysia Warehouse', 'country' => 'Malaysia', 'address' => '78 Commercial Avenue, Kuala Lumpur, 50450', 'is_active' => true, 'settings' => json_encode($malaysiaSettings)],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::firstOrCreate(['name' => $warehouse['name']], $warehouse);
        }

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
