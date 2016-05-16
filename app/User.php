<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{  
    
    /**
     * Get the dogs associated with the given user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dogs() {
        return $this->belongsToMany('App\Dog')->withTimestamps();
    }
}