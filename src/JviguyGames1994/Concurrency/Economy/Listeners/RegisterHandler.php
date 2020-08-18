<?php
declare(strict_types=1);
namespace JviguyGames1994\Concurrency\Economy\Listeners;

use JviguyGames1994\Concurrency\Economy\BaseEconomies\BaseEconomy;
use JviguyGames1994\Concurrency\Economy\EconomyHandlers;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class RegisterHandler implements Listener
{
	private $Ecos;
	public function __construct(EconomyHandlers $economyHandlers)
	{
		$this->Ecos = $economyHandlers;
	}

	public function handle(PlayerJoinEvent $event){
		$ecos = $this->Ecos->getEconomies();
		if (!isset($ecos)){return;}
		foreach ($ecos as $eco){
			if ($eco instanceof BaseEconomy){
				if ($eco->isRegistered($event->getPlayer()->getUniqueId()->toString())){
					return;
				}
				$eco->register($event->getPlayer()->getUniqueId()->toString());
			}
		}
	}
}