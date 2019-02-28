<?php

namespace CyMarket\Telegram\Scenarios;

use CyMarket\Telegram\AbstractScenario;
use Telegram\Bot\Objects\Update;

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
        $this->sendMessage([
            'text' => __('What would you like to sell (short description)'),
        ]);
    }

    /**
     * @param Update $update
     * @throws \CyMarket\Exceptions\TelegramScenarioException
     */
    public function processStepAskDescription(Update $update)
    {

        $this->nextStep();
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function initStepAskPhotos()
    {
        $this->sendMessage([
            'text' => __('Please provide 1-5 pictures'),
        ]);
    }

    /**
     * @param Update $update
     * @throws \CyMarket\Exceptions\TelegramScenarioException
     */
    public function processStepAskPhotos(Update $update)
    {

        $this->nextStep();
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function initStepAskPrice()
    {
        $this->sendMessage([
            'text' => __('What is the price?'),
        ]);

    }

    /**
     * @param Update $update
     * @throws \CyMarket\Exceptions\TelegramScenarioException
     */
    public function processStepAskPrice(Update $update)
    {

        $this->nextStep();
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function initStepAskArea()
    {
        $keyboard = [
            ['Limassol', 'Paphos', 'Nicosia'],
            ['Larnaca', 'Agia-Napa'],
        ];

        $this->setKeyboard($keyboard);

        $this->sendMessage([
            'text' => __('Please chose the area'),
        ]);

    }

    /**
     * @param Update $update
     * @throws \CyMarket\Exceptions\TelegramScenarioException
     */
    public function processStepAskArea(Update $update)
    {

        $this->nextStep();
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function initStepAskCategory()
    {
        $keyboard = [
            ['Toys', 'Cars', 'Home'],
            ['Other'],
        ];

        $this->setKeyboard($keyboard);

        $this->sendMessage([
            'text' => __('Please select the category'),
        ]);

    }

    /**
     * @param Update $update
     * @throws \CyMarket\Exceptions\TelegramScenarioException
     */
    public function processStepAskCategory(Update $update)
    {

        $this->nextStep();
    }


    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function finalStep()
    {
        $this->sendMessage([
            'text' => __('Cool! You are done.'),
        ]);

    }

}
