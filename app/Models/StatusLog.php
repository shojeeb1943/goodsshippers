<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StatusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'loggable_type',
        'loggable_id',
        'status',
        'note',
        'actor_id',
    ];

    public function loggable(): MorphTo
    {
        return $this->morphTo();
    }

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    /**
     * Convenience method to log a status change.
     */
    public static function record(Model $entity, string $status, ?string $note = null, ?int $actorId = null): self
    {
        return self::create([
            'loggable_type' => get_class($entity),
            'loggable_id'   => $entity->getKey(),
            'status'        => $status,
            'note'          => $note,
            'actor_id'      => $actorId,
        ]);
    }
}
