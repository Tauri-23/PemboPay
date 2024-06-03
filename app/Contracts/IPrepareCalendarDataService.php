<?php
namespace App\Contracts;

interface IPrepareCalendarDataService {
    public function prepareCalendarData($dates, $timesheets, $holidays);
}