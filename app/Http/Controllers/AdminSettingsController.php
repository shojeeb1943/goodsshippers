<?php

namespace App\Http\Controllers;

use App\Models\ShippingMode;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        $shippingModes = ShippingMode::all();

        return view('admin.settings', compact('warehouses', 'shippingModes'));
    }

    public function updateWarehouse(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
            'settings' => 'nullable|array',
        ]);

        $warehouse->update($validated);

        return back()->with('success', 'Warehouse updated successfully.');
    }

    public function storeWarehouse(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
            'settings' => 'nullable|array',
        ]);

        Warehouse::create($validated);

        return back()->with('success', 'Warehouse created successfully.');
    }

    public function destroyWarehouse(Warehouse $warehouse)
    {
        $warehouse->delete();

        return back()->with('success', 'Warehouse deleted successfully.');
    }

    public function updateShippingMode(Request $request, ShippingMode $shippingMode)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $shippingMode->update($validated);

        return back()->with('success', 'Shipping mode updated successfully.');
    }

    public function storeShippingMode(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        ShippingMode::create($validated);

        return back()->with('success', 'Shipping mode created successfully.');
    }

    public function destroyShippingMode(ShippingMode $shippingMode)
    {
        $shippingMode->delete();

        return back()->with('success', 'Shipping mode deleted successfully.');
    }

    public function updateRates(Request $request)
    {
        $validated = $request->validate([
            'rates' => 'required|array',
            'rates.*.warehouse_id' => 'required|integer',
            'rates.*.mode_id' => 'required|integer',
            'rates.*.rate' => 'required|numeric|min:0',
            'rates.*.currency' => 'required|string|max:3',
        ]);

        foreach ($validated['rates'] as $rateData) {
            $warehouse = Warehouse::find($rateData['warehouse_id']);
            if ($warehouse && isset($warehouse->settings['rates'])) {
                $settings = $warehouse->settings;
                foreach ($shippingModes = $warehouse->shippingModes ?? [] as $mode) {
                    if ($mode->id == $rateData['mode_id']) {
                        $settings['rates'][$mode->name] = $rateData['rate'];
                        $settings['rates']['currency'] = $rateData['currency'];
                    }
                }
                $warehouse->update(['settings' => $settings]);
            }
        }

        return back()->with('success', 'Rates updated successfully.');
    }
}
