<?php
declare(strict_types=1);

namespace JviguyGames1994\Concurrency\Economy\BaseEconomies;


abstract class BaseEconomy
{
	/**
	 * @return string the name of the type of economy
	 */
	abstract public function getType();
	abstract protected function getBalances();
	/**
	 * @return string The name of the economy
	 */
	abstract protected function init();
	abstract protected function getBalance(string $uuid);
	abstract public function add(string $uuid, int $amount);
	abstract public function subtract(string $uuid, int $amount);
	abstract public function get(string $uuid);
	abstract public function set(string $uuid, int $amount);
	abstract public function sum(string $uuid, int $amount);
	abstract protected function removeBalance(string $uuid);
	abstract protected function addBalance(string $uuid);
	abstract public function isRegistered(string $uuid);
	abstract public function register(string $uuid);
	abstract protected function reset(string $uuid);
}