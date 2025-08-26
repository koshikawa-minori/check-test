<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;

use App\Actions\Fortify\CreateNewUser;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

use App\Http\Responses\RegisterResponse;
use App\Http\Responses\LoginResponse;
use App\Http\Responses\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{

  public function register(): void
  {
    $this->app->singleton(RegisterResponseContract::class, RegisterResponse::class);
    $this->app->singleton(LoginResponseContract::class,    LoginResponse::class);
    $this->app->singleton(LogoutResponseContract::class,   LogoutResponse::class);
  }

  public function boot(): void
  {
    Fortify::createUsersUsing(CreateNewUser::class);

    Fortify::registerView(fn() => view('register'));
    Fortify::loginView(fn() => view('login'));

    RateLimiter::for('login', function (Request $request) {
      $email = (string) $request->email;
      return Limit::perMinute(10)->by($email . $request->ip());
    });

  }
}
