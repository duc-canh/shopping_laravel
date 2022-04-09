<?php

namespace App\Serviecs;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess{
    public function setGateAndPolicyAccess(){
       $this->definePolicyGateCategory();
       $this->definePolicyGateMenu();
       $this->definePolicyGateProduct();
       $this->definePolicyGateSlider();
       $this->definePolicyGateUser();
       $this->definePolicyGateRole();
       $this->definePolicyGateSetting();
    }
    public function definePolicyGateCategory(){
        Gate::define('list_category','App\Policies\CategoryPolicy@view');
        Gate::define('add_category','App\Policies\CategoryPolicy@create');
        Gate::define('delete_category','App\Policies\CategoryPolicy@delete');
    }
    public function definePolicyGateMenu(){
        Gate::define('list_menu','App\Policies\CategoryPolicy@view');
        Gate::define('add_menu','App\Policies\CategoryPolicy@create');
        Gate::define('update_menu','App\Policies\CategoryPolicy@update');
        Gate::define('delete_menu','App\Policies\CategoryPolicy@delete');
    }
    public function definePolicyGateProduct(){
        Gate::define('list_product','App\Policies\CategoryPolicy@view');
        Gate::define('add_product','App\Policies\CategoryPolicy@create');
        Gate::define('update_product','App\Policies\CategoryPolicy@update');
        Gate::define('delete_product','App\Policies\CategoryPolicy@delete');
    }
    public function definePolicyGateSlider(){
        Gate::define('list_slider','App\Policies\CategoryPolicy@view');
        Gate::define('add_slider','App\Policies\CategoryPolicy@create');
        Gate::define('update_slider','App\Policies\CategoryPolicy@update');
        Gate::define('delete_slider','App\Policies\CategoryPolicy@delete');
    }
    public function definePolicyGateUser(){
        Gate::define('list_user','App\Policies\CategoryPolicy@view');
        Gate::define('add_user','App\Policies\CategoryPolicy@create');
        Gate::define('update_user','App\Policies\CategoryPolicy@update');
        Gate::define('delete_user','App\Policies\CategoryPolicy@delete');
    }
    public function definePolicyGateRole(){
        Gate::define('list_role','App\Policies\CategoryPolicy@view');
        Gate::define('add_role','App\Policies\CategoryPolicy@create');
        Gate::define('edit_role','App\Policies\CategoryPolicy@update');
        Gate::define('delete_role','App\Policies\CategoryPolicy@delete');
    }
    public function definePolicyGateSetting(){
        Gate::define('list_setting','App\Policies\CategoryPolicy@view');
        Gate::define('add_setting','App\Policies\CategoryPolicy@create');
        Gate::define('update_setting','App\Policies\CategoryPolicy@update');
        Gate::define('delete_setting','App\Policies\CategoryPolicy@delete');
    }
}