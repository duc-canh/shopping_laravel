<?php

namespace App\Providers;

use App\User;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Gate;
use App\Serviecs\PermissionGateAndPolicyAccess;
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
        //$this->definePolicyGate();
        //define Permission
        $permissionGateAndPolicy = new PermissionGateAndPolicyAccess();
        $permissionGateAndPolicy->setGateAndPolicyAccess();
        // Gate::define('edit-settings', function ($user) {
        //     return $user->isAdmin;
        // });
        
        // Gate::define('list_category', function (User $user) {
        //   return $user->checkPermissionAccess(config('permissions.access.list_category'));
        // });
        Gate::define('edit_product', function (User $user,$id) {
          $product = Product::find($id);
          if($user->checkPermissionAccess('edit_product') && $user->id === $product->user_id){
              return true;
            }
          return false;
          });
        // Gate::define('add-category', function (User $user) {
        //     dd($user);
        // });
    }
    
}