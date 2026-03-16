<?php

namespace App\Actions;

use App\Models\Shipment;
use App\Models\Parcel;
use App\Services\PricingService;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateShipment
{
    protected PricingService $pricingService;

    public function __construct(PricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    /**
     * Creates a new shipment containing the given parcel IDs.
     * Calculates combined weight and updates parcels.
     *
     * @param int $userId
     * @param int $warehouseId
     * @param int $shippingModeId
     * @param array $parcelIds
     * @param string|null $notes
     * @return Shipment
     */
    public function execute(int $userId, int $warehouseId, int $shippingModeId, array $parcelIds, ?string $notes = null): Shipment
    {
        if (empty($parcelIds)) throw new Exception("Cannot create an empty shipment.");

        return DB::transaction(function () use ($userId, $warehouseId, $shippingModeId, $parcelIds, $notes) {
            
            $parcels = Parcel::whereIn('id', $parcelIds)
                ->where('user_id', $userId)
                ->where('status', 'stored') // Only stored parcels can be shipped
                ->lockForUpdate()
                ->get();

            if ($parcels->count() !== count($parcelIds)) {
                throw new Exception("One or more selected parcels are invalid or not ready to be shipped.");
            }

            // Calculate aggregated weight metrics
            $totalActualWeight = 0;
            $totalVolumetricWeight = 0;

            foreach ($parcels as $parcel) {
                // Determine dimensions, default to 0 if missing
                $l = $parcel->length ?? 0;
                $w = $parcel->width ?? 0;
                $h = $parcel->height ?? 0;
                
                $volumetric = $this->pricingService->calculateVolumetricWeight($l, $w, $h);
                
                $totalActualWeight += $parcel->weight ?? 0;
                $totalVolumetricWeight += $volumetric;
            }

            $chargeableWeight = $this->pricingService->calculateChargeableWeight($totalActualWeight, $totalVolumetricWeight);

            $shipment = Shipment::create([
                'user_id' => $userId,
                'warehouse_id' => $warehouseId,
                'shipping_mode_id' => $shippingModeId,
                'status' => 'pending',
                'actual_weight' => $totalActualWeight,
                'volumetric_weight' => $totalVolumetricWeight,
                'chargeable_weight' => $chargeableWeight,
                'notes' => $notes,
            ]);

            // Auto-generate SH-BD number using ID
            $shipment->update([
                'shipment_number' => 'SH-BD-' . str_pad($shipment->id, 5, '0', STR_PAD_LEFT),
            ]);

            // Attach parcels and update statuses
            $shipment->parcels()->attach($parcelIds);

            Parcel::whereIn('id', $parcelIds)->update(['status' => 'ready_for_shipment']);

            return $shipment;
        });
    }
}
