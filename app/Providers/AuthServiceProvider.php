<?php

namespace App\Providers;

use App\Models\Task;
use App\Policies\TaskPolicy;
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
        Task::class => TaskPolicy::class, // Register your TaskPolicy
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-task', [TaskPolicy::class, 'view']);
        Gate::define('update-task', [TaskPolicy::class, 'update']);
        Gate::define('delete-task', [TaskPolicy::class, 'delete']);
        $this->registerPolicies(); // Register the policies defined in $policies array

        // Optionally, you can register additional gates here if necessary
    }
}
