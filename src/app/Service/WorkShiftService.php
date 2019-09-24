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
use App\Repositories\WorkShiftRepository;
use Carbon\Carbon;

/**
 * Class TimeSheetService
 * @package App\Service
 */
class WorkShiftService
{

    protected $workShiftRepository;

    /**
     * TimeSheetService constructor.
     *
     * @param TimeSheetModel $timeSheetModel
     *
     */
    function __construct(WorkShiftRepository $workShiftRepository)
    {
        $this->workShiftRepository = $workShiftRepository;


    }

    /**
     * @param $memberId
     * @param $date
     * @param $time
     * @return bool
     */
    function saveWorkShift($memberId, $date, $time)
    {
    }
}
