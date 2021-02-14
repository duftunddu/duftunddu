<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $profession_id
 * @property boolean $skin_type_id
 * @property boolean $climate_id
 * @property boolean $season_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $gender
 * @property string $dob
 * @property boolean $sweat
 * @property float $height
 * @property float $weight
 * @property string $deleted_at
 * @property Climate $climate
 * @property Profession $profession
 * @property Season $season
 * @property SkinType $skinType
 * @property StoreLog[] $storeLogs
 */
class Store_Customer_Feature_Log extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'store_customer_feature_log';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['profession_id', 'skin_type_id', 'climate_id', 'season_id', 'created_at', 'updated_at', 'gender', 'dob', 'sweat', 'height', 'weight', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function climate()
    {
        return $this->belongsTo('App\Climate');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profession()
    {
        return $this->belongsTo('App\Profession');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skinType()
    {
        return $this->belongsTo('App\SkinType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storeLogs()
    {
        return $this->hasMany('App\StoreLog');
    }
}
