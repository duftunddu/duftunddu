<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property int $fragrance_id
 * @property int $ingredient_id
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $note
 * @property boolean $strength
 * @property Fragrance $fragrance
 * @property Ingredient $ingredient
 */
class Fragrance_Ingredient extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'fragrance_ingredient';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['fragrance_id', 'ingredient_id', 'created_at', 'updated_at', 'note', 'strength'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fragrance()
    {
        return $this->belongsTo('App\Fragrance');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ingredient()
    {
        return $this->belongsTo('App\Ingredient');
    }
}
