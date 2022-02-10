<?php
namespace App\Providers;

use App\Models\Announcement;
use App\Services\Rushmore;
use Faker\Factory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    public function register()
    {
        $this->app->singleton(Rushmore::class, function () {
            $apiUrl = env('RUSHMORE_BASE_URI');//@todo refactor after auth implementation
            $apiKey = env('RUSHMORE_KEY');//@todo refactor after auth implementation
            $accountId = env('RUSHMORE_ACCOUNT_ID');//@todo refactor after auth implementation

            return new Rushmore($apiUrl, $apiKey, $accountId);
        });
    }

    public function boot() {
        if (env('APP_ENV') !== 'local') {
            \URL::forceScheme('https');
        }
        
        $rush_api = resolve('App\Services\Rushmore');

        view()->composer('*', function($view) use ($rush_api) {

            $view->with('user', $rush_api->getUserData());

            if( $rush_api->getUserData() == null ){
                // Don't share the other variables if we have no user
                return;
            }

            $view->with('faker', Factory::create());
            $view->with('notifications', $rush_api->getNotificationData());
//            $announcements_list = Announcement::published()->limit(12)->get(); @todo Fix after auth implementation
            $announcements_list = collect([]);
            View::share('announcements_list', $announcements_list);
        });

        // Subscription and permission directives
        Blade::if('subscription', function($subscription) use ($rush_api) {
            return $subscription == $rush_api->getUserData()->subscription;
        });
        Blade::if('permission', function($permission) use ($rush_api) {
            return in_array($permission, $rush_api->getUserData()->permissions);
        });
        Blade::if('permissions_any', function($permissions) use ($rush_api) {
            return count(array_intersect($permissions, $rush_api->getUserData()->permissions)) ? true : false;
        });
        Blade::if('permissions_all', function($permissions) use ($rush_api) {
            return count(array_intersect($permissions, $rush_api->getUserData()->permissions)) == count($permissions);
        });

        // This directive lets us push one set of styles or scripts in the
        // case of reuable components or views
        // It takes a token after the stack name in the format:
        // @pushonce('js_after:whateverName')
        // Token must follow php variable naming rules!
        Blade::directive('pushonce', function ($expression) {
            $domain = explode(':', trim(substr($expression, 1, -1)));
            $push_name = $domain[0];
            $push_sub = $domain[1];
            $isDisplayed = '__pushonce_'.$push_name.'_'.$push_sub;
            return "<?php if(!isset(\$__env->{$isDisplayed})): \$__env->{$isDisplayed} = true; \$__env->startPush('{$push_name}'); ?>";
        });
        Blade::directive('endpushonce', function ($expression) {
            return '<?php $__env->stopPush(); endif; ?>';
        });
    }
}
