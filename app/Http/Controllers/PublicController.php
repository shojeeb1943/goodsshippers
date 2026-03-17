<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Warehouse data keyed by slug.
     */
    private function warehouseData(string $slug): array
    {
        $warehouses = [
            'usa' => [
                'name'          => 'USA',
                'country'       => 'United States',
                'flag'          => '🇺🇸',
                'address_short' => 'New Jersey, USA',
                'address'       => '123 Logistics Park, Suite 500',
                'city_state'    => 'Jersey City, NJ 07302',
                'image'         => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhU3VgJ1I4TKasWv6uhg4wZYooB70zwTuwb4ebDGfv1foCqoYzgbeuggXqphotFSTkElp9kUVz4dpskBW0E7KHlk1hzjiAPm7na9Uj5bqyP9M4m_rYQMqoe7nVqsBOiV_LmB05ia389RFtPmatf3tIoC3WIztfDF4Ek1xiVHaM9FIDlZcbJLYojOhJ9_mdVGqmaqMDit-HLmHbFyKNB4Qg4DKKf3ucfvp029CRqdl1CBUTDJUhXRMZQssv4WoYC5xYE2F82MkYowg',
                'steps'         => [
                    ['Register & Get Suite ID', 'Create a free account to receive your unique GS-XXXXX Suite ID.'],
                    ['Shop at Any US Store', 'Use your suite address when checking out on Amazon, eBay, Walmart, etc.'],
                    ['We Receive & Inspect', 'We receive, photograph, and log your package within 24 hours.'],
                    ['Request Shipment', 'Log in, select your packages, choose air or sea, and check out.'],
                    ['Delivered to Bangladesh', 'Your package ships directly to your home or office in Bangladesh.'],
                ],
                'stores'        => ['Amazon','eBay','Walmart','Best Buy','Target','Costco','Nike','Apple','Sephora','Gap'],
                'stats'         => [
                    ['Dispatch Schedule', '3x Weekly'],
                    ['Air Transit Time', '10-15 Days'],
                    ['Sea Transit Time', '45-60 Days'],
                    ['Free Storage', '21 Days'],
                    ['Air Rate', '$14/kg'],
                    ['Sea Rate', '$4.5/kg'],
                ],
                'policies'      => [
                    'Free storage up to 21 days after arrival.',
                    'Photographic inspection included at no cost.',
                    'Consolidation of multiple packages into one shipment.',
                    'Dangerous goods and restricted items are prohibited.',
                    'Package weight limit: 70kg per item for air freight.',
                ],
            ],
            'uk' => [
                'name'          => 'UK',
                'country'       => 'United Kingdom',
                'flag'          => '🇬🇧',
                'address_short' => 'London, United Kingdom',
                'address'       => '45 Stratford Commerce Park, Unit 7',
                'city_state'    => 'London, E15 2QR',
                'image'         => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD4Lx1xKX2xQ9v9wize1nXPl0YeEnMTbHNE_MbBEh8-ru5-1o657l0tQOq_pLlNf80X3wNx4LkaG0xlt1HvczFy-njX_KNb_Ok7NL-ExmDyYZLiuJHDV0Fe2-ntSIiyNM23IYQEp_7lRqLGLAx9zn5ynXDlCYqVFCh5wu5rvuxXskihZHP0NHmDz7nQpBlrWWhbNh6Vmr76HV7KbweZWpesfAN0ibQFwt1OfgO0CDGX3ighHu9BdrWWDttOVhUJrZHypojY3aIXv5g',
                'steps'         => [
                    ['Register & Get Suite ID', 'Create a free account to receive your unique GS-XXXXX Suite ID.'],
                    ['Shop at Any UK Store', 'Use your suite address at ASOS, Next, Marks & Spencer, etc.'],
                    ['We Receive & Inspect', 'Package received and photographed within 24 hours.'],
                    ['Request Shipment', 'Log in, select packages, choose shipping method, and pay.'],
                    ['Delivered to Bangladesh', 'Door-to-door delivery across Bangladesh.'],
                ],
                'stores'        => ['ASOS','Amazon UK','Argos','Marks & Spencer','John Lewis','Boots','Next','Harvey Nichols','Ted Baker','Topshop'],
                'stats'         => [
                    ['Dispatch Schedule', '2x Weekly'],
                    ['Air Transit Time', '7-12 Days'],
                    ['Sea Transit Time', '40-55 Days'],
                    ['Free Storage', '30 Days'],
                    ['Air Rate', '£11/kg'],
                    ['Sea Rate', '£3.5/kg'],
                ],
                'policies'      => [
                    'Free storage up to 30 days — the longest in our network.',
                    'Photographic inspection included at no cost.',
                    'Specialised handling available for luxury and fragile goods.',
                    'Dangerous goods strictly prohibited.',
                    'Package weight limit: 70kg per item for air freight.',
                ],
            ],
            'malaysia' => [
                'name'          => 'Malaysia',
                'country'       => 'Malaysia',
                'flag'          => '🇲🇾',
                'address_short' => 'Kuala Lumpur, Malaysia',
                'address'       => 'B-12-3A Menara 2, KL Eco City',
                'city_state'    => 'Kuala Lumpur, 59200',
                'image'         => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBCIdaW_kPO5aAZsZoq1QateSWnCCKhy2UyfOxzlPMWRgszVwlaX5R4FBQSuTVo7yg6_wvoftfo99DO51SY3HAFy3RdJovJhqfTIuSFMo3C0rAHF-l2yjmJGGDuU1LVp1Fc93_7AJmHJrrTYw0BhkSLrh2n-Q7vp0M83B8jMkgcb2rOz2QX82lvgnvuijRwcsuQa0kGKC-vzkxFoCY1nJM0sYnOOQIyEk3gfGdqbbRqp_KHVzK97aBs1loU6nz-cGgiNeZzSWt9iMc',
                'steps'         => [
                    ['Register & Get Suite ID', 'Create a free account to receive your unique GS-XXXXX Suite ID.'],
                    ['Shop at Any Malaysian Store', 'Use your suite address at Lazada, Shopee, Zalora, etc.'],
                    ['We Receive & Inspect', 'Package received and logged within 24 hours.'],
                    ['Request Shipment', 'Select packages, choose shipping method, and confirm.'],
                    ['Delivered to Bangladesh', 'Fast regional delivery to Bangladesh, door-to-door.'],
                ],
                'stores'        => ['Lazada','Shopee','Zalora','Watsons MY','Parkson','H&M MY','UNIQLO MY','Sephora MY','Guardian','iHerb'],
                'stats'         => [
                    ['Dispatch Schedule', 'Daily'],
                    ['Air Transit Time', '4-7 Days'],
                    ['Sea Transit Time', '25-35 Days'],
                    ['Free Storage', '14 Days'],
                    ['Air Rate', 'RM 35/kg'],
                    ['Sea Rate', 'RM 12/kg'],
                ],
                'policies'      => [
                    'Free storage up to 14 days.',
                    'Photographic inspection included at no cost.',
                    'Fastest transit time in our network — ideal for urgent orders.',
                    'Dangerous goods and restricted items are prohibited.',
                    'Package weight limit: 50kg per item for air freight.',
                ],
            ],
        ];

        return $warehouses[$slug] ?? [];
    }

    /**
     * Product catalog data keyed by slug.
     */
    private function productData(string $slug): array
    {
        $products = [
            'smartphone-pro-x' => [
                'name'        => 'Smartphone Pro X',
                'category'    => 'Electronics',
                'price'       => '$999.00',
                'reviews'     => 2840,
                'description' => 'The Smartphone Pro X is the latest flagship device featuring a stunning 6.7" OLED display, a 108MP camera system, and the fastest mobile processor available. Perfect for power users who demand the best.',
                'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5HfdiwauUQY_YC_-NszXosavpC-Kqhh7R6dlD6YDvPlTcMuG4t2hC8Sp9llVqv-Hf9VppuRJI6OQMB7uwtbsASN4FVHHl2nEHCztbfrQG9FJnK7Q7X0hxLWnvZBwNPbgPqJfZBGC7wbyMEx5-kC6XlxcroZRgEEkyF-g8yRcPIMN22_Qup2qlnye7Wuko5tsxs4WnATNSoMRcMjV5ckSmGTb3U5hFeoCYCKaoYt29lfjR5q8',
                'specs'       => [['Display', '6.7" OLED'], ['Camera', '108MP'], ['Battery', '5000mAh'], ['Storage', '256GB'], ['Weight', '210g']],
            ],
            'vitality-multi-vitamins' => [
                'name'        => 'Vitality Multi-Vitamins',
                'category'    => 'Health & Beauty',
                'price'       => '$45.50',
                'reviews'     => 1240,
                'description' => 'A comprehensive daily multivitamin formula with 25+ essential nutrients including Vitamins A, C, D, E, B-complex, Zinc, Magnesium, and Omega-3. Supports immunity, energy, and overall wellbeing.',
                'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA6bVVrqyRUKhuRrv8FhKGy_2FgfVZJnXPleyglo4LWBVFNUhuOhKljX0MuClnMU9yzBPb777tVi6m2nR47KxWUWG0RLi_jqmdM85UI-9dOYGIPsLl9fhCwdkRdhsGKpqWxgqorxsbCiPEOEYX7tsCfs1KwFU_qPa1oSD2MkmwQfsmNAIDSrQm9HOw6dwmtBq50xwnnmN6e0xwSGi9W49aIO2pdFvD-D5Z2_Az3eAExsNB4c-B7x0DjzoEYftni-WivtygcnO9oiq0',
                'specs'       => [['Count', '120 Tablets'], ['Serving', '2 per day'], ['Form', 'Tablet'], ['Weight', '0.3kg']],
            ],
            'sonicwave-elite' => [
                'name'        => 'SonicWave Elite Headphones',
                'category'    => 'Electronics',
                'price'       => '$129.99',
                'reviews'     => 980,
                'description' => 'Premium over-ear headphones with Active Noise Cancellation (ANC), 40-hour battery life, and Hi-Res Audio certification. Featuring memory foam ear cushions and foldable design for portability.',
                'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD0ZKoTVvlGGOY5Y5NeLREgt662mEJ4TdxkV1ydVGICGoFTcr89EJDYFOleM4n1iBWn9nOIEK3J14cyN93TgmMjtyHajuMcku-nGmGe4iKBkG61vKuEwSmefFsjjOY87M8-gFawqoaiw54rauWvrRBuCgrAtZkSgW_RG228DCS_Mta0kB3bC97jiyfYvcxSAyV2QyCBehZF3yg4QOZObyfjC5JdblJD41Q-PoATv7np2utzfyAXuWj_bZLdefYmeolJm_nK_nKEvtQ',
                'specs'       => [['Type', 'Over-ear'], ['Battery', '40 hours'], ['Connectivity', 'Bluetooth 5.3'], ['ANC', 'Yes'], ['Weight', '280g']],
            ],
            'aerorunner-max' => [
                'name'        => 'AeroRunner Max Shoes',
                'category'    => 'Fashion',
                'price'       => '$160.00',
                'reviews'     => 650,
                'description' => 'High-performance running shoes engineered for long-distance comfort. Features responsive foam cushioning, breathable engineered mesh upper, and durable carbon-rubber outsole.',
                'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKsM0tMq4_qWif1WrKsSibjgIGBgn6Mrv0WTh4E57YcQpURv3kwnepI2axduIcdgMKp93sHLCAepGBE48An4r6CQxsnJ9aro82shDTQM0vGszn_t9aeD9MVuHcSe8QvvI3a3216q20Q7CMUrTuMC_cFjJk0AqbTEBXzJAIMqt45_LE5zNGw_X8dfO3JTlTcOYt1ge_LhR6FfwzeNIQZxe_n6f-zTFlcFHTJ34-RglME2grKN0kr-F4S0i6GziWgpobXwnccKsj2pc',
                'specs'       => [['Type', 'Running'], ['Sole', 'Carbon Rubber'], ['Upper', 'Mesh'], ['Drop', '8mm'], ['Weight', '285g per shoe']],
            ],
        ];

        return $products[$slug] ?? [
            'name'        => ucwords(str_replace('-', ' ', $slug)),
            'category'    => 'General',
            'price'       => 'Contact us',
            'reviews'     => 0,
            'description' => 'Product details coming soon.',
            'image'       => 'https://via.placeholder.com/600x600?text=Product+Image',
            'specs'       => [],
        ];
    }

    // ─── Route Handlers ──────────────────────────────────────────────────────────

    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function warehousesIndex()
    {
        return view('warehouses.index');
    }

    public function warehouseShow(string $slug)
    {
        $warehouse = $this->warehouseData($slug);

        if (empty($warehouse)) {
            abort(404, 'Warehouse not found.');
        }

        return view('warehouses.show', compact('warehouse'));
    }

    public function howItWorks()
    {
        return view('how-it-works');
    }

    public function faq()
    {
        return view('faq');
    }

    public function contact()
    {
        return view('contact');
    }

    public function calculator()
    {
        return view('calculator');
    }

    public function catalog()
    {
        return view('catalog');
    }

    public function productShow(string $slug)
    {
        $product = $this->productData($slug);
        return view('products.show', compact('product'));
    }

    public function trackShipment()
    {
        return view('track-shipment');
    }

    public function checkout()
    {
        return view('checkout');
    }
}
