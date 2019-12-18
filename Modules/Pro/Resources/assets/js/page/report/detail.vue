<!-- 
/******************************************************************************
 * Copyright (c) 2019-2021 Mixlinker Networks Inc. <mixiot@mixlinker.com>
 * All rights reserved.
 *
 * This program and the accompanying materials are made available under the
 * terms of the Application License of Mixlinker Networks License and Mixlinker
 * Distribution License which accompany this distribution.
 *
 * The Mixlinker License is available at
 *    http://www.mixlinker.com/legal/license.html
 * and the Mixlinker Distribution License is available at
 *    http://www.mixlinker.com/legal/distribution.html
 *
 * Contributors:
 *    Mixlinker Technical Team
 *****************************************************************************/
 -->
<template>
    <div class="cont-box flex-column">
        <div class="detail-container">
            <iframe
                v-if="infoData!=null"
                id="reportDetailIframe"
                :src="'modules/pro/static/report/reportPrint.html?id='+outPutId"
                :data-title="infoData.output_name"
                :data-reference="infoData.reference"
                frameborder="0"
                width="100%"
                height="100%"
            ></iframe>
            <!-- <div class="title-wrap"  v-if="infoData!=null">
				<span class="title">{{infoData.output_name}}</span>
			</div>
			<div class="content-wrap flex-column" id="mixReportContainer">
				<div class="no-data flex-column" v-if="isNodata">
	        <img src="/static/images/public/no-data-icon.png" alt="">
	        <span>暂无相关数据</span>
	      </div>
			</div>
			<div class="botton-wrap flex-wrap">
				<div class="import-btn"  v-if="infoData!=null" @click="downloadFile(infoData.file)"><span>导出</span></div>
				<div class="close-btn" @click="$router.push({name:'report',path:'/report'})"><span>关闭</span></div>
            </div>-->
        </div>
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
    </div>
</template>

<script>
import reportApi from "@/assets/js/fetch/report";
import config from "$config";

export default {
    name: "reportDetail",
    props: {
        outPutId: Number
    },
    data() {
        return {
            infoData: null,
            isNodata: false,
            reference: null,
            md: {
                loading: false
            }
        };
    },

    created() {},
    mounted() {
        // console.log(config);
        let params = this.$route.params;
        if (params.outPutId && params.outPutName) {
            this.outPutId = params.outPutId;
            this.outPutName = params.outPutName;
        } else if (!this.outPutId) {
            this.$router.push({ name: "report", path: "/report" });
        }
        this.getInfo();
        let self = this;
        window.closeMixReportDetailWin = function() {
            self.$router.push({ name: "report", path: "/report" });
        };
        window.downloadReport = function() {
            var elink = document.createElement("a");
            elink.download = self.outPutName;
            elink.style.display = "none";
            elink.href = config.apir.download + "?output_id=" + self.outPutId;
            document.body.appendChild(elink);
            elink.click();
            document.body.removeChild(elink);
        };
    },
    methods: {
        getInfo() {
            if (!this.outPutId) {
                return;
            }
            let self = this;
            self.md["loading"] = true;
            reportApi.get_detail(
                function(data) {
                    if (data.code == 200) {
                        // console.log(data);
                        // console.log(JSON.parse(data.result.data.reference));
                        self.infoData = data.result;
                        if (self.infoData.reference) {
                            // self.dealReference(JSON.parse(self.infoData.reference));
                        } else {
                            self.isNodata = true;
                        }
                    }
                    self.md["loading"] = false;
                },
                { output_id: this.outPutId }
            );
        },
        downloadFile(path) {
            if (path == "" || path == null) {
                return;
            }
            let url = config.apir.downloadAddress + "?path=" + path;
            let iframe = document.createElement("iframe");
            iframe.style.display = "none";
            iframe.src = url;
            iframe.onload = function() {
                document.body.removeChild(iframe);
            };
            document.body.appendChild(iframe);
        },
        dealReference(data) {
            if (data.length) {
                let tmp = [];
                for (var i = 0; i < data.length; i++) {
                    if (data[i]["table"]) {
                        // this.reference['table']=data[i];
                        this.drawTable(data[i]["table"]);
                    } else if (data[i]["line_chart"]) {
                        // this.reference['line']=data[i];
                        this.dealChartData(data[i]["line_chart"]);
                    }
                }
            }
        },
        drawTable(data) {
            let table_str = [];
            if (data.length) {
                for (var i = 0; i < data.length; i++) {
                    table_str.push("<tr>");
                    for (var j = 0; j < data[i].length; j++) {
                        let cs =
                            j == data[i].length - 1 &&
                            data[i].length != data[data.length - 1].length
                                ? data[data.length - 1].length -
                                  data[i].length +
                                  1
                                : "1";
                        table_str.push(
                            '<td colspan="' + cs + '">' + data[i][j] + "</td>"
                        );
                    }
                    table_str.push("</tr>");
                }
            }
            let str_tmp = `<div class="mix-report-item-block">
				<table class="mix-report-table">
					${table_str.join("")}
				</table>
			</div>`;
            $("#mixReportContainer").append(str_tmp);
        },
        dealChartData(data) {
            let legend = Object.assign([], data[0]);
            legend.splice(0, 1);
            data.splice(0, 1);
            let xAxisData = [];
            let obj = {};
            for (var i = 0; i < data.length; i++) {
                xAxisData.push(data[i].splice(0, 1));
                for (var j = 0; j < data[i].length; j++) {
                    if (!obj[j]) {
                        obj[j] = [];
                    }
                    obj[j].push(data[i][j]);
                }
            }
            this.drawLine(legend, xAxisData, obj);
        },
        drawLine(legendData, xAxisData, seriesData) {
            let id = "line" + new Date().getTime();
            $("#mixReportContainer").append(
                '<div class="mix-report-item-block mix-report-chart" id="' +
                    id +
                    '"></div>'
            );
            let series = [];
            let yAxis = [];
            for (var key in seriesData) {
                if (seriesData.hasOwnProperty(key)) {
                    let yaxisItem = {
                        show: legendData.length == 1 ? true : false,
                        type: "value",
                        axisLine: {
                            show: false
                        },
                        axisTick: {
                            show: false
                        },
                        splitLine: {
                            lineStyle: {
                                color: "#f3f3f3"
                            }
                        }
                    };
                    yAxis.push(yaxisItem);
                    let obj = {
                        name: legendData[key],
                        type: "line",
                        data: seriesData[key],
                        yAxisIndex: key
                    };
                    series.push(obj);
                }
            }
            // 基于准备好的dom，初始化echarts实例
            let myChart = this.$echarts.init(document.getElementById(id));
            myChart.setOption({
                title: { show: false },
                color: [
                    "#4162ff",
                    "#3bbc6a",
                    "#e24359",
                    "#fdcd61",
                    "#44b4ff",
                    "#474c53",
                    "#8b9efc"
                ],
                tooltip: {
                    trigger: "axis",
                    axisPointer: {
                        type: "cross",
                        label: {
                            backgroundColor: "#6a7985"
                        }
                    },
                    textStyle: {
                        align: "left"
                    }
                },
                legend: {
                    top: "15",
                    right: "30",
                    data: legendData
                },
                calculable: true,
                grid: {
                    show: false,
                    left: 45,
                    right: 30,
                    bottom: 45
                },
                xAxis: [
                    {
                        type: "category",
                        boundaryGap: false,
                        axisLine: {
                            show: true
                        },
                        axisTick: {
                            show: false
                        },
                        splitLine: {
                            lineStyle: {
                                color: "#eeeeee"
                            }
                        },
                        data: xAxisData
                    }
                ],
                yAxis: yAxis,
                series: series
            });
        }
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/report/detail.scss";
</style>
<style rel="stylesheet/scss" lang="scss">
.mix-report-item-block {
    width: 90%;
    margin: 0 auto;
    margin-bottom: 20px;
    &.mix-report-chart {
        min-height: 400px;
    }
    table.mix-report-table {
        tr {
            td {
                height: 39px;
                border: 1px solid #dddddd;
                font-family: MicrosoftYaHei;
                font-size: 13px;
                font-weight: normal;
                font-stretch: normal;
                line-height: 28px;
                letter-spacing: 0px;
                color: #333333;
            }
        }
    }
}
</style>
