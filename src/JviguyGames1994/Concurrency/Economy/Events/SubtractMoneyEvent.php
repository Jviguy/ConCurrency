<?php
declare(strict_types=1);
namespace JviguyGames1994\Concurrency\Economy\Events;


class SubtractMoneyEvent extends MoneyChangeEvent
{
	public function __construct(string $uuid, int $change)
	{
		parent::__construct($uuid, $change);
		if($change > 0){
			$this->setCancelled();
		}	
	}
}
