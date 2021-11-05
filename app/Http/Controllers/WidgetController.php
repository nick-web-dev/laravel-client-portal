<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Mail\Markdown;

use App\Models\DashWidget;

class WidgetController extends Controller
{
    public function index(Request $request, $widget_class){
        $widget_class = "App\Widgets\\$widget_class";
        
        if( class_exists($widget_class) ){
            if( $request->html ){
                return (new $widget_class)->run();
            } else {
                return $widget_class::getDefaults();
            }
        } else {
            abort(404);
        }
    }

    public static function getAllWidgets(){
        $files = File::files(base_path('app/Widgets'));
        $result = [];
        foreach ($files as $file) {
            $widget_name = $file->getBasename( '.' . $file->getExtension() );
            $widget_class = "App\Widgets\\$widget_name";
            if( class_exists($widget_class) ){
                $data = [];
                $data['defaults'] = $widget_class::getDefaults(false);

                $meta_path = base_path("app/Widgets/Meta/$widget_name.md");
                if( File::exists($meta_path) ){
                    $data['description'] = Markdown::parse(File::get( $meta_path ));
                }

                $result[$widget_name] = $data;
            }
        }
        return $result;
    }

    public function save(Request $request){
    	$user = Auth::user();
    	
    	foreach ($request->widgets as $widget) {
    		$user->dashWidgets()->updateOrCreate(
    			['id' => $widget['id']],
    			$widget
    		);
    	}
    }
}
