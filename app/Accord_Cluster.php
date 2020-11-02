<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $accord_id
 * @property integer $ingredient_category_id
 * @property string $created_at
 * @property string $updated_at
 * @property Accord $accord
 * @property IngredientCategory $ingredientCategory
 */
class Accord_Cluster extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'accord_cluster';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['accord_id', 'ingredient_category_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accord()
    {
        return $this->belongsTo('App\Accord');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ingredientCategory()
    {
        return $this->belongsTo('App\IngredientCategory');
    }
}
