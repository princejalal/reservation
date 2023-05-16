<?php

namespace Jalal\TourTelegramBot\Reservation;

use Telegram\Bot\Api;
use function Symfony\Component\Translation\t;

class FullReservationCreator implements ReservationCreator {

    private $reservation;

    private $config;

    private $template = 'fullReservation';

    private $siteName;

    private $chatId;

    private $botToken;

    public function __construct($reservation, $siteName)
    {
        $this->config = include_once '../config.php';
        $this->getConfigValue('chatId');
        $this->getConfigValue('botToken');
        $this->siteName = $siteName;
        $this->reservation = $reservation;
    }

    public function send()
    {
        $text = view($this->template,$this->formatText($this->reservation))->render();

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
            'name'        => $reservation->name,
            'phone'       => $reservation->phone,
            'email'       => $reservation->email,
            'pickUpPlace' => $reservation->pick_up_place,
            'roomNumber'  => $reservation->room_number,
            'adult'       => $reservation->adult,
            'child'       => $reservation->child,
            'infant'      => $reservation->infant,
            'tourName'    => $reservation->tour_name,
            'tourDate'    => $reservation->tour_date,
            'message'     => $reservation->message,
            'userLang'    => $reservation->user_lang,
            'siteName'    => $this->siteName,
        ];
    }

    private function getConfigValue($key): string
    {
        if (isset($this->config[$key])) {
            $this->$key = $this->config[$key];
        }
    }
}