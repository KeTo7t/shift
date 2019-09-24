<?php


namespace App\Repositories;


use App\Models\ShiftModel;
use App\Models\TimeSheetModel;

class WorkShiftRepository
{
    /**
     * @var TimeSheetModel $timeSheetModel
     */
    protected $timeSheetModel,$shiftModel;

    function __construct(TimeSheetModel $timeSheetModel , ShiftModel $shiftModel)
    {
        $this->timeSheetModel= $timeSheetModel ;
        $this->shiftModel= $shiftModel;
    }

    function  registerWorkShift($userId , $workday ,$dayStart=null ,$dayEnd=null, $startTime=null ,$endTime=null){
        $this->shiftModel->member_id=$userId;
        $this->shiftModel->shift_start_date=$dayStart;
        $this->shiftModel->shift_end_date=$dayEnd;
        $this->shiftModel->start_time=$startTime;
        $this->shiftModel->end_time=$endTime;
        $this->shiftModel->save();

    }
}