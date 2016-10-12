<?php
namespace Core;

class EventDispatcher {

	private static $listeners = array();

	public static function addListener($event, $listener, $method){
		self::$listeners[$event][] = array($listener, $method);
	} 

	public static function dispatch($event, $event){
		foreach(self::$listeners as $listeners) {
			foreach($listeners as $listener) {
				$method = $listener[1];
				call_user_func_array(array($listener[0], $method), array($event));
			}
		}
	} 
}