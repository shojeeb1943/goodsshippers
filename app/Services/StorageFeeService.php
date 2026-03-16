<?php

namespace App\Services;

use App\Models\Parcel;

class StorageFeeService
{
    // Define the daily rate (e.g. 50 BDT)
    protected float $dailyRate = 50.0;
    protected int $freeDays = 10;

    /**
     * Calculate the accumulated storage fee for a parcel.
     * Only charges for days beyond the free period.
     */
    public function calculateFee(Parcel $parcel): float
    {
        if (!$parcel->storage_started_at) {
            return 0.0;
        }

        // Determine the end date for calculation. 
        // If the parcel has already been scheduled for shipment or delivered,
        // stop accumulating fees at its last updated timestamp.
        $stopStatuses = [
            'ready_for_shipment', 
            'in_transit', 
            'customs_clearance', 
            'out_for_delivery', 
            'delivered'
        ];

        $endDate = in_array($parcel->status, $stopStatuses) 
            ? $parcel->updated_at 
            : now();

        $daysInStorage = $parcel->storage_started_at->startOfDay()->diffInDays($endDate->startOfDay());

        $chargeableDays = max(0, $daysInStorage - $this->freeDays);

        return $chargeableDays * $this->dailyRate;
    }
}
