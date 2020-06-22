<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $users_id
 * @property string $created_at
 * @property boolean $type
 * @property User $user
 */
class Users_Log extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'users_log';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'created_at', 'type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
