<?php
declare(strict_types=1);
namespace JviguyGames1994\Concurrency\Economy;

use JviguyGames1994\Concurrency\Concurrency;
use JviguyGames1994\Concurrency\Economy\BaseEconomies\BaseEconomy;
use JviguyGames1994\Concurrency\Economy\Listeners\RegisterHandler;
use pocketmine\Server;

class EconomyHandlers
{
	/** @var array $economys */
	private $economys;
	/** @var string $provider */
	private $provider;
	/** @var EconomyHandlers $instance */
	private static $instance;
	public function __construct(Concurrency $main)
	{
		Server::getInstance()->getPluginManager()->registerEvents(new RegisterHandler($this), $main);
		self::$instance = $this;
	}
	public static function getInstance(): ?EconomyHandlers {
		return self::$instance;
	}
	public function registerNewEconomy(BaseEconomy $economy, string $name){
		$this->economys[$name] = $economy;
	}
	public function getEconomy(string $name): BaseEconomy{
		if (isset($this->economys[$name])){
			return $this->economys[$name];
		}
		throw new \InvalidArgumentException("Economy $name doesnt Exist!");
	}
	public function getEconomies(){
		return$this->economys;
	}
}