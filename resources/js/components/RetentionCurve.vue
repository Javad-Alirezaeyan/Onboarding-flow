<template>
    <div  class="retention-block">
        <div id="retention-chart">
        </div>
        <div class="div-periodtype">
            <select v-model="periodType" v-on:change="getData()">
                <option value="7">Weekly</option>
                <option value="30">Monthly</option>
                <option value="1">Daily</option>
            </select>
        </div>
    </div>
</template>

<style scoped>
    .div-periodtype{
        position: absolute;
        z-index: 10;
        top: 10px;
        right: 10px;
    }
    .retention-block{
        position: relative;
    }
</style>

<script>
    var Highcharts = require('highcharts');
    export default {
        name : "retention-curve",
        series: [],

        data() {
            return {
                chart: undefined,
                series: [],
                xAxis : [],
                periodType : 7
            }
        },
        mounted () {
            this.getData();

        },
        beforeDestroy: function() {
            this.target.destroy();
        },
        methods: {
            getData(){
                axios.get('/periodGroupedData',
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
                        //console.log("data", data);
                        let chartdata =  data['chartData'];
                        this.series = [];
                        // creating the appropriate data format for curve
                        for (let i = 0; i < chartdata.length; i++){
                            this.series[i]= {
                                name : chartdata[i]['title'],
                                data : chartdata[i]['percentage']
                            }
                        }
                        this.xAxis = data['xAxis'];
                        if (this.series.length == 0){
                            alert("Data didn't find, Please upload a file or check the database connection");
                        }
                        this.setChart();
                    })
                    .catch((err)=> {
                        console.log("error:", err);
                    })

            },

            resetChart(){
                if (this.chart == undefined)
                    return;

                while(this.chart.series.length > 0)
                    this.chart.series[0].remove(true);
            },
            setChart(){
                this.chart = Highcharts.chart("retention-chart", {

                    title: {
                        text: 'Retention Curve'
                    },

                    subtitle: {
                        text: ''
                    },

                    yAxis: {
                        title: {
                            text: 'The percentage of users'
                        }
                    },
                    xAxis: {
                        title: {
                            text: 'The steps of onboarding'
                        }
                    },

                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },

                    xAxis: {
                        categories: this.xAxis
                    },

                   /* plotOptions: {
                        series: {
                            label: {
                                connectorAllowed: false
                            },
                            pointStart: 2010
                        }
                    },*/
                    series:  this.series,


                    responsive: {
                        rules: [{
                            condition: {
                                maxWidth: 500
                            },
                            chartOptions: {
                                legend: {
                                    layout: 'horizontal',
                                    align: 'center',
                                    verticalAlign: 'bottom'
                                }
                            }
                        }]
                    }

                });
            }
        }
    }
</script>