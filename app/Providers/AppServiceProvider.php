<?php

namespace App\Providers;

use App\Domain\AliasGeneratorInterface;
use App\Domain\LinkRepositoryInterface;
use App\Domain\PrefixRepositoryInterface;
use App\Repositories\DbLinkRepository;
use App\Repositories\DbPrefixRepository;
use App\Services\AliasGenerator;
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
        $this->app->bind(LinkRepositoryInterface::class, DbLinkRepository::class);
        $this->app->bind(AliasGeneratorInterface::class, AliasGenerator::class);;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
