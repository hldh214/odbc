<?php

namespace LiteSrv\Odbc;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}


	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$factory = $this->app['db'];
		$factory->extend('odbc', function($config) {
			if (!isset($config['prefix'])) {
				$config['prefix'] = '';
			}

			$connector = new Connector();
			$pdo       = $connector->connect($config);

			return new Connection($pdo, $config['database'], $config['prefix']);
		});
	}

}
