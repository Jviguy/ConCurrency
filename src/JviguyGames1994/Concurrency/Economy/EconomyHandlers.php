<?php
declare(strict_types=1);
namespace JviguyGames1994\Concurrency\Economy;

use JviguyGames1994\Concurrency\Concurrency;
use JviguyGames1994\Concurrency\Economy\BaseEconomies\BaseEconomy;
use JviguyGames1994\Concurrency\Economy\Listeners\RegisterHandler;
use pocketmine\Server;

final class EconomyHandlers
{
	/** @var BaseEconomy[] $economys */
	private $economys;
	/** @var string $provider */
	private $provider;

	public function __construct(Concurrency $main)
	{
		Server::getInstance()->getPluginManager()->registerEvents(new RegisterHandler($this), $main);
	}
	
	public function registerNewEconomy(BaseEconomy $economy, string $name){
		$this->economys[$name] = $economy;
	}
	
	public function getEconomy(string $name): BaseEconomy{
		try{
			return $this->economys[$name];
		} catch (\ErrorException $exception){
			throw new \InvalidArgumentException("economy $name doesnt Exist!");
		} //in php8 you will be able to throw exceptions with the null coalescing operator
	}
	
	public function getEconomies(){
		return $this->economys;
	}
}
