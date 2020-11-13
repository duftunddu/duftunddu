<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $users_id
 * @property boolean $feedback_type_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $device
 * @property string $platform
 * @property string $browser
 * @property string $version
 * @property FeedbackType $feedbackType
 * @property User $user
 * @property FeedbackComment[] $feedbackComments
 * @property FeedbackForm[] $feedbackForms
 */
class Feedback extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'feedback_type_id', 'created_at', 'updated_at', 'device', 'platform', 'browser', 'version'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedbackType()
    {
        return $this->belongsTo('App\FeedbackType');
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
    public function feedbackComments()
    {
        return $this->hasMany('App\FeedbackComment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedbackForms()
    {
        return $this->hasMany('App\FeedbackForm');
    }
}
