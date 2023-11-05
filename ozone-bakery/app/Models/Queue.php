<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    function queue($day){
        if (Carbon::parse($this->date) < Carbon::now()){
            $this->date = Carbon::now()->format('Y-m-d');
        }
        $date = Carbon::parse($this->date)->addDays($day)->format('Y-m-d');
        $this->date = $date;
        $this->save();
        return $this->date;
    }

    function estimateDate($day){
        if (Carbon::parse($this->date) < Carbon::now()){
            $this->date = Carbon::now()->format('Y-m-d');
        }
        $date = Carbon::parse($this->date)->addDays($day)->format('Y-m-d');
        return $date;
    }
}
