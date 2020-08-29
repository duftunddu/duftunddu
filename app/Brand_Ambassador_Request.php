<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $users_id
 * @property int $brand_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $brand_name
 * @property string $linkedin
 * @property string $email_work
 * @property string $website
 * @property boolean $status
 * @property string $deleted_at
 * @property FragranceBrand $fragranceBrand
 * @property User $user
 */
class Brand_Ambassador_Request extends Model
{
    use SoftDeletes;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'brand_ambassador_request';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'brand_id', 'created_at', 'updated_at', 'brand_name', 'linkedin', 'email_work', 'website', 'status', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fragranceBrand()
    {
        return $this->belongsTo('App\FragranceBrand', 'brand_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
