<?php

namespace App\Service;


use App\Models\ReportFormatModel;

use Carbon\Carbon;


class ReportFormatService
{

    protected $reportFormatModel;

    function __construct(ReportFormatModel $reportFormatModel)
    {
        $this->reportFormatModel = $reportFormatModel;
    }


    function getReportFormat($id){

        return $this->reportFormatModel->id($id)->get()->toArray();

    }



}