<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $users_id
 * @property integer $location_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $request_status
 * @property boolean $store
 * @property boolean $webstore
 * @property string $name
 * @property string $address
 * @property string $website
 * @property float $latitude
 * @property float $longitude
 * @property string $contact_number
 * @property string $social_link
 * @property string $status
 * @property string $deleted_at
 * @property Location $location
 * @property User $user
 * @property StoreLog[] $storeLogs
 * @property StoreStock[] $storeStocks
 */
class Store extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'store';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'location_id', 'created_at', 'updated_at', 'request_status', 'store', 'webstore', 'name', 'address', 'website', 'latitude', 'longitude', 'contact_number', 'social_link', 'status', 'deleted_at'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storeLogs()
    {
        return $this->hasMany('App\StoreLog');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storeStocks()
    {
        return $this->hasMany('App\StoreStock');
    }
}
