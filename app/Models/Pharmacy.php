<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacy extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pharmacies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
    ];

    /**
     * Scope a query to only include users of a given phone.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @param mixed
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, array $search)
    {
        return PharmacyFilter::filter($query, $search);
    }

    /**
     * Get products that belongs to this pharmacy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
