<?php

namespace App\Services;

class PricingService
{
    /**
     * Calculate volumetric weight in KG based on dimensions in CM.
     * Industry standard divisor is usually 5000.
     * Formula: (L x W x H) / 5000
     */
    public function calculateVolumetricWeight(float $l, float $w, float $h): float
    {
        return round(($l * $w * $h) / 5000, 2);
    }

    /**
     * Determine the chargeable weight.
     * It is the greater value between actual weight and volumetric weight.
     */
    public function calculateChargeableWeight(float $actual, float $volumetric): float
    {
        return max($actual, $volumetric);
    }
}
