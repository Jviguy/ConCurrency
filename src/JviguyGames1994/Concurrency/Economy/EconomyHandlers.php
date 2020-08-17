<?php
declare(strict_types=1);
namespace JviguyGames1994\Concurrency\Economy;

use http\Exception\InvalidArgumentException;
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
	}
	public static function getInstance(): ?EconomyHandlers {
		return self::$instance;
	}
	public function registerNewEconomy(BaseEconomy $economy, string $name){
		$this->economys[$name] = $economy;
	}
	public function getEconomy(string $name): ?BaseEconomy{
		try{
			return $this->economys[$name];
		} catch (\ErrorException $exception){
			throw new InvalidArgumentException("economy $name doesnt Exist!");
		}
	}
	public function getEconomies(): array{
		return$this->economys;
	}
}