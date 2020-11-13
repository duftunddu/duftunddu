<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $feedback_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $comment
 * @property Feedback $feedback
 */
class Feedback_Comment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'feedback_comment';

    /**
     * @var array
     */
    protected $fillable = ['feedback_id', 'created_at', 'updated_at', 'comment'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedback()
    {
        return $this->belongsTo('App\Feedback');
    }
}
