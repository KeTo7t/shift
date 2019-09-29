<?php
/**
 * Created by PhpStorm.
 * UserModel: kei2t
 * Date: 2018/02/19
 * Time: 23:18
 */

namespace App\Service;


use App\Models\ShiftModel;
use App\Models\TimeSheetModel;
use App\Repositories\TimeSheetRepository;
use App\Repositories\WorkShiftRepository;
use Carbon\Carbon;
use mysql_xdevapi\Result;

/**
 * Class TimeSheetService
 * @package App\Service
 */
class TimeSheetService
{

    /**
     * @var TimeSheetModel $timeSheetModel
     */
    protected $timeSheetRepository, $workShiftRepository;

    /**
     * TimeSheetService constructor.
     *
     * @param TimeSheetModel $timeSheetModel
     *
     * @param ShiftModel $shiftModel
     */
    function __construct(TimeSheetRepository $timeSheetRepository, WorkShiftRepository $workShiftRepository)
    {
        $this->timeSheetRepository = $timeSheetRepository;
        $this->workShiftRepository = $workShiftRepository;
    }


    /**
     * @param $memberId
     * @param string $term
     * @param null $date
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    function getTimeSheetList($memberId, $term = "currentMonth", $date = null)
    {
        //timeSheetテーブルのデータをコレクションで取得
        if ($term == "previousMonth") {
            return $this->timeSheetRepository->getPreviousMonthList($memberId, $date);
        } elseif ($term == "currentMonth") {
            return $this->timeSheetRepository->getCurrentMonthList($memberId, $date);
        } elseif ($term == "7days") {
            return $this->timeSheetRepository->get7DaysList($memberId, $date);
        } elseif ($term == "currentWeek") {
            return $this->timeSheetRepository->getCurrentWeekList($memberId, $date);
        }
        return null;


    }


    function saveTimeSheet($type, $id, $date, $time)
    {
        if ($type == "start") {
            return $this->timeSheetRepository->saveTimeSheetStart($id, $date, $time);
        } else {
            return $this->timeSheetRepository->saveTimeSheetEnd($id, $date, $time);
        }

    }


    function getShift($memberId,$date)
    {
        return $this->workShiftRepository->getShift($memberId,$date);

    }
}