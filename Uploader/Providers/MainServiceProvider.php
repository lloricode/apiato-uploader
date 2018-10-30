<?php

namespace App\Containers\Uploader\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Lloricode\LaravelUploader\Providers\LaravelUploaderRouteServiceProvider;
use Lloricode\LaravelUploader\Providers\LaravelUploaderServiceProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends MainProvider
{
    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        LaravelUploaderServiceProvider::class,
        LaravelUploaderRouteServiceProvider::class,
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [// 'Foo' => Bar::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register()
    {
        parent::register();
    }
}
