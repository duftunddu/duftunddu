<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $brand_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $country
 * @property FragranceBrand $fragranceBrand
 */
class Fragrance_Brand_Availability extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'fragrance_brand_availability';

    /**
     * @var array
     */
    protected $fillable = ['brand_id', 'created_at', 'updated_at', 'country'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fragranceBrand()
    {
        return $this->belongsTo('App\FragranceBrand', 'brand_id');
    }
}
