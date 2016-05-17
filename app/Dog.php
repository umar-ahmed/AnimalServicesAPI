<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reference_num', 'name', 'age', 'size', 'gender', 'breed', 'color', 'eclawed', 'neutered', 'location', 'intake_date', 'noise_level', 'activity_level', 'friend_level', 'train_level', 'health_level', 'description', 'excerpt', 'special_needs'];

	protected $casts = [
        'location' => 'json'
    ];
    
    /**
     * Get the users associated with the given dog.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
