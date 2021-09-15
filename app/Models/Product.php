<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
    ];

    /**
     * Get image that belongs to this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->withDefault();
    }

    /**
     * Scope a query to filter product.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, array $search)
    {
        return ProductFilter::filter($query, $search);
    }

    /**
     * Get pharmacies that belongs to this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class);
    }
}
