<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Markdown;
use App\Models\SubscriptionLevel;
use Carbon\Carbon;

class Announcement extends Model {
    use HasFactory;

    protected $guarded = [];

    // Announcement content is written in markdown, and that is how it
    // is stored in the DB. So it must be translated to html when displayed
    protected $casts = [
        'publish_start_date' => 'datetime',
        'publish_end_date' => 'datetime'
    ];

    public function render() {
    	return Markdown::parse( $this->content );
    }

    public function getTimeElapsedAttribute() {
    	$date = new Carbon($this->publish_start_date);
    	return $date->diffForHumans();
    }

    public function isPublished() {
    	return $this->publish_start_date < Carbon::now()
            && $this->publish_end_date > Carbon::now();
    }

    public function scopePublished($query) {
        $rush_api = resolve('App\Services\Rushmore');
        $sub_level = SubscriptionLevel::where('name', $rush_api->getUserData()->subscription)->first();
        $sub_level = $sub_level->id;

    	return $query->where('publish_start_date', '<', Carbon::now())
        ->where('publish_end_date', '>', Carbon::now())
    	->where('status', 'scheduled')
        ->whereHas('subscriptionLevels', function ($query) use ($sub_level) {
            $query->where('subscription_level_id', $sub_level);
        })
    	->orderBy('publish_start_date', 'desc');
    }

    public function subscriptionLevels() {
        return $this->belongsToMany(SubscriptionLevel::class);
    }
}
