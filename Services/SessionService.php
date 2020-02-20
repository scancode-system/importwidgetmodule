<?php

namespace Modules\ImportWidget\Services;

use Illuminate\Support\Facades\Storage;

class SessionService {


	public static  function start($id)
	{
		session([$id.'.importing' => true]);
		session()->save();
	}

	public static  function end($id)
	{
		session([$id.'.importing' => false]);
		session()->save();
	}

	public static  function importing($id)
	{
		return session($id.'.importing', false);
	}

	public static  function message($id, $message = null)
	{
		if(is_null($message))
		{
			return session($id.'.message', 'N/A');
		} else {
			session([$id.'.message' => $message]);
			session()->save();
		}
	}

	public static  function widgets($id)
	{
		return collect(session($id.'.widgets', []));
	}

	public static  function widgetsAdd($id, $module, $method)
	{
		$widgets = self::widgets($id);	
		$widgets->push(['module' => $module, 'method' => $method]);
		session([$id.'.widgets' => $widgets->toArray()]);
	}	

	public static  function widgetsReset($id)
	{  
		session([$id.'.widgets' => []]);
	}

	public static  function clear($module, $method)
	{
		Storage::delete('failures/'.$module.$method);
		session()->forget($module.$method.'.new');
		session()->forget($module.$method.'.updated');
		session()->forget($module.$method.'.failures');
		session()->forget($module.$method.'.completed');
		session()->save();
	}

	public static  function new($module, $method, $increment = false)
	{
		if($increment){
			session([$module.$method.'.new' => (self::new($module, $method)+1)]);
			session()->save();
		} else {
			return session($module.$method.'.new', 0);
		}

	}

	public static  function updated($module, $method, $increment = false, $report = null)
	{
		if($increment){
			session([$module.$method.'.updated' => (self::updated($module, $method)+1)]);
			session()->save();
			Storage::append('failures/'.$module.$method, $report);
		} else {
			return session($module.$method.'.updated', 0);
		}
	}	

	public static  function failures($module, $method, $increment = false, $report = null)
	{
		if($increment){
			session([$module.$method.'.failures' => (self::failures($module, $method)+1)]);
			session()->save();
			Storage::append('failures/'.$module.$method, $report);
		} else {
			return session($module.$method.'.failures', 0);
		}
	}

	public static  function completed($module, $method, $completed = null)
	{
		if(is_null($completed))
		{
			return floor(session($module.$method.'.completed', 0));
		} else {
			session([$module.$method.'.completed' => $completed]);
			session()->save();
		}
	}

	public static  function title($module, $method, $title = null)
	{
		if(is_null($title))
		{
			return session($module.$method.'.title', null);
		} else {
			session([$module.$method.'.title' => $title]);
			session()->save();
		}
	}

}
