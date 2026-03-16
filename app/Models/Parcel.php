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

#[ObservedBy(\App\Observers\ParcelObserver::class)]
class Parcel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'warehouse_id',
        'tracking_number',
        'weight',
        'length',
        'width',
        'height',
        'condition',
        'status',
        'arrival_date',
        'storage_started_at',
        'notes',
    ];

    protected $casts = [
        'arrival_date'      => 'date',
        'storage_started_at' => 'datetime',
        'weight'            => 'decimal:2',
        'length'            => 'decimal:2',
        'width'             => 'decimal:2',
        'height'            => 'decimal:2',
    ];

    public const STATUSES = [
        'arrived'             => 'Arrived',
        'stored'              => 'Stored',
        'ready_for_shipment'  => 'Ready for Shipment',
        'shipped'             => 'Shipped',
        'delivered'           => 'Delivered',
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

    public function photos(): HasMany
    {
        return $this->hasMany(ParcelPhoto::class);
    }

    public function shipments(): BelongsToMany
    {
        return $this->belongsToMany(Shipment::class, 'shipment_parcels');
    }

    public function statusLogs(): MorphMany
    {
        return $this->morphMany(StatusLog::class, 'loggable')->orderBy('created_at');
    }
}
