<template>
    <div>
        <!--<input type="text"  v-model="date" placeholder="edit me">-->
        <button v-on:click="loadFormat">読み込み</button>

        <br>
        <input type="text" v-model="reportTitle" placeholder="edit me2">
        <br>
        <textarea v-model="reportBody" placeholder="edit me2"></textarea>
        <button v-on:click="saveFormat">登録</button>
    </div>
</template>

<script>
    var moment = require("moment");


    export default {
        props: ['name'],
        data: function () {
            return {
                reportTitle: '',
                reportBody: '',
                sendTo:'',
                ccTo:'',
                bindings:[]
            }
        },

        methods: {
            loadFormat: function (event) {
                axios.get("/api/report_format/get").then(
                    (response)=>{
                        console.log(response.data)
                    }
                )

            },
            saveFormat: function (event) {
                axios.post("/api/report_format/set/",{


                }).then(
                    (response)=>{

                    }
                )

            },



        }   ,

    }
</script>

<style scoped>
    .name {
        font-weight: bold;
        color: red;
    }
</style>