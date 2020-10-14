<?php

namespace App\Providers;

use App\Notification;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add([
                'text'    => 'Thông báo',
                'icon'    => 'fas fa-clipboard-list',
                'label'   => $count_notification = DB::table('notifications')
                            ->where('user_accept','like','%'.Auth::id().'%')
                            ->count('id')   ,
                'url'     => '/user2/notification',
                'can'     => 'user_lv2',
            ]);
        });
    }
}
