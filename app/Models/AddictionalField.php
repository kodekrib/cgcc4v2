<?php

namespace App\Models;

class AddictionalField {
    public $scheduleList;
    public $canceledList;

    public function __construct() {
        $this->scheduleList = [];
        $this->canceledList = [];
    }
}
