<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;
use Laravel\Sanctum\Sanctum;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->instance(LoginResponse::class, new class implements LoginResponse{
            public function toResponse($request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
            {
                if($request->wantsJson()){
                    $user = User::where('email', $request->email)->first();
                    return response()->json([
                        "message" => "You are successfully logged in",
                        "token" => $user->createToken($request->email)->plainTextToken
                    ]);
                }
                return redirect()->intended(Fortify::redirects('login'));
            }
        });

        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
            public function toResponse($request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
            {
                $user = User::where('email', $request->email)->first();
                return $request->wantsJson() ? response()->json([
                    "message" => "Registration successfull.",
                    "token" => $user->createToken($request->email)->plainTextToken
                ])
                    : redirect()->intended(Fortify::redirects('register'));
            }
        });
}

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

    }
}
