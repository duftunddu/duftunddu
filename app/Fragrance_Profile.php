<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $users_id
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $user_check
 * @property boolean $gender
 * @property string $dob
 * @property boolean $profession
 * @property boolean $skin_type
 * @property boolean $sweat
 * @property float $height
 * @property float $weight
 * @property boolean $country
 * @property boolean $city
 * @property boolean $climate
 * @property boolean $season
 * @property string $detail
 * @property boolean $status
 * @property User $user
 * @property Prediction[] $predictions
 */
class Fragrance_Profile extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'fragrance_profile';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'created_at', 'updated_at', 'user_check', 'gender', 'dob', 'profession', 'skin_type', 'sweat', 'height', 'weight', 'country', 'city', 'climate', 'season', 'detail', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function predictions()
    {
        return $this->hasMany('App\Prediction');
    }
}
