<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Markdown;

use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
    	'publish_date' => 'datetime'
    ];

    public function render() {
    	return Markdown::parse( $this->content );
    }

    public function getTimeElapsedAttribute() {
    	$date = new Carbon($this->publish_date);
    	return $date->diffForHumans();
    }
}
