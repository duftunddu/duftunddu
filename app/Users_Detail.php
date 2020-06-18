<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $users_id
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $gender
 * @property boolean $profession
 * @property string $dob
 * @property boolean $age
 * @property boolean $skin_type
 * @property boolean $sweat
 * @property float $height
 * @property float $weight
 * @property boolean $country
 * @property boolean $city
 * @property boolean $climate
 * @property boolean $season
 * @property string $details
 * @property boolean $status
 * @property User $user
 * @property Perceiver[] $perceivers
 * @property SearchQuery[] $searchQueries
 */
class Users_Detail extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'users_detail';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'created_at', 'updated_at', 'gender', 'profession', 'dob', 'age', 'skin_type', 'sweat', 'height', 'weight', 'country', 'city', 'climate', 'season', 'details', 'status'];

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
    public function perceivers()
    {
        return $this->hasMany('App\Perceiver');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function searchQueries()
    {
        return $this->hasMany('App\SearchQuery');
    }
}
