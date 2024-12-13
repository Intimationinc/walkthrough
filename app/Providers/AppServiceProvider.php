<?php

namespace App\Providers;

use App\Contracts\SubjectRepository;
use App\Repositories\SubjectDBRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SubjectRepository::class, function ($app) {
            return $app->make(SubjectDBRepository::class);
        });
    }
    public function boot(): void
    {
        //
    }
}
