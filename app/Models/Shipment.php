<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(\App\Observers\ShipmentObserver::class)]
class Shipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'warehouse_id',
        'shipping_mode_id',
        'shipment_number',
        'status',
        'actual_weight',
        'volumetric_weight',
        'chargeable_weight',
        'notes',
    ];

    protected $casts = [
        'actual_weight'     => 'decimal:2',
        'volumetric_weight' => 'decimal:2',
        'chargeable_weight' => 'decimal:2',
    ];

    public const STATUSES = [
        'created'          => 'Created',
        'in_transit'       => 'In Transit',
        'customs_clearance' => 'Customs Clearance',
        'out_for_delivery' => 'Out for Delivery',
        'delivered'        => 'Delivered',
    ];

    // Relationships

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function shippingMode(): BelongsTo
    {
        return $this->belongsTo(ShippingMode::class);
    }

    public function parcels(): BelongsToMany
    {
        return $this->belongsToMany(Parcel::class, 'shipment_parcels');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function statusLogs(): MorphMany
    {
        return $this->morphMany(StatusLog::class, 'loggable')->orderBy('created_at');
    }
}
