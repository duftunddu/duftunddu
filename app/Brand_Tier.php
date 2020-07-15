<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property boolean $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property FragranceBrand[] $fragranceBrands
 */
class Brand_Tier extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'brand_tier';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fragranceBrands()
    {
        return $this->hasMany('App\FragranceBrand', 'tier_id');
    }
}
