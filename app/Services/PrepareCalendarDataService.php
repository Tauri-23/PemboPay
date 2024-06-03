<?php
namespace App\Services;

use App\Contracts\IPrepareCalendarData;
use App\Contracts\IPrepareCalendarDataService;
use App\Models\Treasuries;

class prepareCalendarDataService implements IPrepareCalendarDataService {
    public function prepareCalendarData($dates, $timesheets, $holidays) {
        $calendarData = [];

        foreach($dates as $date) {
            $dateStr = $date->toDateString();

            // Find timesheets for this date
            $timesheetForDate = $timesheets->filter(function($timesheet) use ($dateStr) {
                return $timesheet->time_in->toDateString() == $dateStr;
            });

            // Find holidays for this date
            $holidayForDate = $holidays->filter(function($holiday) use ($dateStr) {
                return $holiday->holiday_date == $dateStr;
            });

            // Add data to calendar
            $calendarData[$dateStr] = [
                'date' => $date,
                'timesheets' => $timesheetForDate,
                'holiday' => $holidayForDate->first() // Assuming one holiday per day
            ];
        }

        return $calendarData;
    }
}