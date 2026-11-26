<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlantingSchedule extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'farmer_name',
        'variety',
        'land_area_ha',
        'location',
        'planting_date',
        'estimated_harvest_date',
        'target_yield_kg',
        'phase',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'planting_date' => 'date',
            'estimated_harvest_date' => 'date',
            'land_area_ha' => 'float',
            'target_yield_kg' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function phaseLabel(): string
    {
        return match ($this->phase) {
            'persemaian' => 'Persemaian Bibit',
            'penanaman' => 'Penanaman Lahan',
            'pemeliharaan' => 'Pemeliharaan & Bumbun',
            'siap_panen' => 'Siap Panen',
            'selesai' => 'Selesai Panen',
            default => ucfirst($this->phase)
        };
    }

    public function phaseBadge(): string
    {
        return match ($this->phase) {
            'persemaian' => 'bg-sky-50 text-sky-700 border-sky-200',
            'penanaman' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            'pemeliharaan' => 'bg-amber-50 text-amber-700 border-amber-200',
            'siap_panen' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'selesai' => 'bg-stone-100 text-stone-600 border-stone-200',
            default => 'bg-stone-50 text-stone-600 border-stone-200'
        };
    }

    public function daysToHarvest(): int
    {
        $today = Carbon::today();
        $harvest = Carbon::parse($this->estimated_harvest_date);

        return (int) $today->diffInDays($harvest, false);
    }

    public function isHarvestSoon(): bool
    {
        $days = $this->daysToHarvest();

        return $days >= 0 && $days <= 14 && $this->phase !== 'selesai';
    }
}
