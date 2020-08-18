<?php

declare(strict_types=1);

namespace JviguyGames1994\Concurrency;

use JviguyGames1994\Concurrency\Economy\EconomyHandlers;
use pocketmine\plugin\PluginBase;

class Concurrency extends PluginBase{
	private static $instance;
	public function onEnable()
	{
		self::$instance = new EconomyHandlers($this);
	}
	public static function getInstance(){
		return self::$instance;
	}
}
