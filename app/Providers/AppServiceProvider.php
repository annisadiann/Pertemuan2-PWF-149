<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Kita pakai pengecekan role yang asli sekarang karena databasemu sudah admin
        Gate::define('manage-product', function (User $user) {
            return strtolower($user->role) === 'admin';
        });

        Gate::define('export-product', function (User $user) {
            return strtolower($user->role) === 'admin';
        });
    }
}