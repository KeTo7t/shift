<?php


namespace App\Repositories;


use App\Models\ShiftModel;
use App\Models\TimeSheetModel;

class WorkShiftRepository
{
    /**
     * @var TimeSheetModel $timeSheetModel
     */
    protected $shiftModel;

    function __construct( ShiftModel $shiftModel)
    {


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

    /**
     * @param $member_id
     * @param null $date
     */
    function getShift($member_id, $date=null)
    {
        $shiftData= $this->shiftModel::member($member_id)->date($date )->get(["start_time","end_time"]);

        \Log::debug('$shiftData->count()'. $shiftData->count());
        if($shiftData->count()<=0){
            $result["start_time"]="09:00";
            $result["end_time"]="18:00";
        }else{
            $result=$shiftData->toArray();
        }
        \Log::debug($result);
        return $result;

    }
}