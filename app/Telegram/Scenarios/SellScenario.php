<?php

namespace CyMarket\Telegram\Scenarios;

use CyMarket\Telegram\AbstractScenario;

class SellScenario extends AbstractScenario
{
    protected $steps = [
        'askDescription',
        'askPhotos',
        'askPrice',
        'askArea',
        'askCategory',
    ];

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function initStepAskDescription()
    {
        $this->telegram->sendMessage([
            'chat_id' => $this->user->telegram_id,
            'text' => __('What would you like to sell (short description)'),
        ]);
    }

    /**
     * @throws \CyMarket\Exceptions\TelegramScenarioException
     */
    public function processStepAskDescription()
    {

        $this->nextStep();
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function initStepAskPhotos()
    {
        $this->telegram->sendMessage([
            'chat_id' => $this->user->telegram_id,
            'text' => __('Please provide 1-5 pictures'),
        ]);
    }

    /**
     * @throws \CyMarket\Exceptions\TelegramScenarioException
     */
    public function processStepAskPhotos()
    {

        $this->nextStep();
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function initStepAskPrice()
    {
        $this->telegram->sendMessage([
            'chat_id' => $this->user->telegram_id,
            'text' => __('What is the price?'),
        ]);

    }

    /**
     * @throws \CyMarket\Exceptions\TelegramScenarioException
     */
    public function processStepAskPrice()
    {

        $this->nextStep();
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function initStepAskArea()
    {
        $this->telegram->sendMessage([
            'chat_id' => $this->user->telegram_id,
            'text' => __('Please chose the area'),
        ]);

    }

    /**
     * @throws \CyMarket\Exceptions\TelegramScenarioException
     */
    public function processStepAskArea()
    {

        $this->nextStep();
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function initStepAskCategory()
    {
        $this->telegram->sendMessage([
            'chat_id' => $this->user->telegram_id,
            'text' => __('Please select the category'),
        ]);

    }

    /**
     * @throws \CyMarket\Exceptions\TelegramScenarioException
     */
    public function processStepAskCategory()
    {

        $this->nextStep();
    }


    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function finalStep()
    {
        $this->telegram->sendMessage([
            'chat_id' => $this->user->telegram_id,
            'text' => __('Cool! You are done.'),
        ]);

    }

}
