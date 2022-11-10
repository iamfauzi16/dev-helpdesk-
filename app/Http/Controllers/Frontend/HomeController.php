<?php

namespace App\Http\Controllers\Frontend;

use DateTime;
use DateTimeZone;
use App\AttendancesReport;

class HomeController
{
    public function index()
    {
        $timezone = 'Asia/Jakarta'; 
        $date = new DateTime('now', new DateTimeZone($timezone)); 
        $localtime = $date->format("H:i:s"); 
        $calender = $date->format("Y-m-d");
       
        
        $attendancesReport = AttendancesReport::where('date_time', $calender)->first();

        
        return view('frontend.home', compact('attendancesReport'));

    }
}
