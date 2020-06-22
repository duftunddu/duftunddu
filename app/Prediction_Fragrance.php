<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $prediction_id
 * @property int $fragrance_id
 * @property string $created_at
 * @property Fragrance $fragrance
 * @property Prediction $prediction
 * @property PredictionFragranceReview[] $predictionFragranceReviews
 */
class Prediction_Fragrance extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prediction_fragrance';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['prediction_id', 'fragrance_id', 'created_at'];

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
    public function prediction()
    {
        return $this->belongsTo('App\Prediction');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function predictionFragranceReviews()
    {
        return $this->hasMany('App\PredictionFragranceReview');
    }
}
