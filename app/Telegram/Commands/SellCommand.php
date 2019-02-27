<?php

namespace CyMarket\Telegram\Commands;

use CyMarket\Telegram\Scenarios\SellScenario;
use Telegram\Bot\Commands\Command;

class SellCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "sell";

    /**
     * @var string Command Description
     */
    protected $description = "Start sell";

    /**
     * @inheritdoc
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function handle()
    {
        $scenario = new SellScenario();

        $scenario->start();
    }
}
