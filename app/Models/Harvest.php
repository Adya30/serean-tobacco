<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Harvest extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'farmer_id',
        'farmer_name',
        'variety',
        'grade',
        'harvest_weight_kg',
        'moisture_content',
        'harvest_date',
        'farm_location',
        'quality_notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'harvest_weight_kg' => 'integer',
            'harvest_date' => 'date',
        ];
    }

    public function farmer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }
}
