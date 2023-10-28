<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Tmdb\Client;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\Request\AcceptJsonRequestListener;
use Tmdb\Event\Listener\Request\AdultFilterRequestListener;
use Tmdb\Event\Listener\Request\ApiTokenRequestListener;
use Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener;
use Tmdb\Event\Listener\Request\UserAgentRequestListener;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\ConfigurationRepository;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Token\Api\BearerToken;
use Symfony\Component\EventDispatcher\EventDispatcher;

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
                'api_token' => $tmdbApiToken, // This is the correct key
                'event_dispatcher' => ['adapter' => $ed]
            ]);
    
            // Registering event listeners
            $requestListener = new RequestListener($client->getHttpClient(), $ed);
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
