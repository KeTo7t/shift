<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Log;


/**
 * Class ShifttModel
 *
 * @package App\Models
 * @property int $id
 * @property int|null $type_id
 * @property string|null $report_title
 * @property string|null $display_order
 * @property string|null $bindings
 * @property string|null $report_body
 * @property string|null $send_to
 * @property string|null $send_cc
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportFormatModel id($Id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportFormatModel whereBindings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportFormatModel whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportFormatModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportFormatModel whereReportBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportFormatModel whereReportTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportFormatModel whereSendCc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportFormatModel whereSendTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportFormatModel whereTypeId($value)
 * @mixin \Eloquent
 */
class ReportFormatModel extends Model
{
    use  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "m_report_format";
    protected $fillable = [
        'member_id',
        "business_day"
    ];


    public  function scopeId(Builder $query,$Id){
        $query->where("id", $Id);
        return $query;

    }



}



