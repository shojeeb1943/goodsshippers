<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(\App\Observers\OrderObserver::class)]
class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'notes',
    ];

    public const STATUSES = [
        'product_requested' => 'Product Requested',
        'quote_sent'        => 'Quote Sent',
        'quote_approved'    => 'Quote Approved',
        'quote_rejected'    => 'Quote Rejected',
        'order_purchased'   => 'Order Purchased',
        'delivered'         => 'Delivered',
        'cancelled'         => 'Cancelled',
    ];

    // Relationships

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function statusLogs(): MorphMany
    {
        return $this->morphMany(StatusLog::class, 'loggable')->orderBy('created_at');
    }
}
