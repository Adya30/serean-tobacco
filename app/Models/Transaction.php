<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'invoice_code',
        'user_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'kabupaten',
        'kecamatan',
        'desa',
        'total_weight_kg',
        'items_subtotal',
        'shipping_cost',
        'total_price',
        'fleet_type',
        'fleet_name',
        'shipping_status',
        'payment_status',
        'tracking_number',
        'tracking_notes',
        'estimated_delivery',
    ];

    protected function casts(): array
    {
        return [
            'total_weight_kg' => 'integer',
            'items_subtotal' => 'integer',
            'shipping_cost' => 'integer',
            'total_price' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    public static function determineFleet(int $weightKg): array
    {
        if ($weightKg < 300) {
            return [
                'type' => 'pick_up',
                'name' => 'Armada Standar Pick Up (< 300 Kg)',
                'description' => 'Pengantaran menggunakan mobil pick up standar sentra pengolahan.',
                'fee_percentage' => 10,
            ];
        }

        return [
            'type' => 'tambahan_armada',
            'name' => 'Tambahan Armada Truk Kargo (>= 300 Kg)',
            'description' => 'Tonase melebihi 300 kg, dialokasikan unit tambahan armada truk kargo.',
            'fee_percentage' => 0,
        ];
    }

    public static function calculateShippingCost(string $fleetType, int $itemsSubtotal): int
    {
        if ($fleetType === 'pick_up') {
            return (int) round($itemsSubtotal * 0.10);
        }

        return 0;
    }

    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([
            $this->customer_address,
            $this->desa ? 'Desa/Kel. '.$this->desa : null,
            $this->kecamatan ? 'Kec. '.$this->kecamatan : null,
            $this->kabupaten ? 'Kab/Kota '.$this->kabupaten : null,
        ]);

        return ! empty($parts) ? implode(', ', $parts) : ($this->customer_address ?? '-');
    }
}
