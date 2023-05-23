<?php

namespace Jalal\TourTelegramBot\Reservation;

use Telegram\Bot\Api;

class FastReservationCreator implements ReservationCreator {

    private $reservation;

    private $config;

    private $template = 'telegram.fastReservation';

    private $siteName;

    private $chatId;

    private $botToken;

    public function __construct($reservation, $siteName)
    {
        if (file_exists(__DIR__ . '/../config/reservation-config.php')) {
            $this->config = include (__DIR__.'/../config/reservation-config.php');
        } else {
            $this->config = include (__DIR__.'/config.php');
        }
        $this->getConfigValue('chatId');
        $this->getConfigValue('botToken');
        $this->siteName = $siteName;
        $this->reservation = $reservation;
    }

    public function send()
    {
        $text = view($this->template, $this->formatText($this->reservation))->render();

        if (!$this->botToken || !$this->chatId) {
            throw new \InvalidArgumentException('Bot token or chat id is not defined for Telegram Reservation');
        }
        // trying to make request and send notification
        try {
            $bot = new Api($this->botToken);
            $bot->sendMessage([
                $this->chatId,
                'parse_mode' => 'HTML',
                'text'       => $text
            ]);
        } catch (Exception $exception) {
            \Log::error($exception->getMessage());
        }
    }

    public function formatText($reservation)
    {
        return [
            'number'   => $reservation->number,
            'userLang' => $reservation->user_lang,
            'siteName' => $this->siteName
        ];
    }

    private function getConfigValue($key)
    {
        if (isset($this->config[$key])) {
            $this->$key = $this->config[$key];
        }
    }
}
