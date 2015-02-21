<?php namespace Renuval\Providers;

use Domain\Model\SiteUser;
use Domain\Observer\SiteUserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider {

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		SiteUser::observe(new SiteUserObserver);
	}

}
