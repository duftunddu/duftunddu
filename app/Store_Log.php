<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $store_id
 * @property integer $users_id
 * @property integer $location_id
 * @property integer $store_customer_feature_log_id
 * @property integer $store_stock_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $store_type
 * @property string $deleted_at
 * @property Location $location
 * @property StoreCustomerFeatureLog $storeCustomerFeatureLog
 * @property Store $store
 * @property StoreStock $storeStock
 * @property User $user
 */
class Store_Log extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'store_log';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['store_id', 'users_id', 'location_id', 'store_customer_feature_log_id', 'store_stock_id', 'created_at', 'updated_at', 'store_type', 'deleted_at'];

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
    public function storeCustomerFeatureLog()
    {
        return $this->belongsTo('App\StoreCustomerFeatureLog');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storeStock()
    {
        return $this->belongsTo('App\StoreStock');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
