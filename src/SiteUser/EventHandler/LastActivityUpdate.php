<?php namespace Source\SiteUser\EventHandler;

class LastActivityUpdate {

	/**
	 * Handle the event.
	 *
	 * @param  $event
	 * @return void
	 */
	public function handle($event)
	{
		$user = \Auth::user();
		$user->last_activity = (new \DateTime())->format('Y-m-d H:i:s');
		$user->save();
	}

}
