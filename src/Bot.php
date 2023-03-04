<?php
namespace jalal\TourTelegramBot;

class Bot implements Telegram {

    private $siteName;

    /**
     * _________________________________________________________________________
     * Reservation type
     * @var string
     * _________________________________________________________________________
     */
    private $type;


    public function __construct($siteName) {
        $this->siteName = $siteName;;
    }

    protected function setType(){

    }

    public function send() {
        return null;
    }

}