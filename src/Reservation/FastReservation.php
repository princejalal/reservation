<?php
/**
 * _________________________________________________________________________
 *
 *
 * _________________________________________________________________________
 */

namespace Jalal\TourTelegramBot\Reservation;

class FastReservation extends Reservation {

    public function __construct($siteName)
    {
        parent::__construct($siteName);
    }

    public function create($reservation)
    {
        return new FastReservationCreator($reservation,$this->siteName);
    }
}