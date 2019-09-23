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
 * @property string|null $business_day_start
 * @property string|null $business_day_end
 * @property string|null $start_time
 * @property string|null $end_time
 * @property int|null $work_type 1:現場稼働   2~：社内作業
 * @property int|null $rest_time
 * @property int|null $member_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel date($date)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel member($memberId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel wherebusinessDayEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel wherebusinessDayStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel whereRestTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel whereWorkType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShiftModel workType($type = 1)
 * @mixin \Eloquent
 */
class ShiftModel extends Model
{
    use  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "t_shift";
    protected $fillable = [
        'member_id',
        "business_day"
    ];

    public  function scopeDate(Builder $query, $date)
    {
        $query->where("business_day_start" ,"<=",$date) ->where("business_day_end" ,">=",$date) ;
        return;
    }


    /**

     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public  function scopeMember(Builder $query,$memberId){
        $query->where("member_id", $memberId);
        return $query;

    }

    public  function scopeWorkType(Builder $query,$type=1){
        $query->where("work_type",$type);
        return $query;

    }



}



