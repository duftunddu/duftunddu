<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property FragranceIngredient[] $fragranceIngredients
 * @property PerceivedComposition[] $perceivedCompositions
 */
class Ingredient extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ingredient';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'name'];

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
    public function perceivedCompositions()
    {
        return $this->hasMany('App\PerceivedComposition');
    }
}
