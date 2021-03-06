<?php

namespace App\Providers;

use App\Repositories\CalculationRepositoryInterface;
use App\Repositories\CalendarRepositoryInterface;
use App\Repositories\ClaimRepositoryInterface;
use App\Repositories\ClaimStatusRepositoryInterface;
use App\Repositories\CurrencyRepositoryInterface;
use App\Repositories\Eloquent\CalculationRepository;
use App\Repositories\Eloquent\CalendarRepository;
use App\Repositories\Eloquent\ClaimRepository;
use App\Repositories\Eloquent\ClaimStatusRepository;
use App\Repositories\Eloquent\ClaimTypeRepository;
use App\Repositories\ClaimTypeRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\CurrencyRepository;
use App\Repositories\Eloquent\FileRepository;
use App\Repositories\Eloquent\FileTypeRepository;
use App\Repositories\Eloquent\LanguageRepository;
use App\Repositories\Eloquent\NoteRepository;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\PropertyRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\FileRepositoryInterface;
use App\Repositories\FileTypeRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\NoteRepositoryInterface;
use App\Repositories\PermissionRepositoryInterface;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(ClaimTypeRepositoryInterface::class, ClaimTypeRepository::class);
        $this->app->bind(ClaimStatusRepositoryInterface::class, ClaimStatusRepository::class);
        $this->app->bind(ClaimRepositoryInterface::class, ClaimRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(FileTypeRepositoryInterface::class, FileTypeRepository::class);
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class);
        $this->app->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        $this->app->bind(NoteRepositoryInterface::class, NoteRepository::class);
        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
        $this->app->bind(CalculationRepositoryInterface::class, CalculationRepository::class);
        $this->app->bind(CalendarRepositoryInterface::class, CalendarRepository::class);
        $this->app->bind(FileTypeRepositoryInterface::class, FileTypeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
