<?php

namespace CyMarket\Telegram;

use CyMarket\Exceptions\TelegramScenarioException;

class ScenarioService
{
    /**
     * @param $update
     * @throws TelegramScenarioException
     */
    public function processUpdate($update)
    {
        if (!$update->userChat->current_scenario) {
            return;
        }

        /** @var AbstractScenario $scenario */
        $scenario = app($update->userChat->current_scenario, ['userChat' => $update->userChat]);

        $scenario->processStep($update);
    }
}
