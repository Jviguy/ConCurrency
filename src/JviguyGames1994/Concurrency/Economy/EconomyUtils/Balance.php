<?php
declare(strict_types=1);
namespace JviguyGames1994\Concurrency\Economy\EconomyUtils\BaseEconomies;

use http\Exception\InvalidArgumentException;
use JviguyGames1994\Concurrency\Economy\BaseEconomy;

class Balance
{
	//properties
	private $owner;
	/** @var string $player the players name that owns this balance */
	private $player;
	/** @var int $amount the amount of the currency the player has */
	private $amount;
	//constructor
	public function __construct(float $startingamount=0){
		$this->amount = $startingamount;
	}
	//functions
	/**
	 * returns a class of the economy that owns this balance
	 */
	public function getAmount(): int{
		return $this->amount;
	}
	public function addAmount(int $amount){
		$this->amount += $amount;
	}
	public function setAmount(int $amount){
		$this->amount = $amount;
	}
	public function subtractAmount(int $amount){
		$this->amount -= $amount;
	}
}