<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property boolean $id
 * @property integer $users_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property User $user
 * @property Feedback[] $feedback
 */
class Feedback_Type extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'feedback_type';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'boolean';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'created_at', 'updated_at', 'name'];

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
    public function feedback()
    {
        return $this->hasMany('App\Feedback');
    }
}
