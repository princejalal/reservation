<?php

namespace Jalal\TourTelegramBot\Reservation;

interface ReservationCreator {

    public function send();

    public function formatText($reservation);
}