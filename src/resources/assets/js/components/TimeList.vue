<template>
    <div>
        <button v-on:click="changeListTerm('previousMonth')">前月</button>
        <button v-on:click="changeListTerm('currentMonth')">今月</button>
        <button v-on:click="changeListTerm('currentWeek')">今週</button>
        <button v-on:click="changeListTerm('7days')">直近７日</button>
        <table id="timeSheetBody">
            <tr class="timeSheetRow">
                <td class="timeSheetCell">日にち</td>
                <td class="timeSheetCell">曜日</td>
                <td class="timeSheetCell">始業時間</td>
                <td class="timeSheetCell">退勤時間</td>
                <td class="timeSheetCell">実働時間</td>
            </tr>
            <tr class="timeSheetRow" v-for="date  in timesheet">
                <td class="timeSheetCell">{{date.bussiness_day}}</td>
                <td class="timeSheetCell">{{date.week_day}}</td>
                <td class="timeSheetCell">{{date.start_time}}</td>
                <td class="timeSheetCell">{{date.end_time}}</td>
                <td class="timeSheetCell">{{date.work_time}}</td>
            </tr>
        </table>

    </div>
</template>

<script>

    import 'moment/locale/ja'
    var moment = require("moment");

    export default {

        data:
            function () {
                return {
                    listTerm:"currentWeek",
                    timesheet: {}


                }
            },
        created: function () {
            this.changeListTerm(this.listTerm)

        },
        methods: {
            changeListTerm:function(e){
                if(e != undefined && e !=null){
                    this.listTerm=e;
                }

                this.getTimeJson(this.listTerm);

            },
            getTimeJson: function (event) {
                var date=this.$parent.$children[0].date;
                console.log(event)
                axios.get("/list?term="+ event +"&date="+date).then(response => {
                        if (response.status != 200) {
                        } else {
                          var convertedTimeSheet= response.data.map(function(e){
                                e["week_day"]=moment(e.bussiness_day).format("ddd")
                                return e
                            })



                            this.timesheet = convertedTimeSheet
                        }
                        return
                    }
                )
                return
            },

        }


    }
</script>

<style scoped>
    #timeSheetBody {
        border: #6c757d 1px solid;
    }

    #timeSheetBody td {
        width: 100px;
        border: #6c757d 1px solid;
    }


</style>