<?php
declare(strict_types=1);

namespace JviguyGames1994\Concurrency\Economy\Events;


use pocketmine\event\Cancellable;
use pocketmine\event\Event;

class MoneyChangeEvent extends Event implements Cancellable
{
	/** @var string $uuid */
	private $uuid;
	/** @var float $change */
	private $change;
	public function __construct(string $uuid, int $change)
	{
		if($change == 0){
			$this->setCancelled();
		}
		$this->uuid = $uuid;
		$this->change = $change;
	}
	/**
	 *@return string returns the players uuid that changed amount
	 */
	public function getUUID(): string{
		return $this->uuid;
	}

	/**
	 * @return float returns the change in money
	 */
	public function getChange(): float{
		return $this->change;
	}

    /**
     * @param float $change
     * @return void sets the change in money
     */
    public function setChange(float $change): void{
        $this->change = $change;
    }

    /**
     * @param string $uuid
     * @return void sets the players uuid that changed amount
     */
    public function setUUID(string $uuid): void{
        $this->uuid = $uuid;
    }
}
