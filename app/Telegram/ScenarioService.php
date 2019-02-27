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
        $user = \Auth::user();

        if (!$user->current_scenario) {
            return;
        }

        /** @var AbstractScenario $scenario */
        $scenario = app($user->current_scenario);

        $scenario->processStep($update);
    }
}
