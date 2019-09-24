<?php
/**
 * Created by PhpStorm.
 * User: kei2t
 * Date: 2018/02/19
 * Time: 23:18
 */

namespace App\Service;


use App\Models\ShiftModel;
use App\Models\TimeSheetModel;
use Carbon\Carbon;

/**
 * Class TimeSheetService
 * @package App\Service
 */
class TimeSheetService
{

    /**
     * @var TimeSheetModel $timeSheetModel
     */
    protected $timeSheetModel,$shiftModel;

    /**
     * TimeSheetService constructor.
     *
     * @param TimeSheetModel $timeSheetModel
     *
     * @param ShiftModel $shiftModel
     */
    function __construct(TimeSheetModel $timeSheetModel,ShiftModel $shiftModel)
    {
        $this->timeSheetModel = $timeSheetModel;
        $this->shiftModel=$shiftModel;

    }

    /**
     * @param $memberId
     * @param $date
     * @param $time
     * @return bool
     */
    function saveTimeSheetStart($memberId, $date, $time)
    {
        \Log::debug(print_r($date ,true));
        \Log::debug(print_r($time ,true));
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

    /**
     * @param $member_id
     * @param string $term
     * @param null $date
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    function getTimeSheetList($member_id, $term = "currentMonth", $date = null)
    {
        //timeSheetテーブルのデータをコレクションで取得

        $query=$this->timeSheetModel::member($member_id);
        switch ($term){
            case "previousMonth":
                $query=$query->previousMonth($date);
                break;
            case "currentMonth":
                $query=$query->4currentMonth($date);
                break;
            case "7days":
                $query=$query->dayBetween($date,7);
                break;
            case "currentWeek":
                $query=$query->currentWeek($date);
                break;
        }



        \Log::debug(print_r($query->toSql(),true));
        \Log::debug(print_r($query->getBindings(),true));
        //$timeSheetCollection = $query->orderBy("business_day")->get(["business_day", "start_time", "end_time","work_time"]);
        $timeSheetCollection = $query->orderBy("business_day")->get();


        //上位層で扱いやすいようにjsonかArrayで返却

//        $result= $returnAsArray ? $timeSheetCollection->toArray() : $timeSheetCollection->toJson();

        return $timeSheetCollection ;
    }

    /**
     * @param $member_id
     * @param null $date
     */
    function getShift($member_id, $date=null)
    {
    $query=   $this->shiftModel::member($member_id)->date($date );

       return $query->get(["start_time","end_time"])->toArray();


    }
}