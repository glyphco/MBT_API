<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Tymon\JWTAuth\Providers\LumenServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->register(\Tymon\JWTAuth\Providers\LumenServiceProvider::class);
		$this->app->register(\Silber\Bouncer\BouncerServiceProvider::class);

		class_alias('Silber\Bouncer\BouncerFacade', 'Bouncer');
	}
}
