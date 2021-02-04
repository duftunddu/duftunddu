<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $users_id
 * @property integer $location_id
 * @property int $fragrance_brand_id
 * @property int $fragrance_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $fragrance_brand_name
 * @property string $fragrance_name
 * @property float $longevity
 * @property float $suitability
 * @property float $sustainability
 * @property string $apply_time
 * @property string $wear_off_time
 * @property float $indoor_time_percentage
 * @property boolean $number_of_sprays
 * @property float $sillage
 * @property boolean $like
 * @property float $temp_avg
 * @property float $hum_avg
 * @property float $dew_point_avg
 * @property float $uv_index_avg
 * @property float $temp_feels_like_avg
 * @property float $atm_pressure_avg
 * @property float $clouds_avg
 * @property float $visibility_avg
 * @property float $wind_speed_avg
 * @property float $rain_avg
 * @property float $snow_avg
 * @property string $weather_main
 * @property string $weather_description
 * @property string $deleted_at
 * @property FragranceBrand $fragranceBrand
 * @property Fragrance $fragrance
 * @property Location $location
 * @property User $user
 */
class User_Fragrance_Review extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user_fragrance_review';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'location_id', 'fragrance_brand_id', 'fragrance_id', 'created_at', 'updated_at', 'fragrance_brand_name', 'fragrance_name', 'longevity', 'suitability', 'sustainability', 'apply_time', 'wear_off_time', 'indoor_time_percentage', 'number_of_sprays', 'sillage', 'like', 'temp_avg', 'hum_avg', 'dew_point_avg', 'uv_index_avg', 'temp_feels_like_avg', 'atm_pressure_avg', 'clouds_avg', 'visibility_avg', 'wind_speed_avg', 'rain_avg', 'snow_avg', 'weather_main', 'weather_description', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fragranceBrand()
    {
        return $this->belongsTo('App\FragranceBrand');
    }

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
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
