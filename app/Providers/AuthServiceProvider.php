<?php

namespace App\Providers;

use App\User;
use App\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        // Gate::define('edit-settings', function ($user) {
        //     return $user->isAdmin;
        // });

        Gate::define('category_list', function (User $user) {
          return $user->checkPermissionAccess('list_category');
        });
        Gate::define('menu_list', function (User $user) {
            return $user->checkPermissionAccess('list_menu');
          });
        // Gate::define('add-category', function (User $user) {
        //     dd($user);
        // });
    }
}
