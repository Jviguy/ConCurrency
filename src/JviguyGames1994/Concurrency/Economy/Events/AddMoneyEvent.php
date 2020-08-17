<?php
declare(strict_types=1);

namespace JviguyGames1994\Concurrency\Economy\Events;


class AddMoneyEvent extends MoneyChangeEvent
{
	public function __construct(string $uuid, int $change)
	{
		parent::__construct($uuid, $change);
	}
}