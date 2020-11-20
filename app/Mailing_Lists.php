<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $users_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $email
 * @property boolean $newsletter
 * @property string $deleted_at
 * @property User $user
 */
class Mailing_Lists extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'mailing_lists';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'created_at', 'updated_at', 'email', 'newsletter', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
