<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $users_id
 * @property int $feedback_event_id
 * @property string $created_at
 * @property boolean $input
 * @property string $device
 * @property boolean $type
 * @property string $feedback
 * @property FeedbackEvent $feedbackEvent
 * @property User $user
 */
class Feedback extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['users_id', 'feedback_event_id', 'created_at', 'input', 'device', 'type', 'feedback'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedbackEvent()
    {
        return $this->belongsTo('App\FeedbackEvent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
