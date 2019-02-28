<?php

namespace CyMarket\Telegram;

use CyMarket\Exceptions\TelegramScenarioException;
use CyMarket\UserChat;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

/**
 * @property array steps
 */

abstract class AbstractScenario
{
    protected $user;

    /** @var \Illuminate\Foundation\Application|mixed|Api $telegram */
    protected $telegram;

    /** @var UserChat $userChat */
    protected $userChat;

    protected $keyboard;

    public function __construct(UserChat $userChat)
    {
        $this->user = \Auth::user();
        $this->telegram = app(Api::class);
        $this->userChat = $userChat;
    }

    /**
     * @param Update $update
     * @throws TelegramScenarioException
     */
    public function processStep(Update $update)
    {
        \Log::debug('Processing current step reply');

        $currentStep = $this->userChat->current_step;
        if (!in_array($currentStep, $this->steps)) {
            throw new TelegramScenarioException('Current scenario step not found');
        }

        $stepMethodName = 'processStep' . ucfirst($currentStep);

        \Log::debug('Running', [$stepMethodName]);
        $this->{$stepMethodName}($update);
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function start()
    {
        \Log::debug('Starting scenario');
        $this->initFirstStep();

        \Log::debug('start() done');
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function initFirstStep()
    {
        if ($this->userChat->current_scenario) {
            $this->resetScenario();
            $this->telegram->sendMessage([
                'chat_id' => $this->userChat->chat->telegram_id,
                'text' => __('Previous command cancelled'),
            ]);
        }

        \Log::debug('Initializing first step');
        $step = reset($this->steps);
        $this->initStep($step);

        \Log::debug('initFirstStep() done');
    }

    public function initStep($step)
    {
        $stepMethodName = 'initStep' . ucfirst($step);

        \Log::debug('Running', [$stepMethodName]);

        $this->{$stepMethodName}();

        $this->userChat->current_scenario = static::class;
        $this->userChat->current_step = $step;
        $this->userChat->save();

        \Log::debug('initStep() done', [$step]);
    }

    /**
     * @throws TelegramScenarioException
     */
    public function nextStep()
    {
        \Log::debug('Going to the next step');

        $currentStep = $this->userChat->current_step;
        \Log::debug('Current step was', [$currentStep]);

        $steps = array_values($this->steps);
        $currentStepIndex = array_search($currentStep, $steps);
        \Log::debug('Current step index was', [$currentStepIndex]);

        if ($currentStepIndex === false) {
            throw new TelegramScenarioException('Current scenario step not found');
        }

        $currentStepIndex++;

        if (!empty($steps[$currentStepIndex])) {
            $nextStep = $steps[$currentStepIndex];
            \Log::debug('Next step is', [$nextStep]);
            $this->initStep($nextStep);
        } else {
            \Log::debug('No more steps in this scenario. Finalizing');
            $this->finalStep();
            $this->resetScenario();
        }

        \Log::debug('nextStep() done');
    }

    public function resetScenario()
    {
        \Log::debug('Resetting scenario');

        $this->userChat->current_scenario = null;
        $this->userChat->current_step = null;
        $this->userChat->save();

        \Log::debug('resetScenario() done');
    }

    /**
     * @param $params
     * @return \Telegram\Bot\Objects\Message
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function sendMessage($params)
    {
        $params += ['chat_id' => $this->userChat->chat->telegram_id];

        if ($this->keyboard) {
            $replyMarkup = [
                'keyboard' => $this->keyboard,
                'resize_keyboard' => true,
                'one_time_keyboard' => true
            ];

            $params['reply_markup'] = json_encode($replyMarkup);
        }

        return $this->telegram->sendMessage($params);
    }

    public function setKeyboard($keyboard)
    {
        $this->keyboard = $keyboard;
    }

    abstract public function finalStep();
}
