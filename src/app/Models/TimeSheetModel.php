<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Log;


/**
 * Class TimeSheetModel
 *
 * @package App\Models
 * @property int $id
 * @property string $bussiness_day
 * @property int $work_place_type
 * @property string $start_time
 * @property string $end_time
 * @property int|null $work_type
 * @property int|null $rest_time
 * @property int $member_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel date($date)
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel member($memberId)
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel whereBussinessDay($value)
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel whereEndTime($value)
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel whereId($value)
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel whereMemberId($value)
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel whereRestTime($value)
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel whereStartTime($value)
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel whereWorkPlaceType($value)
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel whereWorkType($value)
 * @mixin \Eloquent
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed $work_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel currentMonth($date)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel currentWeek($date)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel dayBetween($date, $daysPrevious)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TimeSheetModel workType($type = 1)
 */
class TimeSheetModel extends Model
{
    use  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "t_timesheet";
    protected $fillable = [
        'member_id',
        "bussiness_day"
    ];
    protected $appends = array('work_time');

    // Accessors
    public function getWorkTimeAttribute()
    {
        $a=new Carbon($this->end_time);
        $b=new Carbon($this->start_time);

        $c=$b->diffInMinutes($a);


        $d=new Carbon("2000-1-1 00:00:00");

       return $d->addMinutes($c-60)->format("H:i") ;
    }

    public function scopeDate(Builder $query, $date)
    {
        return $query->where("bussiness_day", $date);
    }


    /**
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMember(Builder $query, $memberId)
    {
        $query->where("member_id", $memberId);
        return $query;

    }

    public function scopeWorkType(Builder $query, $type = 1)
    {
        $query->where("work_type", $type);
        return $query;

    }


    /**
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrentMonth(Builder $query, $date)
    {
        $d = new Carbon($date);

        $query->whereBetween("bussiness_day", [$d->startOfMonth()->copy(), $d->endOfMonth()]);
        return $query;

    }
    public function scopePreviousMonth(Builder $query, $date)
    {
        $d = new Carbon($date);
        $d->subMonth();
        $query->whereBetween("bussiness_day", [$d->startOfMonth()->copy(), $d->endOfMonth()]);
        return $query;

    }
    public function scopeCurrentWeek(Builder $query, $date)
    {
        $d = new Carbon($date);

        $query->whereBetween("bussiness_day", [$d->startOfWeek()->copy(), $d->endOfWeek()]);
        return $query;

    }

    public function scopeDayBetween(Builder $query, $date, int $daysPrevious)
    {
        $d = new Carbon($date);

        $query->whereBetween("bussiness_day", [$d->copy()->subDay($daysPrevious), $d->endOfDay()]);
        return $query;

    }


}



