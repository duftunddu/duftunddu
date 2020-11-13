<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $feedback_id
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $user_interface
 * @property boolean $functionality
 * @property boolean $recommend
 * @property Feedback $feedback
 */
class Feedback_Form extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'feedback_form';

    /**
     * @var array
     */
    protected $fillable = ['feedback_id', 'created_at', 'updated_at', 'user_interface', 'functionality', 'recommend'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedback()
    {
        return $this->belongsTo('App\Feedback');
    }
}
