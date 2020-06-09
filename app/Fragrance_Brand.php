<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property boolean $tier
 * @property string $origin
 * @property Fragrance[] $fragrances
 */
class Fragrance_Brand extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'fragrance_brand';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'name', 'tier', 'origin'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fragrances()
    {
        return $this->hasMany('App\Fragrance', 'brand_id');
    }
}
