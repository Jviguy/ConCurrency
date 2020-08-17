<?php
declare(strict_types=1);
namespace JviguyGames1994\Concurrency\Economy;

use JviguyGames1994\Concurrency\Concurrency;
use JviguyGames1994\Concurrency\Economy\BaseEconomies\BaseEconomy;

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
	}
	public static function getInstance(): ?EconomyHandlers {
		return self::$instance;
	}
	public function registerNewEconomy(BaseEconomy $economy, string $name){
		$this->economys[$name] = $economy;
	}
	public function getEconomy(string $name): ?BaseEconomy{
		return $this->economys[$name] ?? null;
	}
}