<?php

declare(strict_types=1);

namespace JviguyGames1994\Concurrency;

use JviguyGames1994\Concurrency\Economy\BaseEconomies\RoundedEconomy;
use JviguyGames1994\Concurrency\Economy\EconomyHandlers;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Concurrency extends PluginBase implements Listener {
	private static $instance;
	public function onEnable()
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		self::$instance = new EconomyHandlers($this);
		self::$instance->registerNewEconomy(new RoundedEconomy(), "money");
	}
	public static function getInstance(){
		return self::$instance;
	}
}
