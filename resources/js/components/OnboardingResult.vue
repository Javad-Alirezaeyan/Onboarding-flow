<template>
    <div >
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th title="this column determines the count of week/month/day that the step has maximum users">MaxCount in all period</th>
                <th>Percentage to all user</th>
                <th>The count of users</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="item in rowData"  >
                <td v-if="stuckStep==item.Step" style="color: red" >{{ item.Title }}</td>
                <td v-else>{{ item.Title }}</td>
                <td>{{ item.WeekMaxCount }}</td>
                <td>{{ item.PercentageToAll }} %</td>
                <td>{{ item.UserCount }}</td>
            </tr>
            </tbody>
        </table>

        <div class="div-periodtype">
            <select v-model="periodType" v-on:change="getData()">
                <option value="7">Weekly</option>
                <option value="30">Monthly</option>
                <option value="1">Daily</option>
            </select>
        </div>
    </div>


</template>

<script>


    export default {
        name : "analysis-data",

        data() {
            return {
                periodType : 7,
                rowData:[],
                stuckStep: null
            }
        },
        mounted () {
            this.getData();

        },
        beforeDestroy: function() {
        },
        methods: {
            getData(){
                axios.get('/analysis',
                    {
                        params: {
                            periodType: this.periodType
                        },
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }
                )
                    .then(({ data })=> {

                        let rows =  data['analysisData'];

                        this.rowData = rows;
                        this.stuckStep = data['StuckStep'];
                        if (this.rowData.length == 0){
                            alert("Data didn't find, Please upload a file or check the database connection");
                        }

                    })
                    .catch((err)=> {
                        console.log("error:", err);
                    })

            },
        }
    }
</script>

<style scoped>
    .div-periodtype{
        position: absolute;
        z-index: 10;
        top: 10px;
        right: 10px;
    }
</style>