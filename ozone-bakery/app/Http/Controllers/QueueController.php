<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QueueController extends Controller
{
    private static $queueDate;

    public static function queue($date)
    {
        Log::info(self::$queueDate);
        $currentDate = Carbon::now()->format('Y-m-d');
        if (self::$queueDate == null || $currentDate > self::$queueDate) {
            self::$queueDate = $currentDate;
        }

        self::$queueDate = Carbon::parse(self::$queueDate)->addDays($date);

        Log::info(self::$queueDate);

        return self::$queueDate;
    }

    public static function estimateDate($date)
    {
        if (self::$queueDate == null || self::$queueDate < Carbon::now()->format('Y-m-d')) {
            self::$queueDate = Carbon::now()->format('Y-m-d');
        }

        return Carbon::parse(self::$queueDate)->addDays($date);
    }
}
