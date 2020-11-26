<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Volosyuk\SimpleEloquent\SimpleEloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $brand_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property boolean $type
 * @property boolean $gender_appropriation
 * @property int $cost
 * @property FragranceBrand $fragranceBrand
 * @property FragranceAccord[] $fragranceAccords
 * @property FragranceIngredient[] $fragranceIngredients
 * @property Perceiver[] $perceivers
 */
class Fragrance extends Model
{
    use SimpleEloquent;
    use SoftDeletes;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'fragrance';

    /**
     * @var array
     */
    protected $fillable = ['brand_id', 'created_at', 'updated_at', 'name', 'type', 'gender_appropriation', 'cost'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fragranceBrand()
    {
        return $this->belongsTo('App\FragranceBrand', 'brand_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fragranceAccords()
    {
        return $this->hasMany('App\FragranceAccord');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fragranceIngredients()
    {
        return $this->hasMany('App\FragranceIngredient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perceivers()
    {
        return $this->hasMany('App\Perceiver');
    }
}
