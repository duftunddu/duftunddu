<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $users_id
 * @property integer $model_version_id
 * @property integer $location_id
 * @property string $created_at
 * @property string $updated_at
 * @property float $avg_temp
 * @property float $avg_hum
 * @property float $bmi
 * @property string $fragrance_type_condition
 * @property float $fragrance_type_weight
 * @property float $sustainability_heat_condition
 * @property float $sustainability_heat_weight
 * @property float $humidity_condition
 * @property float $humidity_weight
 * @property float $warm_cold_condition_1
 * @property string $warm_cold_condition_2
 * @property float $warm_cold_weight
 * @property float $sweat_condition_1
 * @property string $sweat_condition_2
 * @property float $sweat_weight
 * @property float $bmi_condition
 * @property float $bmi_weight
 * @property string $skin_condition
 * @property float $skin_weight
 * @property string $type
 * @property float $rating
 * @property string $deleted_at
 * @property Location $location
 * @property ModelVersion $modelVersion
 * @property User $user
 */
class Affecting_Factors_Data extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'affecting_factors_data';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'model_version_id', 'location_id', 'created_at', 'updated_at', 'avg_temp', 'avg_hum', 'bmi', 'fragrance_type_condition', 'fragrance_type_weight', 'sustainability_heat_condition', 'sustainability_heat_weight', 'humidity_condition', 'humidity_weight', 'warm_cold_condition_1', 'warm_cold_condition_2', 'warm_cold_weight', 'sweat_condition_1', 'sweat_condition_2', 'sweat_weight', 'bmi_condition', 'bmi_weight', 'skin_condition', 'skin_weight', 'type', 'rating', 'deleted_at'];

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
    public function modelVersion()
    {
        return $this->belongsTo('App\ModelVersion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
