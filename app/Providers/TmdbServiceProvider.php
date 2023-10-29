<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Tmdb\Event\Listener\Psr6CachedRequestListener;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\Request\AcceptJsonRequestListener;
use Tmdb\Event\Listener\Request\AdultFilterRequestListener;
use Tmdb\Event\Listener\Request\ApiTokenRequestListener;
use Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\ConfigurationRepository;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Client;

class TmdbServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, function ($app) {
            $tmdbApiToken = config('tmdb.api_key');
    
            $ed = new EventDispatcher();
    
            $client = new Client([
                'api_token' => $tmdbApiToken,
                'event_dispatcher' => ['adapter' => $ed]
            ]);
    
            // Set up caching
            $cache = new FilesystemAdapter('php-tmdb', 86400, __DIR__ . '/../../storage/framework/cache/data');
            $requestListener = new Psr6CachedRequestListener(
                $client->getHttpClient(),
                $client->getEventDispatcher(),
                $cache,
                $client->getHttpClient()->getPsr17StreamFactory(),
                []
            );
    
            // Registering event listeners
            $ed->addListener(RequestEvent::class, $requestListener);
    
            $apiTokenListener = new ApiTokenRequestListener($client->getToken());
            $ed->addListener(BeforeRequestEvent::class, $apiTokenListener);
    
            $acceptJsonListener = new AcceptJsonRequestListener();
            $ed->addListener(BeforeRequestEvent::class, $acceptJsonListener);
    
            $jsonContentTypeListener = new ContentTypeJsonRequestListener();
            $ed->addListener(BeforeRequestEvent::class, $jsonContentTypeListener);
            
            $adultFilterListener = new AdultFilterRequestListener(true);
            $ed->addListener(BeforeRequestEvent::class, $adultFilterListener);
    
            return $client;
        });

        $this->app->singleton(ImageHelper::class, function ($app) {
            $client = $app->make(Client::class); // Get the Tmdb client instance
            $configRepository = new ConfigurationRepository($client);
            $config = $configRepository->load();
            return new ImageHelper($config);
        });
    }
}
