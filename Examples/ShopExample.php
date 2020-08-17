<?php
declare(strict_types=1);

use JviguyGames1994\Concurrency\Concurrency;
use JviguyGames1994\Concurrency\Economy\EconomyHandlers;

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
		$emmaskills = $Kills->get($player->getUUID());
		$Kills->sum($player-getUUID(), -1000);// subtracts 1000 from emmas kills because the sum function follows interger rules
	}
}