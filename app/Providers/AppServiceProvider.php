<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Gate::define('admin', fn (User $user) => $user->is_admin === true);

        $this->configureRateLimiters();
    }

    private function configureRateLimiters(): void
    {
        $tooMany = fn (string $text) => fn () => response()->json(['message' => $text], 429);

        RateLimiter::for('chat-send', function (Request $request) use ($tooMany) {
            // Admin (Jeremia) bebas bales tanpa batas
            if ($request->user()?->is_admin) {
                return Limit::none();
            }

            $limits = config('portfolio.chat');

            return [
                Limit::perMinute($limits['per_minute'])->by('chat-m:'.$request->ip())
                    ->response($tooMany('Slow down a little — try again in a minute.')),
                Limit::perDay($limits['per_day'])->by('chat-d:'.$request->ip())
                    ->response($tooMany("You've reached today's message limit.")),
            ];
        });

        RateLimiter::for('smart-talk', function (Request $request) use ($tooMany) {
            $limits = config('portfolio.smart_talk');

            return [
                Limit::perMinute($limits['per_minute'])->by('talk-m:'.$request->ip())
                    ->response($tooMany('Too many questions at once — wait a minute and try again.')),
                Limit::perDay($limits['per_day'])->by('talk-d:'.$request->ip())
                    ->response($tooMany("You've reached today's Smart Talk limit. Feel free to use the Contact page.")),
            ];
        });
    }
}
