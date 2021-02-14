<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $store_id
 * @property int $fragrance_brand_id
 * @property int $fragrance_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $fragrance_brand_name
 * @property string $fragrance_name
 * @property boolean $available
 * @property string $deleted_at
 * @property FragranceBrand $fragranceBrand
 * @property Fragrance $fragrance
 * @property Store $store
 * @property StoreLog[] $storeLogs
 */
class Store_Stock extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'store_stock';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['store_id', 'fragrance_brand_id', 'fragrance_id', 'created_at', 'updated_at', 'fragrance_brand_name', 'fragrance_name', 'available', 'deleted_at'];

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
    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storeLogs()
    {
        return $this->hasMany('App\StoreLog');
    }
}
