<?php

declare(strict_types=1);

namespace JviguyGames1994\Concurrency;

use InvalidArgumentException;
use JviguyGames1994\Concurrency\Economy\BaseEconomies\RoundedEconomy;
use JviguyGames1994\Concurrency\Economy\EconomyHandlers;
use pocketmine\plugin\PluginBase;

class Concurrency extends PluginBase{
	private static $instance;
	public function onEnable()
	{
		self::$instance = new EconomyHandlers($this);
		$starting = 0; $max = PHP_INT_MAX;
		self::$instance->registerNewEconomy(new RoundedEconomy($starting,$max), "Money");
		try {
			$economygroup = self::$instance->getEconomy("Money");
			} catch (InvalidArgumentException $exception){
				$this->getLogger()->info($exception->getMessage());
		}
	}
	public static function getInstance(){
		return self::$instance;
	}
}
