<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ReservationTest extends TestCase{

    public function testReservationCreate(): void
    {
        $reservation = new \Jalal\TourTelegramBot\Reservation\FastReservation('alanya-tours.com');

        $fast = new stdClass();
        $fast->number = '09128720118';
        $fast->user_lang = 'fa';

        $res = $reservation->create($fast);

        $this->assertSame($res->siteName,'alanya-tours.com');
    }
    
    
}