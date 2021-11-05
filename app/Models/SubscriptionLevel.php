<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Announcement;

class SubscriptionLevel extends Model {
    protected $guarded = [];

    public function announcements() {
    	return $this->belongsToMany(Announcement::class);
    }
}
