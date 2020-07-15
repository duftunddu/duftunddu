<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $fragrance_profile_id
 * @property string $created_at
 * @property string $updated_at
 * @property FragranceProfile $fragranceProfile
 * @property PredictionFragrance[] $predictionFragrances
 */
class Prediction extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prediction';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['fragrance_profile_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fragranceProfile()
    {
        return $this->belongsTo('App\FragranceProfile');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function predictionFragrances()
    {
        return $this->hasMany('App\PredictionFragrance');
    }
}
