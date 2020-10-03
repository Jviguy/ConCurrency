<?php
declare(strict_types=1);

namespace JviguyGames1994\Concurrency\Economy\BaseEconomies;

use Exception;
use JviguyGames1994\Concurrency\Economy\EconomyUtils\BaseEconomies\Balance;
use JviguyGames1994\Concurrency\Economy\Events\AddMoneyEvent;
use JviguyGames1994\Concurrency\Economy\Events\SubtractMoneyEvent;
use pocketmine\Server;

class RoundedEconomy extends BaseEconomy
{

	//properties
	/** @var array $balances the balances of all registered players */
	protected $balances;
	/**
	 * @var int $startingamount
	 */
	protected $startingamount;
	/**
	 * @var int $moneycap
	 */
	protected $moneycap;
	//constructor
	public function __construct(int $startingamount=0, int $moneycap=PHP_INT_MAX){
		$this->startingamount = $startingamount;
		$this->moneycap = $moneycap;
		$this->init();
	}
	//Functions
	public function getType()
	{
		return self::class;
	}

	protected function getBalances(): ?array
	{
		return $this->balances;
	}
	protected function removeBalance(string $uuid){
		unset($this->balances[$uuid]);
	}
	protected function addBalance(string $uuid){
		$this->balances[$uuid] = new Balance($this->startingamount);
	}

	public function register(string $uuid)
	{
		$this->addBalance($uuid);
	}

	protected function getBalance(string $uuid): Balance
	{
		if (isset($this->getBalances()[$uuid])){
			return $this->getBalances()[$uuid];
		} else {
			throw new \InvalidArgumentException("UUID {$uuid} Is not registered!");
		}
	}

	public function add(string $uuid, int $amount)
	{
		$ev = new AddMoneyEvent($uuid, $amount);
		$ev->call();
		if ($ev->isCancelled()){
			return;
		}
		$balance = $this->getBalance($uuid);
		$balance->addAmount($amount);
	}

	public function subtract(string $uuid, int $amount)
	{
		$ev = new SubtractMoneyEvent($uuid, $amount);
		$ev->call();
		if ($ev->isCancelled()){
			return;
		}
		$b = $this->getBalance($uuid);
		$b->subtractAmount($amount);
	}

	public function get(string $uuid)
	{
		return $this->getBalance($uuid)->getAmount();
	}

	public function set(string $uuid, int $amount)
	{
		$b = $this->getBalance($uuid);
		if ($amount ===$b->getAmount()){return;}
		if ($amount < $b->getAmount()){
			$ev = new SubtractMoneyEvent($uuid, $amount);
		} else{
			$ev = new AddMoneyEvent($uuid, $amount);
		}
		$ev->call();
		if (!$ev->isCancelled()){
			$b->setAmount((int)$ev->getChange());
		}
	}

	public function sum(string $uuid, int $amount)
	{
		if ($amount < 0){
			$ev = new SubtractMoneyEvent($uuid, $amount);
		} else {
			$ev = new AddMoneyEvent($uuid, $amount);
		}
		$ev->call();
		if ($ev->isCancelled()){
			return;
		}
			$b = $this->getBalance($uuid);
			$b->addAmount((int)$ev->getChange());
	}

	public function isRegistered(string $uuid): bool{
		try {
			$this->getBalances()[$uuid];
		} catch (Exception $exception) {
			return false;
		}
		return true;
	}

	protected function init()
	{
		foreach (Server::getInstance()->getOnlinePlayers() as $player) {
			$this->addBalance($player->getName());
		}
	}

	protected function reset(string $uuid)
	{
		$b = $this->getBalance($uuid);
		$b->setAmount($this->startingamount);
	}
}