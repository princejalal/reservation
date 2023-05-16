<?php
declare(strict_types=1);

namespace Jalal\TourTelegramBot\Reservation;
abstract class Reservation {
    protected string $siteName;

    public function __construct($siteName)
    {
        $this->siteName = $siteName;
    }

    abstract public function create($template);
}