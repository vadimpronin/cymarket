<?php

namespace CyMarket\Telegram;

use CyMarket\Exceptions\TelegramScenarioException;
use Telegram\Bot\Api;

/**
 * @property array steps
 */

abstract class AbstractScenario
{
    protected $user;

    /** @var \Illuminate\Foundation\Application|mixed|Api $telegram */
    protected $telegram;

    public function __construct()
    {
        $this->user = \Auth::user();
        $this->telegram = app(Api::class);
    }

    /**
     * @throws TelegramScenarioException
     */
    public function processStep($update)
    {
        \Log::debug('Processing current step reply');

        $currentStep = $this->user->current_step;
        if (!in_array($currentStep, $this->steps)) {
            throw new TelegramScenarioException('Current scenario step not found');
        }

        $stepMethodName = 'processStep' . ucfirst($currentStep);

        \Log::debug('Running', [$stepMethodName]);
        $this->{$stepMethodName}();
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
        if ($this->user->current_scenario) {
            $this->resetScenario();
            $this->telegram->sendMessage([
                'chat_id' => $this->user->telegram_id,
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

        $this->user->current_scenario = static::class;
        $this->user->current_step = $step;
        $this->user->save();

        \Log::debug('initStep() done', [$step]);
    }

    /**
     * @throws TelegramScenarioException
     */
    public function nextStep()
    {
        \Log::debug('Going to the next step');
        $currentStep = $this->user->current_step;
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

        $this->user->current_scenario = null;
        $this->user->current_step = null;
        $this->user->save();

        \Log::debug('resetScenario() done');
    }

    abstract public function finalStep();
}
