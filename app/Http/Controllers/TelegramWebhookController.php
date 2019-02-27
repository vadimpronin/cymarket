<?php

namespace CyMarket\Http\Controllers;

use CyMarket\Chat;
use CyMarket\Exceptions\TelegramScenarioException;
use CyMarket\Telegram\ScenarioService;
use CyMarket\User;
use CyMarket\UserChat;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramResponseException;

class TelegramWebhookController extends Controller
{
    public function index (Api $telegram, ScenarioService $scenarioService) {
        $update = $telegram->getWebhookUpdate();

        $telegramUser = $update['message']['from'];
        $userFullName = $telegramUser['first_name'] . ' ' . $telegramUser['last_name'];

        $user = User::firstOrCreate(
            [
                'telegram_id' => $telegramUser['id'],
            ],
            [
                'telegram_username' => $telegramUser['username'],
                'name' => $userFullName,
            ]
        );

        \Auth::login($user);

        $telegramChat = $update['message']['chat'];
        $chatType = Chat::STRINGTYPEMAP[$telegramChat['type']];
        $chatData = [
            'type' => $chatType,
            'title' => ($chatType == Chat::TYPE_PRIVATE ? $userFullName : $telegramChat['title']),
            'username' => (!empty($telegramChat['username']) ? $telegramChat['username'] : ''),
        ];

        $chat = Chat::firstOrCreate(['telegram_id' => $telegramChat['id']], $chatData);
        $userChat = UserChat::firstOrCreate([
            'user_id' => $user->id,
            'chat_id' => $chat->id,
        ]);

        $update->userChat = $userChat;

        dump($update);

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
