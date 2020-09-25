<?php

namespace App\Providers;

use App\User;
use App\UserAction;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view_menu',function ($user){
           if($user->position_id == 1){
               return true;
           }else{
               return false;
           }

        });
        Gate::define('not_system',function ($user){
            if($user->type != 'systems'){
                return true;
            }else{
                return false;
            }
        });

        Gate::define('system',function ($user){

           if($user->type === 'systems'){
               return true;
           }else{
               return false;
           }
        });

        Gate::define('admin_lv1',function ($user){
            $action = UserAction::where('user_id','=',$user->id)->get();
            $user_system = User::where('id','=',$user->id)->where('type','=','systems')->get();
            if(sizeof($user_system) > 0) {
                if (count($action) == 1) {
                    foreach ($action as $value) {
                        if ($value->action_id == 1) {
                            return true;
                        }
                    }
                }
                return false;
            }
            return false;
        });
        Gate::define('admin_lv2',function ($user){
            $action = UserAction::where('user_id','=',$user->id)->get();
            if(count($action) == 5){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('user_lv1',function ($user){
            $action = UserAction::where('user_id','=',$user->id)->get();
            if(count($action) == 2){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('user_lv2',function ($user){
            $action = UserAction::where('user_id','=',$user->id)->get();
            $user_system = User::where('id','=',$user->id)->where('type','=','systems')->get();
            if(sizeof($user_system) > 0 ) {
                if (count($action) == 1 && Auth::user()->position_id == 3) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        });
    }
}
