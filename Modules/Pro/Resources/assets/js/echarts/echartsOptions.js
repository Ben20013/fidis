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
import config from '$config';
import {
    fetch
} from '$api.js';

var echartsOptions = {
    line: function(opt) {
        var defaultSeries = {
            type: 'line', //曲线类型
            showAllSymbol: false,
            lineStyle: {
                color: '#4162ff' //----------
            },
            itemStyle: {
                color: '#4162ff' //----------
            },
            smooth: false, //控制曲线是否平滑显示
            markPoint: {
                symbol: 'circle',
                symbolSize: 10,
                data: opt.markPointData ? opt.markPointData : null,
                itemStyle: {
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    shadowColor: '#4162ff', //------
                    shadowOffsetX: 0,
                    shadowOffsetY: 0,
                    shadowBlur: 8
                },
                label: {
                    show: opt.markPointData ? true : false,
                    position: 'top',
                    distance: 5,
                    offset: [-50, -5],
                    padding: [5, 10],
                    color: '#ffffff',
                    borderRadius: 5,
                    fontFamily: 'HelveticaNeueLTStd-Roman',
                    backgroundColor: 'rgba(25, 31, 40, 0.8)',
                    align: 'left',
                    formatter: '{b}\n{a} : {c}'
                },
            },
            markLine: {
                label: {
                    position: 'middle',
                    // formatter:'{b} : {c}'
                },
                data: opt.markLineData ? opt.markLineData : []
            },
        }
        var yaxis = [];
        // 处理后台传来的数据
        if (opt.series.length != 0) {
            for (var i = 0; i < opt.series.length; i++) {
                let yaxisItem = {
                        show: opt.series.length == 1 ? true : false,
                        type: 'value',
                        name: '', //opt.series[i].name
                        min: opt.series[i].min || opt.min || null,
                        max: opt.series[i].max || opt.max || null,
                        axisLine: {
                            show: false
                        },
                        axisLabel: {
                            formatter: '{value}'
                        },
                        axisTick: {
                            show: false
                        },
                        splitLine: {
                            lineStyle: {
                                type: 'dashed',
                                color: '#e5e5e5',
                            }
                        }
                    }
                    // yaxis.push(yaxisItem);
                if (opt.multiyAxis == undefined || opt.multiyAxis) { //使用多Y轴
                    yaxis.push(yaxisItem);
                } else { // 共用Y轴
                    if (!yaxis.length) {
                        yaxis.push(yaxisItem);
                    }
                }
                if (!opt.lineColor) {
                    opt.lineColor = []
                }
                if (typeof opt.lineColor == 'string') {
                    opt.lineColor = [opt.lineColor];
                }
                opt.series[i] = (function(defaultObj, newObj, color) {
                    let copy = $.extend(true, {}, defaultObj);
                    if (color) {
                        copy.lineStyle.color = color;
                        copy.itemStyle.color = color;
                        copy.markPoint.itemStyle.shadowColor = color;
                    }
                    return Object.assign({}, copy, newObj);
                })(defaultSeries, opt.series[i], opt.lineColor[i]);
                opt.series[i]['yAxisIndex'] = opt.multiyAxis == undefined || opt.multiyAxis ? i : 0;
            }
        }
        // console.log(yaxis);
        var option = {
            title: {
                show: false,
                text: opt.name
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross', //跟随鼠标有一条横轴虚线
                    label: {
                        backgroundColor: '#6a7985' //横轴字背景颜色
                    }
                },
                textStyle: {
                    align: 'left'
                }
            },
            legend: {
                show: opt.legendData && opt.legendData.length > 1,
                data: opt.legendData, //导航栏
                right: '30',
            },
            grid: {
                left: 20,
                right: 20,
                bottom: 20,
                containLabel: true,
                borderColor: '#f3f3f3'
            },
            xAxis: [{
                type: 'category',
                boundaryGap: false,
                data: opt.xAxis,
                axisLine: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                axisLabel: {
                    formatter: function(value, index) {
                        if (!/^[1-9]\d{3}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}$/.test(value)) {
                            return value;
                        }
                        let dataArr = value.split(' ');
                        return dataArr[0] + '\n' + dataArr[1];
                    }
                }
            }],
            yAxis: yaxis,
            series: opt.series
        };
        return option;
    },
    gauge: function(opt) {
        let color = [
            [1, '#67c23a']
        ];
        if (opt.max && opt.color) {
            if (Array.isArray(opt.color)) {
                let tmpcolor = $.extend(true, [], opt.color);
                for (var i = 0; i < opt.color.length; i++) {
                    if (Array.isArray(opt.color[i]) && opt.color[i].length) {
                        tmpcolor[i][0] = (opt.color[i][0] / opt.max).toFixed(2);
                    }
                }
                color = tmpcolor;
            } else if (typeof opt.color == 'string') {
                color[0][1] = opt.color;
            }
        }
        var option = {
            backgroundColor: 'rgba(0, 0, 0, 0.0)',
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c}"
            },
            series: [{
                name: opt.name ? opt.name : '',
                type: 'gauge',
                radius: '100%',
                startAngle: 215,
                max: opt.max ? opt.max : 100,
                min: opt.min ? opt.min : 0,
                endAngle: -35,
                splitNumber: opt.steps ? opt.steps : 0,
                data: [{
                    value: opt.value ? opt.value : 0,
                    name: opt.name ? opt.name : '',
                    from: opt.from ? opt.from : ''
                }],
                axisLine: { // 坐标轴线
                    lineStyle: { // 属性lineStyle控制线条样式
                        color: color,
                        width: 3
                    }
                },
                axisLabel: { // 坐标轴小标记（文字）
                    distance: 3,
                    color: '#333333'
                },
                axisTick: { // 坐标轴小标记
                    length: 4, // 属性length控制线长
                    lineStyle: { // 属性lineStyle控制线条样式
                        color: 'auto'
                    }
                },
                splitLine: { // 分隔线
                    length: 8, // 属性length控制线长
                    lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                        width: 2,
                        color: 'auto'
                    }
                },
                pointer: { // 指针
                    shadowColor: '#ff2e4c',
                    width: 3,
                    length: '70%',
                },
                itemStyle: { //指针颜色
                    normal: {
                        color: 'auto'
                    },
                    emphasis: {
                        color: 'auto'
                    }
                },
                title: {
                    show: false,
                    offsetCenter: [0, '75%'],
                    fontSize: 13,
                    color: '#333333',
                    fontFamily: 'Microsoft YaHei'
                },
                detail: {
                    // backgroundColor: '#080d1b',
                    borderWidth: 0,
                    // borderColor: '#e5e5e5',
                    width: '100%',
                    height: 16,
                    fontSize: 14,
                    offsetCenter: [0, '80%'],
                    formatter: function(value) {
                        return value + (opt.unit ? opt.unit : '');
                    },
                    rich: {
                        a: {
                            color: '#103665',
                            width: 36,
                            height: 26,
                        }
                    }
                }
            }]
        };
        // console.log(JSON.stringify(option));
        return option;
    },
    pie: function(opt) {
        var default_series = {
            name: opt.name,
            type: 'pie',
            radius: '50%',
            center: ['50%', '60%'],
            data: opt.seriesData,
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
        if (Array.isArray(opt.series) && opt.series.length > 0) {
            for (let i = 0; i < opt.series.length; i++) {
                const element = opt.series[i];
                opt.series[i] = Object.assign({}, element, JSON.parse(JSON.stringify(default_series)))
            }
        }
        var option = {
            title: {
                show: false,
                text: opt.name,
                x: 'center'
            },
            color: ['#4162ff', '#3bbc6a', '#e24359', '#fdcd61', '#44b4ff', '#8000ff', '#ae00ae', '#ff8102', '#970000', '#9b9b00', '#939393', '#007700', '#397373'],
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                show: false,
                orient: 'vertical',
                x: 'left',
                data: opt.legendData
            },
            series: opt.series || []
        }
        return option;
    },
    bar: function(opt) {
        var defaultSeries = {
            type: 'bar',
            barWidth: '25%', //柱形的宽度
        };
        // 处理后台传来的数据
        if (opt.series.length != 0) {
            for (var i = 0; i < opt.series.length; i++) {
                // console.log(opt.series[i]);
                var tmp = Object.assign({}, defaultSeries, opt.series[i]);
                // console.log(tmp);
                opt.series[i] = tmp;
            }
        }
        // console.log(opt.series);
        var option = {
            title: {
                show: false,
                text: opt.name ? opt.name : '',
            },
            color: ['#4162ff', '#3bbc6a', '#e24359', '#fdcd61', '#44b4ff'],
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                textStyle: {
                    align: 'left'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            legend: {
                x: 'right',
                data: opt.legendData
            },
            xAxis: [{
                type: 'category',
                data: opt.xAxis,
                axisTick: {
                    alignWithLabel: true
                }
            }],
            yAxis: [{
                type: 'value',
                splitLine: {
                    lineStyle: {
                        type: 'dashed',
                        color: '#e5e5e5',
                    }
                }
            }],
            series: opt.series ? opt.series : []
        };
        return option;
    },
    circle: function(opt) {
        var option = {
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                data: opt.legend_data
            },
            series: [{
                name: opt.name,
                type: 'pie',
                radius: ['50%', '70%'], //控制是环形图还是饼状图
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '30',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data: opt.series_data ? opt.series_data : []
            }]
        };
        return option;
    },
    radar: function(opt) {
        var option = {
            title: {
                show: false,
                text: opt.name,
                x: 'center',
                top: '50%',
                textStyle: {
                    color: '#fff',
                    fontWeight: 'normal',
                    fontSize: 28
                }
            },
            tooltip: {},
            legend: {
                show: false,
                orient: 'vertical',
                x: 'right',
                y: 'top',
                data: opt.legendData
            },
            radar: {
                shape: 'circle',
                name: {
                    textStyle: {
                        color: '#666666'
                    }
                },
                nameGap: 10,
                indicator: function() {
                    var indicator = [];
                    for (var i = 0; i < opt.indicator.length; i++) {
                        var item = {
                            from: opt.indicator[i].from,
                            text: opt.indicator[i].name,
                            max: opt.indicator[i].max,
                            min: 0
                        };
                        indicator.push(item);
                    }
                    return indicator;
                }(),
                center: ['50%', '56%'], //  雷达图相对位置
                radius: 90, //雷达图大小
                //轴线颜色
                axisLine: {
                    lineStyle: {
                        type: 'dashed',
                        color: '#383D42'
                    }
                },
                // 雷达图背景网格线的颜色
                splitLine: {
                    show: true,
                    lineStyle: {
                        width: 1,
                        color: '#393F43'
                    }
                },
                //雷达图背景色分隔
                splitArea: {
                    show: true,
                    areaStyle: {
                        color: ['#ffffff', '#e5e5e5']
                    }
                },
                //雷达图文本
                name: {
                    textStyle: {
                        fontSize: 12,
                        color: '#8e8e9a'
                    }
                }
            },
            series: [{
                name: opt.name ? opt.name : '',
                type: opt.type ? opt.type : 'radar',
                data: opt.seriesData ? opt.seriesData : [],
                itemStyle: { //雷达图样式
                    color: '#3F5FE3',
                    normal: {
                        areaStyle: {
                            type: 'default'
                        },
                        color: "#4162ff" //雷达图填充背景色

                    }
                },
            }]
        };
        return option;
    },
    monitor: function(opt) {
        let strArr = [];
        if (opt.itemData && opt.itemData.length) {
            let itemData = opt.itemData;
            for (var i = 0; i < itemData.length; i++) {
                let style = '';
                let item = itemData[i]
                if (item.position && typeof item.position == 'object') {
                    let obj = item.position;
                    for (var key in obj) {
                        if (obj.hasOwnProperty(key)) {
                            style += key + ':' + obj[key] + ';';
                        }
                    }
                }
                if (item.type !== undefined) {
                    if (item.type == 'liquid') {
                        let step = item.step ? Number(item.step) : 5
                        let scaleArr = []
                        let max = item.max ? Number(item.max) : 100
                        let min = item.min ? Number(item.min) : 0
                        let all = max - min
                        let unitValue = parseInt(all / step)
                        let stepValue = min
                        for (let i = 0; i <= step; i++) {
                            stepValue = i == step ? max : stepValue
                            let s_str = `<div class="split"><span class="num">${stepValue}</span></div>`
                            scaleArr.push(s_str)
                            stepValue += unitValue
                        }
                        let t_str = `
                        <div class="liquid-level-map" style="${style}">
                            <div class="liquid-level-map__bar" style="width: ${item.width?item.width:14}px;">
                            <div class="liquid-level-map__value" id="monitorLiquid-${item.id}" ></div>
                            </div>
                            <div class="liquid-level-map__scale" style="display: ${typeof(item.showScale)=='undefined'?'flex':(item.showScale?'flex':'none')}">
                                ${scaleArr.reverse().join('')}
                            </div>
                        </div>
                        `
                        strArr.push(t_str)
                        continue
                    }
                    if (item.type == 'status') {
                        let s_str = `<div class="status-map" id="monitorStatus-${item.id}" style="${style}"></div>`
                        strArr.push(s_str)
                        continue
                    }
                    if (item.type == 'light') {
                        let s_str = `<div class="status-light" id="monitorStatus-${item.id}" style="${style}"></div>`
                        strArr.push(s_str)
                        continue
                    }
                }
                let vstr = [];
                if (Array.isArray(item.id)) {
                    for (var j = 0; j < item.id.length; j++) {
                        let statistics = '';
                        if (opt.statistics || opt.cumulative) {
                            let statistics_id = opt.statistics ? opt.statistics.id : '' || opt.cumulative ? opt.cumulative.id : '';
                            if (typeof statistics_id == 'string' && statistics_id == item.id[j] ||
                                Array.isArray(statistics_id) && statistics_id.includes(item.id[j])) {
                                statistics = 'statistics_';
                            }
                        }
                        let id = opt.attribute + '_' + statistics + item.id[j];
                        // let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + itemData[i].id[j];
                        vstr.push('<span id="' + id + '">0</span>');
                        if (item['split'] && j != item.id.length - 1) {
                            vstr.push('<span class="split">' + item['split'] + '</span>');
                        }
                    }

                } else {
                    let statistics = '';
                    if (opt.statistics || opt.cumulative) {
                        let statistics_id = opt.statistics ? opt.statistics.id : '' || opt.cumulative ? opt.cumulative.id : '';
                        if (typeof statistics_id == 'string' && statistics_id == item['id'] ||
                            Array.isArray(statistics_id) && statistics_id.includes(item['id'])) {
                            statistics = 'statistics_';
                        }
                    }
                    let id = opt.attribute + '_' + statistics + item['id'];
                    // let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + itemData[i].id;
                    vstr.push('<span id="' + id + '">0</span>');
                }
                strArr.push('<div class="textItemY" style="' + style + '">');
                strArr.push('<div class="name">' + item.name + (item.unit ? '/' + item.unit : '') + '</div>');
                strArr.push('<div class="value">' + vstr.join('') + '</div>');
                strArr.push('</div>');
            }
        }
        let statusStr = [];
        if (opt.statusData && opt.statusData.length) {
            let statusData = opt.statusData;
            for (var i = 0; i < statusData.length; i++) {
                let code = statusData[i].flagCode;
                let bgcolor = statusData[i].flagColor ? statusData[i].flagColor[code] : '#ffffff';
                let flagname = statusData[i].flag[code];
                statusStr.push('<div class="mix-status">' + statusData[i].name +
                    '：<span><div id="statusBgColor_' + statusData[i].id + '" style="background-color: ' + bgcolor + ';"></div><span id="' +
                    opt.attribute + '_' + statusData[i].id + '">' + flagname + '</span></span></div>');
            }
        }
        let background = '';
        // let background = opt.background ? 'style="background-image:url(\'/modules/pro/static/image/monitor/' + opt.background + '\')"' : '';
        if (opt.background) {
            background = /^https?:\/\/.+/.test(opt.background) ?
                'background-image:url(' + opt.background + ');' :
                'background-image:url(\'/modules/pro/static/image/monitor/' + opt.background + '\');';
        }
        let monitorBgImgId = opt.monitorImages && opt.monitorImages['id'] ? ('id="monitorImage_' + opt.monitorImages['id'] + '"') : '';
        // console.log(strArr);
        let imgposStyle = '',
            monitorStyle = ''
        if (opt.style !== undefined) {
            let outerStyle = opt.style.outer
            let innerStyle = opt.style.inner
            if (outerStyle !== undefined && typeof outerStyle == 'object') {
                for (const attr in outerStyle) {
                    if (outerStyle.hasOwnProperty(attr)) {
                        const value = outerStyle[attr];
                        imgposStyle += attr + ':' + value + ';'
                    }
                }
            }
            if (innerStyle !== undefined && typeof innerStyle == 'object') {
                for (const attr in innerStyle) {
                    if (innerStyle.hasOwnProperty(attr)) {
                        const value = innerStyle[attr];
                        monitorStyle += attr + ':' + value + ';'
                    }
                }
            }
        }
        let strTemplate = `
        <div class="groupImg">
          <div class="imgPos" style="${imgposStyle}">
            <div  data-monitor="${opt.background}" ${monitorBgImgId} class="imgBody" style="${background + monitorStyle}">
              ${strArr.join("")}
            </div>
          </div>
          <div class="statusPos">
            ${statusStr.join("")}
          </div>
        </div>
        `;
        if (opt.name !== undefined) {
            strTemplate = `
            <div class="echartsTitle">${opt.name}</div>
            <div class="echartsBody">
                ${strTemplate}
            </div>
            `;
        }
        // console.log(strTemplate);
        return strTemplate;
    },
    monitor3d: function(opt) {
        let strTemplate = `
        <div class="echartsTitle">${opt.name}</div>
        <div class="echartsBody">
            <iframe src = "${opt.src}" frameborder = "0" width = "100%" height = "100%" > </iframe>
        </div>
        `;
        // console.log(strTemplate);
        return strTemplate;
    },
    textData: function(opt) {
        var itemArr = [];
        // console.log(opt.textdata);
        if (opt.itemData.length > 0) {
            let itemData = opt.itemData;
            for (var i = 0; i < itemData.length; i++) {
                let value = itemData[i]['value'];
                if (itemData[i].flag && itemData[i].flag[value]) {
                    value = itemData[i].flag[value];
                }
                let unit = itemData[i]['unit'] ? itemData[i]['unit'] : '';
                let vstr = [];
                if (Array.isArray(itemData[i]['id'])) {
                    for (var j = 0; j < itemData[i]['id'].length; j++) {
                        let statistics = '';
                        if (opt.statistics || opt.cumulative) {
                            let statistics_id = opt.statistics ? opt.statistics.id : '' || opt.cumulative ? opt.cumulative.id : '';
                            if (typeof statistics_id == 'string' && statistics_id == itemData[i]['id'][j] ||
                                Array.isArray(statistics_id) && statistics_id.includes(itemData[i]['id'][j])) {
                                statistics = 'statistics_';
                            }
                        }
                        let id = opt.attribute + '_' + statistics + itemData[i]['id'][j];
                        // let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + itemData[i]['id'][j];
                        vstr.push('<span id="' + id + '">' + value + '</span>&nbsp;');
                        if (itemData[i]['split'] && j != itemData[i]['id'].length - 1) {
                            vstr.push('<span class="split">' + itemData[i]['split'] + '</span>')
                        }
                    }
                } else {
                    let statistics = '';
                    if (opt.statistics || opt.cumulative) {
                        let statistics_id = opt.statistics ? opt.statistics.id : '' || opt.cumulative ? opt.cumulative.id : '';
                        if (typeof statistics_id == 'string' && statistics_id == itemData[i]['id'] ||
                            Array.isArray(statistics_id) && statistics_id.includes(itemData[i]['id'])) {
                            statistics = 'statistics_';
                        }
                    }
                    let id = opt.attribute + '_' + statistics + itemData[i]['id'];
                    // let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + itemData[i]['id']
                    vstr.push('<span id="' + id + '">' + value + '</span>&nbsp;');
                }
                itemArr.push('<div class="textdataitem">');
                itemArr.push('<div class="name">' + itemData[i]['name'] + '</div>')
                itemArr.push('<div class="value">' + vstr.join('') + unit + '</div>')
                itemArr.push('</div>');
            }
        }
        var strTemplate = `
      <div class="echartsTitle">${opt.name}</div>
      <div id="echarts_${opt.attribute}" class="echartsBody" style="overflow-x:hidden;overflow-y:auto;">${itemArr.join('')}</div>
    `;
        return strTemplate;
    },
    card: function(opt) {
        var itemArr = [];
        if (opt.itemData) {
            let fontColorStyle = opt.fontColor ? ' style="color:' + opt.fontColor + ';"' : '';
            let splitLineColor = opt.fontColor ? ' style="border-color:' + opt.fontColor + ';"' : '';
            if (Array.isArray(opt.itemData)) {
                let len = opt.itemData.length;
                for (var i = 0; i < len; i++) {
                    let value = '';
                    if (opt.itemData[i].flag && opt.itemData[i].flag[opt.itemData[i].value]) {
                        value = opt.itemData[i].flag[opt.itemData[i].value];
                    } else {
                        value = opt.itemData[i].value;
                    }
                    let vstr = [];
                    if (Array.isArray(opt.itemData[i].id)) {
                        for (var j = 0; j < opt.itemData[i].id.length; j++) {
                            let statistics = '';
                            if (opt.statistics || opt.cumulative) {
                                let statistics_id = opt.statistics ? opt.statistics.id : '' || opt.cumulative ? opt.cumulative.id : '';
                                if (typeof statistics_id == 'string' && statistics_id == opt.itemData[i].id[j] ||
                                    Array.isArray(statistics_id) && statistics_id.includes(opt.itemData[i].id[j])) {
                                    statistics = 'statistics_';
                                }
                            }
                            let id = opt.attribute + '_' + statistics + '_' + opt.itemData[i].id[j];
                            // let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + opt.itemData[i].id[j];
                            vstr.push('<span id="' + id + '">' + value + '</span>');
                            if (opt.itemData[i]['split'] && j != opt.itemData[i].id.length - 1) {
                                vstr.push('<span class="split">' + opt.itemData[i]['split'] + '</span>');
                            }
                        }
                    } else {
                        let statistics = '';
                        if (opt.statistics || opt.cumulative) {
                            let statistics_id = opt.statistics ? opt.statistics.id : '' || opt.cumulative ? opt.cumulative.id : '';
                            if (typeof statistics_id == 'string' && statistics_id == opt.itemData[i].id ||
                                Array.isArray(statistics_id) && statistics_id.includes(opt.itemData[i].id)) {
                                statistics = 'statistics_';
                            }
                        }
                        let id = opt.attribute + '_' + statistics + opt.itemData[i].id;
                        // let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + opt.itemData[i].id;
                        vstr.push('<span id="' + id + '">' + value + '</span>');
                    }
                    itemArr.push('<div class="itemCard flex-column">');
                    itemArr.push('<div class="value" ' + fontColorStyle + '>' + vstr.join('') + '</div>');
                    itemArr.push('<div class="splitLine" ' + splitLineColor + '></div>');
                    let show_name = opt.itemData[i].name + (opt.itemData[i].unit ? ('(' + opt.itemData[i].unit + ')') : '');
                    itemArr.push('<div class="name" ' + fontColorStyle + '>' + show_name + '</div>');
                    itemArr.push('</div>');
                }
            } else {
                let value = '';
                if (opt.itemData.flag && opt.itemData.flag[opt.itemData.value]) {
                    value = opt.itemData.flag[opt.itemData.value];
                } else {
                    value = opt.itemData.value;
                }
                let vstr = [];
                if (Array.isArray(opt.itemData.id)) {
                    for (var j = 0; j < opt.itemData.id.length; j++) {
                        let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + opt.itemData.id[j];
                        vstr.push('<span id="' + id + '">' + value + '</span>');
                        if (opt.itemData['split'] && j != opt.itemData.id.length - 1) {
                            vstr.push('<span class="split">' + opt.itemData['split'] + '</span>');
                        }
                    }
                } else {
                    let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + opt.itemData.id;
                    vstr.push('<span id="' + id + '">' + value + '</span>');
                }
                itemArr.push('<div class="itemCard  flex-column">');
                itemArr.push('<div class="value" ' + fontColorStyle + '>' + vstr.join('') + '</div>');
                itemArr.push('<div class="splitLine" ' + splitLineColor + '></div>');
                itemArr.push('<div class="name" ' + fontColorStyle + '>' + opt.itemData.name + (opt.itemData.unit ? ('(' + opt.itemData.unit + ')') : '') + '</div>');
                itemArr.push('</div>');
            }
            let bgStyle = opt.backgroundColor ? 'style="background-color:' + opt.backgroundColor + ';"' : '';
            var strTemplate = `
              <div class="cardWrap flex-wrap" ${bgStyle}>
              ${itemArr.join('')}
              </div>
            `;
            return strTemplate;
        }
        return '';
    },
    cardX: function(opt) {
        var itemArr = [];
        if (opt.itemData) {
            let fontColorStyle = opt.fontColor ? ' style="color:' + opt.fontColor + ';"' : '';
            if (Array.isArray(opt.itemData)) {
                let len = opt.itemData.length;
                for (var i = 0; i < len; i++) {
                    let value = '';
                    if (opt.itemData[i].flag && opt.itemData[i].flag[opt.itemData[i].value]) {
                        value = opt.itemData[i].flag[opt.itemData[i].value];
                    } else {
                        value = opt.itemData[i].value;
                    }
                    let vstr = [];
                    if (Array.isArray(opt.itemData[i].id)) {
                        for (var j = 0; j < opt.itemData[i].id.length; j++) {
                            let statistics = '';
                            if (opt.statistics || opt.cumulative) {
                                let statistics_id = opt.statistics ? opt.statistics.id : '' || opt.cumulative ? opt.cumulative.id : '';
                                if (typeof statistics_id == 'string' && statistics_id == opt.itemData[i].id[j] ||
                                    Array.isArray(statistics_id) && statistics_id.includes(opt.itemData[i].id[j])) {
                                    statistics = 'statistics_';
                                }
                            }
                            let id = opt.attribute + '_' + statistics + opt.itemData[i].id[j];
                            // let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + opt.itemData[i].id[j];
                            vstr.push('<span id="' + id + '">' + value + '</span>&nbsp;');
                            if (opt.itemData[i]['split'] && j != opt.itemData[i].id.length - 1) {
                                vstr.push('<span class="split">' + opt.itemData[i]['split'] + '</span>');
                            }
                        }
                    } else {
                        let statistics = '';
                        if (opt.statistics || opt.cumulative) {
                            let statistics_id = opt.statistics ? opt.statistics.id : '' || opt.cumulative ? opt.cumulative.id : '';
                            if (typeof statistics_id == 'string' && statistics_id == opt.itemData[i].id ||
                                Array.isArray(statistics_id) && statistics_id.includes(opt.itemData[i].id)) {
                                statistics = 'statistics_';
                            }
                        }
                        let id = opt.attribute + '_' + statistics + opt.itemData[i].id;
                        // let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + opt.itemData[i].id;
                        vstr.push('<span id="' + id + '">' + value + '</span>&nbsp;');
                    }
                    itemArr.push('<div class="itemCardX flex-wrap">');
                    itemArr.push('<div class="name" ' + fontColorStyle + '>' + opt.itemData[i].name + '：</div>');
                    itemArr.push('<div class="value" ' + fontColorStyle + '>' + vstr.join('') + (opt.itemData[i].unit ? opt.itemData[i].unit : '') + '</div>');
                    itemArr.push('</div>');
                }
            } else {
                let value = '';
                if (opt.itemData.flag && opt.itemData.flag[opt.itemData.value]) {
                    value = opt.itemData.flag[opt.itemData.value];
                } else {
                    value = opt.itemData.value;
                }
                let vstr = [];
                if (Array.isArray(opt.itemData.id)) {
                    for (var j = 0; j < opt.itemData.id.length; j++) {
                        let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + opt.itemData.id[j];
                        vstr.push('<span id="' + id + '">' + value + '</span>&nbsp;');
                        if (opt.itemData['split'] && j != opt.itemData.id.length - 1) {
                            vstr.push('<span class="split">' + opt.itemData['split'] + '</span>');
                        }
                    }
                } else {
                    let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + opt.itemData.id;
                    vstr.push('<span id="' + id + '">' + value + '</span>&nbsp;');
                }
                itemArr.push('<div class="itemCardX flex-wrap">');
                itemArr.push('<div class="name" ' + fontColorStyle + '>' + opt.itemData.name + '：</div>');
                itemArr.push('<div class="value" ' + fontColorStyle + '>' + vstr.join('') + (opt.itemData.unit ? opt.itemData.unit : '') + '</div>');
                itemArr.push('</div>');
            }

            let bgStyle = opt.backgroundColor ? 'style="background-color:' + opt.backgroundColor + ';"' : '';
            var strTemplate = `
        <div class="cardWrap flex-wrap" ${bgStyle}>
        ${itemArr.join('')}
        </div>
      `;
            return strTemplate;
        }
        return '';
    },
    cardGroup: function(opt) {
        var itemArr = [];
        if (opt.itemData.length > 0) {
            for (var i = 0; i < opt.itemData.length; i++) {
                itemArr.push('<div class="itemCard flex-column">');
                itemArr.push('<div class="value" id="' + opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + opt.itemData[i].id + '">' + opt.itemData[i].value + '</div>');
                itemArr.push('<div class="name">' + opt.itemData[i].name + (opt.itemData[i].unit ? ('(' + opt.itemData[i].unit + ')') : '') + '</div>');
                itemArr.push('</div>');
            }
        }
        var strTemplate = `
      <div class="cardGroupWrap">
      ${itemArr.join('')}
      </div>
    `;
        return strTemplate;
    },
    bdMap: function(opt) {
        //
        var strTemplate = `
      <div class="echartsTitle flex-wrap echartsBdMapTitle">
        <span class="name">${opt.name}</span>
        <span class="echartsBdmapFullscreenIcon"></span>
      </div>
      <div class="echartsBody">
        <div class="mapWrap flex-column">
          <div id="bdMap_${opt.attribute}" class="mapContainer"></div>
        </div>
      </div>
    `;
        return strTemplate;
    },
    grid: function(opt) {
        var itemArr = [];
        var tbodyId = 'dashBoardGridTableContentBody_' + opt.attribute;
        if (opt.gridTitle.length > 0) {
            itemArr.push('<table>');
            var col = opt.gridTitle.length;
            itemArr.push('<tr>');
            for (var i = 0; i < col; i++) {
                itemArr.push('<th>' + opt.gridTitle[i] + '</th>');
            }
            itemArr.push('</tr>');
            itemArr.push('<tbody id="' + tbodyId + '">');
            if (opt.gridData.length > 0) {
                for (var k = 0; k < opt.gridData.length; k++) { //row
                    itemArr.push('<tr>');
                    for (var j = 0; j < col; j++) {
                        if (typeof opt.gridData[k][j] == 'object') {
                            itemArr.push('<td>');
                            itemArr.push('<a href="' + opt.gridData[k][j]['link'] + '">' + opt.gridData[k][j]['content'] + '</a>');
                            itemArr.push('</td>');
                        } else {
                            itemArr.push('<td>' + opt.gridData[k][j] + '</td>');
                        }
                    }
                    itemArr.push('</tr>');
                }
            } else {
                itemArr.push('<tr><td colspan="' + col + '" style="text-align:center;">暂无数据</td></tr>');
            }

            itemArr.push('</tbody>');
            itemArr.push('</table>');
        }
        var strTemplate = `
          <div class="echartsTitle">${opt.name}</div>
          <div class="echartsBody">
            <div class="grid flex-column">
              ${itemArr.join('')}
            </div>
          </div>
        `;
        // console.log(opt.equipmentId);
        if (!opt.params || !opt.url) {
            return strTemplate;
        }
        let url = '';
        let data = null;
        let params = null;
        switch (opt.url) {
            case 'service':
                url = config.apiq.service + '/public_get_list';
                params = opt.params ? opt.params : {
                    'service_name': 'name',
                    'date': 'time',
                    'size': 10
                };
                data = {
                    'condition': '[["equipment_id", "=", "' + opt.equipmentId + '"]]',
                    'page_size': params['size'] ? params['size'] : 10
                };
                break;
            case 'activity':
                url = config.apiq.work + '/public_get_list';
                params = opt.params ? opt.params : {
                    'activity_name': 'name',
                    'date': 'time',
                    'size': 10
                };
                data = {
                    'condition': '[["equipment_id", "=", "' + opt.equipmentId + '"]]',
                    'page_size': params['size'] ? params['size'] : 10
                };
                break;
            case 'alarm':
                url = config.apiq.alarm + '/public_get_list';
                params = opt.params ? opt.params : {
                    'alert_name': 'name',
                    'created': 'time',
                    'size': 10
                };
                data = {
                    'condition': '[["equipment_id", "=", "' + opt.equipmentId + '"]]',
                    'page_size': params['size'] ? params['size'] : 10
                };
                break;
            case 'fault':
                url = config.apiq.fault + '/public_get_list';
                params = opt.params ? opt.params : {
                    'falult_name': 'name',
                    'created': 'time',
                    'size': 10
                };
                data = {
                    'condition': '[["equipment_id", "=", "' + opt.equipmentId + '"]]',
                    'page_size': params['size'] ? params['size'] : 10
                };
                break;
            case 'warn':
                url = config.apiq.device + '/public_get_warn_info';
                params = opt.params ? opt.params : {
                    'name': 'name',
                    'date': 'time',
                    'description': 'description',
                    'type': 'type',
                    'size': params['size'] ? params['size'] : 10
                };
                data = {
                    'equipment_id': opt.equipmentId,
                    'total': params['size'] ? params['size'] : 10
                };
                break;
            case 'task':
                url = config.apiq.device + '/public_get_task_info';
                params = opt.params ? opt.params : {
                    'name': 'name',
                    'date': 'time',
                    'description': 'description',
                    'type': 'type',
                    'size': params['size'] ? params['size'] : 10
                };
                data = {
                    'equipment_id': opt.equipmentId,
                    'total': params['size'] ? params['size'] : 10
                };
                break;
            default:
        }
        fetch(url, 'post', data, opt.token)
            .then((data) => {
                let tbody = document.getElementById(tbodyId);
                let itemArr = [];
                let col = opt.gridTitle.length;
                let gridData = data.result.data;
                // let params = opt.params?opt.params:{'alert_name':'name','created':'time'};
                for (var k = 0; k < gridData.length; k++) { //row
                    itemArr.push('<tr>');
                    for (var key in gridData[k]) {
                        if (gridData[k].hasOwnProperty(key) && params.hasOwnProperty(key) && key != 'size') {
                            itemArr.push('<td>' + gridData[k][key] + '</td>');
                        }
                    }
                    itemArr.push('</tr>');
                }
                if (itemArr.length == 0) {
                    itemArr.push('<tr><td colspan="' + col + '" style="text-align:center;">暂无数据</td></tr>');
                }
                tbody.innerHTML = itemArr.join("");
                // console.log(tbody);
            })
            .catch((error) => {
                let tbody = document.getElementById(tbodyId);
                let itemArr = [];
                itemArr.push('<tr><td colspan="' + col + '" style="text-align:center;">获取数据出错</td></tr>');
                tbody.innerHTML = itemArr.join("");
                // return strTemplate;
            });
        return strTemplate;
    },
    crewCard: function(opt) {
        let itemArr = [];
        if (opt.itemData.length > 0) {
            for (var i = 0; i < opt.itemData.length; i++) {
                let vstr = [];
                if (Array.isArray(opt.itemData[i].id)) {
                    for (var j = 0; j < opt.itemData[i].id.length; j++) {
                        let statistics = '';
                        if (opt.statistics || opt.cumulative) {
                            let statistics_id = opt.statistics ? opt.statistics.id : '' || opt.cumulative ? opt.cumulative.id : '';
                            if (typeof statistics_id == 'string' && statistics_id == opt.itemData[i].id[j] ||
                                Array.isArray(statistics_id) && statistics_id.includes(opt.itemData[i].id[j])) {
                                statistics = 'statistics_';
                            }
                        }
                        let id = opt.attribute + '_' + statistics + opt.itemData[i].id[j];
                        // let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + opt.itemData[i].id[j];
                        vstr.push('<span id="' + id + '">' + opt.itemData[i].value + '</span>&nbsp;');
                        if (opt.itemData[i]['split'] && opt.itemData[i].id.length - 1 != j) {
                            vstr.push('<span class="split">' + opt.itemData[i]['split'] + '</span>');
                        }
                    }
                } else {
                    let statistics = '';
                    if (opt.statistics || opt.cumulative) {
                        let statistics_id = opt.statistics ? opt.statistics.id : '' || opt.cumulative ? opt.cumulative.id : '';
                        if (typeof statistics_id == 'string' && statistics_id == opt.itemData[i].id ||
                            Array.isArray(statistics_id) && statistics_id.includes(opt.itemData[i].id)) {
                            statistics = 'statistics_';
                        }
                    }
                    let id = opt.attribute + '_' + statistics + opt.itemData[i].id;
                    // let id = opt.attribute + '_' + (opt.statistics || opt.cumulative ? 'statistics_' : '') + opt.itemData[i].id;
                    vstr.push('<span id="' + id + '">' + opt.itemData[i].value + '</span>&nbsp;');
                }
                itemArr.push('<div class="crewCardItem flex-wrap">');
                itemArr.push('<div class="name">' + opt.itemData[i].name + '</div>');
                itemArr.push('<div class="value">' + vstr.join('') + (opt.itemData[i].unit ? opt.itemData[i].unit : '') + '</div>');
                itemArr.push('</div>');
            }
        }
        let statusStr = '';
        if (opt.statusData && typeof opt.statusData == 'object') {
            let bgcolor = '';
            if (opt.statusData.flagCode && opt.statusData.flagColor && opt.statusData.flagColor[opt.statusData.flagCode]) {
                bgcolor = 'background-color:' + opt.statusData.flagColor[opt.statusData.flagCode] + ';';
            }
            statusStr = '<span class="crewCardStatus" style="' + bgcolor + '" id="statusBgColor_' + opt.statusData.id + '"></span>';
        }

        var strTemplate = `
          <div class="echartsTitle">
            ${opt.name}
            ${statusStr}
          </div>
          <div class="echartsBody">
            <div class="crewCard">
              ${itemArr.join('')}
            </div>
          </div>
        `;
        return strTemplate;
    },
    video: function(opt) {
        let platform = {
            'ys7': {
                'script': '/modules/pro/static/js/ezuikit.js',
                'name': '萤石云'
            }
        };
        if (!document.getElementById('videoScript_' + opt.platform)) {
            let script = document.createElement('SCRIPT');
            script.setAttribute('id', 'videoScript_' + opt.platform);
            script.setAttribute('src', platform[opt.platform]['script']);
            document.querySelector('head').appendChild(script);
        }
        var strTemplate = `
        <div class="echartsTitle">${opt.name}</div>
        <div class="echartsBody"></div>
      `;
        return strTemplate;
    },
};

export default echartsOptions
