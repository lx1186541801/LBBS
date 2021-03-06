<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // 授权策略注册
        
        $this->registerPolicies();

        // 修改策略发现逻辑
        Gate::guessPolicyNamesUsing(function ($modelClass)
        {
            // 动态返回模型对应的策略名称
            return 'App\Policies\\' . class_basename($modelClass) . 'Policy';
        });

    }
}
