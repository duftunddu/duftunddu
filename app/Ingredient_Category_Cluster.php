<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $ingredient_id
 * @property integer $ingredient_category_id
//  * @property integer $created_by
//  * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property IngredientCategory $ingredientCategory
 * @property Ingredient $ingredient
 * @property User $user
 */
class Ingredient_Category_Cluster extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ingredient_category_cluster';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['ingredient_id', 'ingredient_category_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function user()
    // {
    //     return $this->belongsTo('App\User', 'created_by');
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ingredientCategory()
    {
        return $this->belongsTo('App\IngredientCategory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ingredient()
    {
        return $this->belongsTo('App\Ingredient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function user()
    // {
    //     return $this->belongsTo('App\User', 'updated_by');
    // }
}
