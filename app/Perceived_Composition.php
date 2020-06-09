<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $perceiver_id
 * @property int $ingredient_id
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $note
 * @property boolean $strength
 * @property Ingredient $ingredient
 * @property Perceiver $perceiver
 */
class Perceived_Composition extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'perceived_composition';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['perceiver_id', 'ingredient_id', 'created_at', 'updated_at', 'note', 'strength'];

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
    public function perceiver()
    {
        return $this->belongsTo('App\Perceiver');
    }
}
