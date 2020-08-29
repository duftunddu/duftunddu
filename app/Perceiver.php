<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property int $fragrance_id
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $gender
 * @property boolean $profession
 * @property boolean $age
 * @property boolean $skin_type
 * @property boolean $sweat
 * @property float $height
 * @property boolean $bodyshape
 * @property float $weight
 * @property boolean $country
 * @property boolean $city
 * @property boolean $climate
 * @property boolean $season
 * @property string $comment
 * @property boolean $like
 * @property Fragrance $fragrance
 * @property PerceivedComposition[] $perceivedCompositions
 * @property PerceiverAccord[] $perceiverAccords
 */
class Perceiver extends Model
{
    use SoftDeletes;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'perceiver';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['fragrance_id', 'created_at', 'updated_at', 'gender', 'profession', 'age', 'skin_type', 'sweat', 'height', 'bodyshape', 'weight', 'country', 'city', 'climate', 'season', 'comment', 'like'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fragrance()
    {
        return $this->belongsTo('App\Fragrance');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perceivedCompositions()
    {
        return $this->hasMany('App\PerceivedComposition');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perceiverAccords()
    {
        return $this->hasMany('App\PerceiverAccord');
    }
}
