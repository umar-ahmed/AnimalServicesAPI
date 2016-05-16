<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{

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
