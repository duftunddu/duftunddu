<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $prediction_fragrance_id
 * @property int $fragrance_id
 * @property string $created_at
 * @property boolean $review
 * @property Fragrance $fragrance
 * @property PredictionFragrance $predictionFragrance
 */
class Prediction_Fragrance_Review extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prediction_fragrance_review';

    /**
     * @var array
     */
    protected $fillable = ['prediction_fragrance_id', 'fragrance_id', 'created_at', 'review'];

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
    public function predictionFragrance()
    {
        return $this->belongsTo('App\PredictionFragrance');
    }
}
