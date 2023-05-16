<?php

namespace Jalal\TourTelegramBot\Reservation;

class FullReservation extends Reservation {

    public function __construct($siteName)
    {
        parent::__construct($siteName);
    }

    public function create($reservation)
    {
        return new FullReservationCreator($reservation,$this->siteName);
    }
}