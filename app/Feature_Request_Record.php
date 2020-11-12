<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $feature_request_id
 * @property integer $users_id
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $vote_status
 * @property string $deleted_at
 * @property FeatureRequest $featureRequest
 * @property User $user
 */
class Feature_Request_Record extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'feature_request_record';

    /**
     * @var array
     */
    protected $fillable = ['feature_request_id', 'users_id', 'created_at', 'updated_at', 'vote_status', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function featureRequest()
    {
        return $this->belongsTo('App\FeatureRequest');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
