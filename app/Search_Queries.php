<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $users_detail_id
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
 * @property string $query
 * @property UsersDetail $usersDetail
 */
class Search_Queries extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'search_queries';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['users_detail_id', 'created_at', 'updated_at', 'gender', 'profession', 'dob', 'age', 'skin_type', 'sweat', 'height', 'weight', 'country', 'city', 'climate', 'season', 'query'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usersDetail()
    {
        return $this->belongsTo('App\UsersDetail');
    }
}
