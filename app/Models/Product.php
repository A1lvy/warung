<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'unit',
        'stock',
        'image_path',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'stock' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope query to only include active products.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Get properly formatted price in Indonesian Rupiah.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'IDR ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get formatted price with unit suffix.
     */
    public function getFormattedPriceWithUnitAttribute(): string
    {
        return $this->formatted_price . ($this->unit ? ' / ' . $this->unit : '');
    }
}
