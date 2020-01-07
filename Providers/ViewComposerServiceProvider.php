<?php

namespace Modules\ImportWidget\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\ImportWidget\Http\ViewComposers\IndexComposer;


class ViewComposerServiceProvider extends ServiceProvider {

	public function boot() 
	{
		View::composer('importwidget::index', IndexComposer::class);
	}

	public function register() 
	{
        //
	}

}
