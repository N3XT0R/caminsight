<?php

namespace App\Providers;

use App\Services\Google\VideoIntelligence\Client;
use App\Services\Google\VideoIntelligence\Contracts\ClientContract;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Google\Cloud\VideoIntelligence\V1\Client\VideoIntelligenceServiceClient;

class GoogleServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(ClientContract::class, static function (Application $app) {
            return new Client(new VideoIntelligenceServiceClient(['apiKey' => $app['config']->get('services.google_cloud.GOOGLE_API_KEY')]));
        });
    }
}