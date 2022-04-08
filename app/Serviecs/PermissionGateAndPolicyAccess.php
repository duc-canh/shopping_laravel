<?php

namespace App\Serviecs;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess{
    public function setGateAndPolicyAccess(){
       $this->definePolicyGate();
    }
    public function definePolicyGate(){
        Gate::define('list_category','App\Policies\CategoryPolicy@view');
        Gate::define('add_category','App\Policies\CategoryPolicy@create');
        Gate::define('update_category','App\Policies\CategoryPolicy@update');
        Gate::define('delete_category','App\Policies\CategoryPolicy@delete');
    }
}