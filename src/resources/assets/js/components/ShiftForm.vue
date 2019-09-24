<template>
    <div>

        <div class="row">
            <!---->
            <div class="col"> <input style="visibility:hidden;width: 0px;" id="hiddenDate" type="date" v-model="date">
               <span v-model="month" v-on:click="dateClick">{{month}}</span>
                <span v-model="month" v-on:click="dateClick">{{day}}</span></div>
            <div class="col">時間:<input type="time" v-model="time"></div>
        </div>
        <div>・プリセット</div>
        <div v-model="shift">シフト時間を適用：
            <button v-on:click="setShiftStart">{{shift.start}}</button>
            -
            <button v-on:click="setShiftEnd">{{shift.end}}</button>
        </div>
        <button v-on:click="setCurrent">現在日時を適用</button>
        <br>
        <div>・打刻</div>
        <button style="height: 100px ;width: 100px;" v-on:click="requestAttendTime('start'  ) ">開始時刻として登録</button>
        <button style="height: 100px ;width: 100px;" v-on:click="requestAttendTime('end'  ) ">終了時刻として登録</button>


    </div>
</template>

<script>
    var moment = require("moment");

    var initDate = moment().format("YYYY-MM-DD")
    var initTime = moment().format("HH:MM:ss")
    var iniMonth = moment().format("MM月")
    var iniDay = moment().format("DD日")
    export default {
        props: ['name'],
        data: function () {
            return {
                message: '',
                date: initDate,
                time: initTime,
                shift: {
                    start: "",
                    end: ""
                }

            }
        },
        computed: {
            month: function () {
                var a =moment(this.date).format("M月")
               return a
            }
,            day: function () {
                return moment(this.date).format("D日")
            }
        }
        ,
        methods: {
            setCurrent: function (event) {

                var date = moment().format("YYYY-MM-DD")
                var time = moment().format("HH:mm:ss")

                this.date = date;
                this.time = time;

            },
            putShift: function (type) {

                axios.post("/shift/" + type, {params: {
                    startDate: this.date, time: this.time

                }}).then(
                    (response) => {
                        if (response.status != 200) {
                            alert("register Error");
                        } else {
                            alert("register success");
                            this.$parent.$children[1].changeListTerm()


                        }
                    },
                    (error) => {
                        alert("fatal error")
                    }
                )

            },
            getShiftTime: function (event) {
                axios.get("/shift").then(
                    (response) => {
                        console.log(response)
                        if (response.status != 200) {
                            console.log("get Error");
                        } else {
                            this.shift.start = response.data[0].start_time;
                            this.shift.end = response.data[0].end_time;


                        }
                    },
                    (error) => {
                        alert("fatal error")
                    }
                )
            },
            setShiftStart: function (event) {
                this.time = this.shift.start;
            }
            , setShiftEnd: function (event) {
                this.time = this.shift.end;
            },
            dateClick: function (event) {
                document.getElementById("hiddenDate").click()
            },


        },

        created: function () {
            this.getShiftTime()
        },


    }
</script>

<style scoped>
  .name {
      font-weight: bold;
      color: red;
  }
    </style>