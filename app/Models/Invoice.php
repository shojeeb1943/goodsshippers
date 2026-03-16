<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_id',
        'shipment_id',
        'invoice_number',
        'status',
        'total_amount',
        'due_date',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'due_date'     => 'date',
        'paid_at'      => 'datetime',
    ];

    public const STATUSES = [
        'draft'     => 'Draft',
        'sent'      => 'Sent',
        'paid'      => 'Paid',
        'cancelled' => 'Cancelled',
    ];

    // Relationships

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function statusLogs(): MorphMany
    {
        return $this->morphMany(StatusLog::class, 'loggable')->orderBy('created_at');
    }
}
