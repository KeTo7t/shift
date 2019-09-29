<?php


namespace App\Repositories;


use App\Models\ShiftModel;
use App\Models\TimeSheetModel;

class TimeSheetRepository
{
    /**
     * @param TimeSheetModel $timeSheetModel
     *
     * @param ShiftModel $shiftModel
     */
    protected $timeSheetModel;

    function __construct(TimeSheetModel $timeSheetModel )
    {
        $this->timeSheetModel= $timeSheetModel ;
    }

    function getPreviousMonthList($memberId,$date){
        $query=$this->timeSheetModel::member($memberId);
        $query=$query->previousMonth($date);
       return $query->orderBy("business_day")->get();
    }
    function getCurrentMonthList($memberId,$date){
        $query=$this->timeSheetModel::member($memberId);
        $query=$query->currentMonth($date);
        return $query->orderBy("business_day")->get();
    }

    function get7DaysList($memberId,$date){
        $query=$this->timeSheetModel::member($memberId);
        $query=$query->dayBetween($date,7);
        return $query->orderBy("business_day")->get();
    }
    function getCurrentWeekList($memberId,$date){
        $query=$this->timeSheetModel::member($memberId);
        $query=$query->currentWeek($date);
        return $query->orderBy("business_day")->get();
    }
    /**
     * @param $memberId
     * @param $date
     * @param $time
     * @return bool
     */
    function saveTimeSheetStart($memberId, $date, $time)
    {

        $this->timeSheetModel = TimeSheetModel::firstOrNew(["member_id" => $memberId, "business_day" => $date]);
        $this->timeSheetModel->start_time = $time;
        $this->timeSheetModel->work_type=1;
        return $this->timeSheetModel->save();
    }


    /**
     * @param $memberId
     * @param $date
     * @param $time
     * @return bool
     */
    function saveTimeSheetEnd($memberId, $date, $time)
    {
        $this->timeSheetModel = TimeSheetModel::firstOrNew(["member_id" => $memberId, "business_day" => $date]);
        $this->timeSheetModel->end_time =  $time;
        $this->timeSheetModel->work_type=1;
        return $this->timeSheetModel->save();
    }
}