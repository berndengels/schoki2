<?php
namespace App\Providers;

use Illuminate\Support\Str;
use App\Webhook\MyWebhookConfig;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Webhook\MyWebhookConfigRepository;
use Spatie\WebhookClient\Exceptions\InvalidConfig;
use App\Http\Controllers\Payment\WebhookController;

class MyWebhookClientServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::macro('myWebhooks', fn (string $url, string $name = 'default') => Route::post($url, WebhookController::class)->name("webhook-client-{$name}"));

        $this->app->singleton(MyWebhookConfigRepository::class, function () {
            $configRepository = new MyWebhookConfigRepository();

            collect(config('webhook.configs'))
                ->map(fn (array $config) => new MyWebhookConfig($config))
                ->each(function (MyWebhookConfig $webhookConfig) use ($configRepository) {
                    $configRepository->addConfig($webhookConfig);
                });

            return $configRepository;
        });

        $this->app->bind(MyWebhookConfig::class, function () {
            $routeName      = Route::currentRouteName();
            $configName     = Str::after($routeName, 'webhook-client-');
            $webhookConfig  = app(MyWebhookConfigRepository::class)->getConfig($configName);

            if (is_null($webhookConfig)) {
                throw InvalidConfig::couldNotFindConfig($configName);
            }

            return $webhookConfig;
        });
    }
/*
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/webhook-client.php', 'webhook-client');
    }
*/
}
