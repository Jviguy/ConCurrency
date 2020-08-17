<?php
declare(strict_types=1);

use JviguyGames1994\Concurrency\Concurrency;
use JviguyGames1994\Concurrency\Economy\EconomyHandlers;
use JviguyGames1994\Concurrency\Economy\Events\AddMoneyEvent;
use JviguyGames1994\Concurrency\Economy\Events\MoneyChangeEvent;

class ShopExample
{
	public function test(){
		$api = Concurrency::getInstance();
		try {
			$Kills = $api->getEconomy("kills");
		} catch (InvalidArgumentException $exception){
			//error thrown because that economy doesnt exist
		}
		$player = "player"; // player class
		try {
			$emmaskills = $Kills->get($player->getUUID());
		} catch (InvalidArgumentException $exception){
			//error thrown because emma isnt in the economy data base
		}
		$Kills->sum($player-getUUID(), -1000);// subtracts 1000 from emmas kills because the sum function follows interger rules
	}
	public function onAdd(MoneyChangeEvent $event){
		if ($event instanceof AddMoneyEvent){
			//called when a player is added money
		}else if ($event instanceof \JviguyGames1994\Concurrency\Economy\Events\SubtractMoneyEvent){
			$changeinmoney = $event->getChange();
			if ($changeinmoney < -1000){
				$event->setCancelled();//stops the money from changing
			}
		}
	}
}