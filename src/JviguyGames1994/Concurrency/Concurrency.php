<?php

declare(strict_types=1);

namespace JviguyGames1994\Concurrency;

use InvalidArgumentException;
use JviguyGames1994\Concurrency\Economy\BaseEconomies\RoundedEconomy;
use JviguyGames1994\Concurrency\Economy\EconomyHandlers;
use pocketmine\plugin\PluginBase;

class Concurrency extends PluginBase{
	
	private static $handlers;
	
	public function onEnable()
	{
		self::$handlers = new EconomyHandlers($this);
	}
	
	public static function getHandlers() : EconomyHandlers{
		return self::$instance;
	}
}
