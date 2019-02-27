<?php

namespace CyMarket\Http\Controllers;

use CyMarket\Exceptions\TelegramScenarioException;
use CyMarket\Telegram\ScenarioService;
use CyMarket\User;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramResponseException;

class TelegramWebhookController extends Controller
{
    public function index (Api $telegram, ScenarioService $scenarioService) {
        $update = $telegram->getWebhookUpdate();

        $telegramUser = $update['message']['from'];

        $user = User::firstOrCreate(
            [
                'telegram_id' => $telegramUser['id'],
            ],
            [
                'telegram_username' => $telegramUser['username'],
                'name' => $telegramUser['first_name'] . ' ' . $telegramUser['last_name'],
            ]
        );

        \Auth::login($user);

        $message = $update->getMessage();

        try {

            if ($message->has('entities')) {
                $telegram->processCommand($update);
            } else {
                $scenarioService->processUpdate($update);
            }

        } catch (TelegramScenarioException $e) {
            $message = 'Scenario exception: ' . $e->getMessage() . '. Resetting scenario for user.';

            \Log::error($message);
            $user->current_scenario = null;
            $user->current_step = null;
            $user->save();

            return $message;
        } catch (TelegramResponseException $e) {
            $message = 'Telegram exception: ' . $e->getMessage() . '. Resetting scenario for user.';

            \Log::error($message);

            return $message;
        }



        return 'ok';
    }
}
