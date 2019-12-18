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
import '@/assets/js/resizeDiv/resize';
import echarts from 'echarts'
import echartsOptions from '@/assets/js/echarts/echartsOptions.js'
import config from '$config';
import {
    fetch
} from '$api.js';
import i18n from '../../../lang/i18n';

var mixEcharts = {
    ele: null,
    grid: null,
    oldDashBoard: '',
    jsonSocket: null,
    socketConnectCount: 0,
    updateAttribute: {},
    updateStatusText: {},
    cacheUpdateTextId: {},
    updateMonitorImage: {},
    getEquipmentStatusTimer: null,
    token: null,
    isDestroyed: false,
    videoCache: [],
    monitorLiquid: {},
    monitorStatus: {},
    drawDashBoard: (equipmentId, data, ele, currDashBoard, isMounted, token) => {
        // console.log('1111111111111111111');
        // console.log(mixEcharts.oldDashBoard);
        // currDashBoard = 'dashBoard-1';
        // equipmentId = '1001';
        if (typeof data != 'object' || !isMounted && mixEcharts.oldDashBoard == currDashBoard) {
            // console.log(data);
            return;
        }
        // console.log(data);
        // return;
        mixEcharts.ele = ele;
        mixEcharts.oldDashBoard = currDashBoard;
        if (token) {
            mixEcharts.token = token;
        }

        $(ele).html('');
        var tmpdata = null;
        // console.log(currDashBoard);
        for (var key in data) {
            if (data.hasOwnProperty(currDashBoard)) {
                // console.log(data[currDashBoard]);
                tmpdata = data[currDashBoard];
                break;
            }
        }
        // console.log(tmpdata);
        if (!tmpdata || tmpdata.length == 0) {
            return;
        }
        // console.log(tmpdata);
        mixEcharts.updateAttribute = {};
        mixEcharts.updateStatusText = {};
        mixEcharts.cacheUpdateTextId = {};
        if (mixEcharts.videoCache.length) {
            for (var i = 0; i < mixEcharts.videoCache.length; i++) {
                if (mixEcharts.videoCache[i].stop) {
                    try {
                        mixEcharts.videoCache[i].stop();
                    } catch (e) {
                        console.log(e);
                    }
                }
            }
            mixEcharts.videoCache = [];
        }
        if (tmpdata.dataType == 'images') {
            for (var i = 0; i < tmpdata.data.length; i++) {
                tmpdata.data[i].equipmentId = equipmentId;
                tmpdata.data[i].token = token;
                try {
                    mixEcharts.createEcharts(tmpdata.data[i], tmpdata.row, tmpdata.col);
                } catch (e) {
                    console.log(e);
                }
                // console.log(i);
            }
            // console.log($('#echartsViewTable').find('td:hidden'));
            $('#echartsViewTable').find('td:hidden').remove();
        } else if (tmpdata.dataType == 'text') {
            if ($("echartsTextContiner").length == 0) {
                $(ele).html('<div id="echartsTextContiner" class="echartsTextContiner"></div>')
            }
            for (var i = 0; i < tmpdata.data.length; i++) {
                tmpdata.data[i].equipmentId = equipmentId;
                tmpdata.data[i].token = token;
                mixEcharts.createTextRow(tmpdata.data[i]);
            }
        }
        // console.log($('#echartsViewTable').find('td:hidden'));
        // console.log(equipmentId);
        mixEcharts.getStatistic(equipmentId); //获取最新统计数据
        mixEcharts.socketConnectCount = 0;
        mixEcharts.isDestroyed = false;
        // console.log(mixEcharts.jsonSocket);
        if (mixEcharts.jsonSocket == null) {
            mixEcharts.createWebsocket(equipmentId); //'E_86484344663345'
            $(ele).delegate('.echartsBdmapFullscreenIcon', 'click', function() {
                let title = $(this).siblings('.name').text();
                mixEcharts.echartsFullScreenBdMap(equipmentId, title);
            });
        } else {
            mixEcharts.dashBoardSubscribe(equipmentId)
        }
    },
    createTextRow: (item) => {
        var itemArr = [];
        // console.log(item.itemData);
        if (item.itemData.length > 0) {
            let itemData = item.itemData;
            for (var i = 0; i < itemData.length; i++) {
                let value = itemData[i]['value'];
                if (itemData[i].flag) {
                    mixEcharts.updateStatusText[itemData[i].id] = itemData[i].flag;
                    if (itemData[i].flag[value]) {
                        value = itemData[i].flag[value];
                    }
                }
                let vstr = [];
                if (Array.isArray(itemData[i].id)) {
                    for (var j = 0; j < itemData[i].id.length; j++) {
                        vstr.push('<span id="' + item.attribute + '_' + (item.statistics || item.cumulative ? 'statistics_' : '') + itemData[i]['id'][j] + '">' + value + '</span>');
                        if (itemData[i]['split'] && j != itemData[i].id.length - 1) {
                            vstr.push('<span class="split">' + itemData[i]['split'] + '</span>');
                        }
                        if (itemData[i].cache !== false) {
                            if (mixEcharts.cacheUpdateTextId[itemData[i].id[j]]) {
                                mixEcharts.cacheUpdateTextId[itemData[i].id[j]].push(item.attribute);
                            } else {
                                mixEcharts.cacheUpdateTextId[itemData[i].id[j]] = [];
                                mixEcharts.cacheUpdateTextId[itemData[i].id[j]].push(item.attribute);
                            }
                        }
                    }
                } else {
                    vstr.push('<span id="' + item.attribute + '_' + (item.statistics || item.cumulative ? 'statistics_' : '') + itemData[i]['id'] + '">' + value + '</span>');
                    if (itemData[i].cache !== false) {
                        if (mixEcharts.cacheUpdateTextId[itemData[i].id]) {
                            mixEcharts.cacheUpdateTextId[itemData[i].id].push(item.attribute);
                        } else {
                            mixEcharts.cacheUpdateTextId[itemData[i].id] = [];
                            mixEcharts.cacheUpdateTextId[itemData[i].id].push(item.attribute);
                        }
                    }
                }
                itemArr.push('<div class="textdataitem">');
                itemArr.push('<div class="name">' + itemData[i]['name'] + '</div>');
                itemArr.push('<div class="value">' + vstr.join('') + (itemData[i]['unit'] && !itemData[i]['flag'] ? itemData[i]['unit'] : '') + '</div>');
                itemArr.push('</div>');
            }
        }
        // console.log(mixEcharts.updateStatusText);
        var strTemplate = `
    <div class="boxContainer">
      <div class="echartsTitle">${item.name}</div>
      <div id="echarts_${item.attribute}" class="echartsBody flex-wrap">${itemArr.join('')}</div>
    </div>
    `;
        $("#echartsTextContiner").append(strTemplate);
        // 配置了统计，累计的走接口
        if (item.statistics && item.statistics['type'] && item.statistics['id']) {
            mixEcharts.initStatisticsData(item, item.equipmentId, item.statistics, null);
        }
        if (item.cumulative && item.cumulative['id']) {
            mixEcharts.getCumulativeData(item);
        }
        if (item.equipmentStatus) {
            mixEcharts.getEquipmentStatus(item);
        }
    },
    createGrid: (row, col) => {
        var el = mixEcharts.ele;
        var clientWidth = $(el).width();
        var clientHeight = $(el).height();
        row = row ? row : 4;
        col = col ? col : 8;
        var w = Math.round(clientWidth / col); //行
        var h = Math.round(clientHeight / row); //列
        var tmpArr = [];
        tmpArr.push('<table id="echartsViewTable" class="echartTable">');
        tmpArr.push('<colgroup>')
        for (var k = 0; k < col; k++) {
            tmpArr.push('<col width="*" />')
        }
        tmpArr.push('</colgroup>')
        for (var i = 0; i < row; i++) {
            tmpArr.push('<tr class="echarts_table_row">');
            for (var j = 0; j < col; j++) {
                tmpArr.push('<td class="echarts_table_grid" style="height:' + w + 'px;"></td>');
            }
            tmpArr.push('</tr>');
        }
        tmpArr.push('</table>');
        if ($('#echartsViewTable').length == 0) {
            // console.log(tmpArr);
            $(el).html(tmpArr.join(''));
            mixEcharts.grid = { w: w, h: w }
        }
    },
    createEcharts: (item, row, col) => {
        mixEcharts.createGrid(row, col); //创建大小，并获取单元格宽高
        var grid = mixEcharts.grid;
        var posinfo = item.xys; //坐标、占用大小
        var option = mixEcharts.dealOptions(item); //获取配置项
        var table = $('#echartsViewTable');
        // console.log(table);
        var tr = table.find('tr.echarts_table_row');

        var $box = $('<div id="echarts_box_' + item.attribute + '" class="boxContainer ' + (item.type == 'cardGroup' ? 'custom' : '') + '" ></div>');
        // var width = grid.w * posinfo.len[1];
        var height = grid.h * posinfo.len[0];
        // $box.width(width-4);$box.height(height-4);//设置echarts图表宽高

        var targetTr = tr[posinfo.pos[0]];
        // console.log(targetTr);
        var td = targetTr.children;
        var targetTd = td[posinfo.pos[1]];

        $(targetTd).attr({ 'colspan': posinfo.len[1], 'rowspan': posinfo.len[0] });
        for (var i = posinfo.pos[0]; i < posinfo.pos[0] + posinfo.len[0]; i++) {
            let tmpTr = tr[i];
            let tmpTd = tmpTr.children;
            let len = tmpTd.length;
            for (var j = 0; j < len; j++) { //  j=4
                if (posinfo.pos[1] < j && (posinfo.pos[1] + posinfo.len[1]) > j || (i > posinfo.pos[0] && posinfo.pos[1] <= j && (posinfo.pos[1] + posinfo.len[1]) > j)) {
                    $(tmpTd[j]).hide();
                }
            }
        }

        $(targetTd).css({
            // width:width,
            height: height
        }).html($box);
        $box.width($(targetTd).width() - 4);
        $box.height($(targetTd).height() - 4); //设置echarts图表宽高
        // console.log($(targetTd));
        // console.log($(targetTd).height());

        if (typeof option != 'object' && typeof option == 'string') {
            $box.html(option);
            if (item.type == 'bdMap') {
                let mapId = 'bdMap_' + item.attribute;
                mixEcharts.getMapPoint(mapId, item);
                // mixEcharts.createBdMap(mapId,item);
            }
            if (item.type == 'video') {
                mixEcharts.initVideo($box.children('.echartsBody'), item)
            }
            // 查找存储flag对象
            mixEcharts.cacheItemId(item)

            // console.log(mixEcharts.updateStatusText);
            // console.log(mixEcharts.cacheUpdateTextId);
            if (item.statistics && item.statistics['type'] && item.statistics['id']) {
                mixEcharts.initStatisticsData(item, item.equipmentId, item.statistics, null);
            }
            if (item.cumulative && item.cumulative['id']) {
                mixEcharts.getCumulativeData(item);
            }
            if (item.equipmentStatus) {
                mixEcharts.getEquipmentStatus(item);
            }
            // window.addEventListener('resize',function(){
            //   mixEcharts.resizeEchartsTable(col);
            // });
            $(mixEcharts.ele).resize(function() {
                mixEcharts.resizeEchartsTable(col);
            });
            return false;
        } //文本类的 end
        if (item.from && !item.statistics && !item.cumulative) {
            // console.log(item.from);
            if (typeof item.from == 'string') {
                if (mixEcharts.updateAttribute[item.from]) {
                    mixEcharts.updateAttribute[item.from].push('echarts_' + item.type + item.attribute);
                } else {
                    mixEcharts.updateAttribute[item.from] = [];
                    mixEcharts.updateAttribute[item.from].push('echarts_' + item.type + item.attribute);
                    // console.log(mixEcharts.updateAttribute[item.from]);
                }
            } else if (item.from.length > 0) {
                for (var i = 0; i < item.from.length; i++) {
                    if (mixEcharts.updateAttribute[item.from[i]] && mixEcharts.updateAttribute[item.from[i]].indexOf('echarts_' + item.type + item.attribute) == -1) {
                        mixEcharts.updateAttribute[item.from[i]].push('echarts_' + item.type + item.attribute);
                    } else {
                        mixEcharts.updateAttribute[item.from[i]] = [];
                        mixEcharts.updateAttribute[item.from[i]].push('echarts_' + item.type + item.attribute);
                    }
                }
            }
        }
        // console.log(mixEcharts.updateAttribute);
        var $echartsTitle = $('<div class="echartsTitle">' + item.name + '</div>');
        var echartsId = 'echarts_' + item.type + item.attribute + (item.statistics ? '_statistics' : '');
        var $echartsBody = $('<div id="' + echartsId + '" class="echartsBody"></div>');
        $box.append($echartsTitle, $echartsBody);
        var myChart = echarts.init(document.getElementById(echartsId));
        // myChart.setOption(option,true);
        if (item.statistics || item.type == 'gauge' || item.type == 'pie') {
            // console.log(item.statistics);
            option.isupdate = true;
            myChart.setOption(option, true);
        } else {
            option.isupdate = false;
            myChart.setOption(option, true);
            fetch(config.apiq.get_latest_line_data, 'post', { 'equipment_id': item.equipmentId, 'keys': item.from })
            .then((data) => {
                let result = data.result;
                for (var key in result) {
                    if (result.hasOwnProperty(key)) {
                        let series_data = result[key]['data'];
                        let datetime = result[key]['datetime'];
                        // series_data = [100,120,140,130,120]
                        // datetime = ['2018-12-01 09:00:00','2018-12-01 09:01:01','2018-12-01 09:02:02','2018-12-01 09:03:03','2018-12-01 09:04:04']
                        let series = option.series;
                        if (!option.xAxis[0]['data'].length && Array.isArray(datetime)) {
                            option.xAxis[0]['data'] = datetime;
                        }
                        for (var i = 0; i < series.length; i++) {
                            if (series[i].from == key && Array.isArray(series_data)) {
                                option.series[i].data = series_data;
                            }
                        }
                    }
                }
                option.isupdate = true;
                myChart.setOption(option, true);
            })
            .catch((error) => {
                option.isupdate = true;
                myChart.setOption(option, true);
                console.log(error);
            })
        }
        $(mixEcharts.ele).resize(function() {
            mixEcharts.resizeEchartsTable(col);
            myChart.resize();
        });

        if (item.statistics && item.statistics['type'] && item.from) {
            if (item.type == 'bar' && !item.statistics['total']) {
                mixEcharts.getStatisticByPeriod(myChart, item.equipmentId, item.statistics, item.from);
            } else {
                mixEcharts.initStatisticsData(myChart, item.equipmentId, item.statistics, item.from);
            }
        }
        if (item.cumulative && item.cumulative['id']) {
            mixEcharts.getCumulativeData(item, myChart);
        }
        // myChart = null;
    },
    resizeEchartsTable: (col) => {
        let el = mixEcharts.ele;
        if ($('#echartsViewTable').length && el) {
            let $tds = $('#echartsViewTable').find('td.echarts_table_grid');
            var clientWidth = $(el).width();
            col = col ? col : 8;
            let w = Math.round(clientWidth / col);
            $tds.each(function() {
                let clen = $(this).attr('colspan');
                let rlen = $(this).attr('rowspan');
                clen = clen ? clen : 1;
                rlen = rlen ? rlen : 1;
                let width = w * clen;
                let height = w * rlen;
                $(this).css({
                    // width:width,
                    height: height
                });
                let $box = $(this).find('div.boxContainer');
                $box.width($(this).width() - 4);
                $box.height(height - 4); //设置echarts图表宽高
            });
        }
    },
    dealOptions: (opt) => {
        var option = null;
        var type = opt.type;
        switch (type) {
            case 'line':
                option = echartsOptions.line(opt);
                break;
            case 'gauge':
                option = echartsOptions.gauge(opt);
                break;
            case 'pie':
                option = echartsOptions.pie(opt);
                break;
            case 'bar':
                option = echartsOptions.bar(opt);
                break;
            case 'circle':
                option = echartsOptions.circle(opt);
                break;
            case 'radar':
                option = echartsOptions.radar(opt);
                break;
            case 'monitor':
                option = echartsOptions.monitor(opt);
                break;
            case 'monitor3d':
                option = echartsOptions.monitor3d(opt);
                break;
            case 'textData':
                option = echartsOptions.textData(opt);
                break;
            case 'card':
                option = echartsOptions.card(opt);
                break;
            case 'cardX':
                option = echartsOptions.cardX(opt);
                break;
            case 'cardGroup':
                option = echartsOptions.cardGroup(opt);
                break;
            case 'bdMap':
                option = echartsOptions.bdMap(opt);
                break;
            case 'grid':
                option = echartsOptions.grid(opt);
                break;
            case 'crewCard':
                option = echartsOptions.crewCard(opt);
                break;
            case 'video':
                option = echartsOptions.video(opt);
                break;
            default:

        }
        return option;
    },
    getMapPoint: (domId, opt) => {
        fetch(config.apiq.singleInMap, 'get', { 'equipment_id': opt.equipmentId }, mixEcharts.token)
            .then((data) => {
                if (data.code == 200) {
                    let info = data.result;
                    if (!info) {
                        mixEcharts.createBdMap(domId, opt);
                        return
                    }
                    let gis = info.gis.split(',');
                    // if (gis.length<2) {
                    //   return;
                    // }
                    opt.mapPoint = [];
                    opt.mapPoint.push({ "long": gis[1] ? gis[1] : '', 'lat': gis[0] ? gis[0] : '', "infoWin": { "title": info.equipment_name, 'imgPath': info.equipment_image, 'desc': info.description ? info.description : '' } });
                    mixEcharts.createBdMap(domId, opt);
                    // console.log(data);
                }
            }).catch((error) => {
                if (!opt.mapPoint) {
                    opt.mapPoint = [];
                }
                mixEcharts.createBdMap(domId, opt);
            });
    },
    createBdMap: (id, opt) => {
        // 百度地图API功能
        var map = new BMap.Map(id); // 创建Map实例
        // console.log(document.getElementById(id));
        // return;
        // map.centerAndZoom(new BMap.Point(opt.centerPoint.long,opt.centerPoint.lat), 10);  // 初始化地图,设置中心点坐标和地图级别
        // return;
        //添加地图类型控件
        map.addControl(new BMap.MapTypeControl({
            mapTypes: [
                BMAP_NORMAL_MAP,
                BMAP_HYBRID_MAP
            ]
        }));
        // map.setCurrentCity("深圳");          // 设置地图显示的城市 此项是必须设置的
        map.enableScrollWheelZoom(true); //开启鼠标滚轮缩放
        // console.log(opt.mapPoint);
        // return;
        var pt;
        if (opt.mapPoint.length > 0) {
            for (var i = 0; i < opt.mapPoint.length; i++) {
                pt = new BMap.Point(opt.mapPoint[i].long, opt.mapPoint[i].lat);
                var marker = new BMap.Marker(pt); //创建标注
                if (opt.mapPoint[i].infoWin) {
                    mixEcharts.addInfoWindow(marker, pt, opt.mapPoint[i].infoWin); //添加信息窗口
                }
                map.addOverlay(marker);
            }
        }
        if (!pt || !pt.lat || !pt.lng) {
            if (opt.centerPoint && opt.centerPoint.long && opt.centerPoint.lat) {
                map.centerAndZoom(new BMap.Point(opt.centerPoint.long, opt.centerPoint.lat), 10);
                return;
            }
            let geolocation = new BMap.Geolocation();
            geolocation.getCurrentPosition(function(r) {
                if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                    map.centerAndZoom(new BMap.Point(r.point.lng, r.point.lat), 10);
                } else {
                    map.centerAndZoom(new BMap.Point(113.933782, 22.582649), 10);
                }
            });
            return;
        }
        if (opt.centerPoint && opt.centerPoint.long && opt.centerPoint.lat) {
            map.centerAndZoom(new BMap.Point(opt.centerPoint.long, opt.centerPoint.lat), 10);
            return;
        }
        console.log(pt);
        map.centerAndZoom(pt, 10);
    },
    addInfoWindow: (marker, pt, info) => {
        var geo = new BMap.Geocoder();
        geo.getLocation(pt, (res) => {
            let addComp = res.addressComponents;
            let opts = { width: 285, height: 88 };
            let address = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;
            let infoWindow = new BMap.InfoWindow(`<div class="bdmap-equipment" >
        <div class="bdmap-base-info">
          <div><span>${i18n.t('common.dashboard_name')}</span><span>${info.title}</span></div>
          <div><span>${i18n.t('common.dashboard_description')}</span><span>${info.desc}</span></div>
          <div><span>${i18n.t('common.dashboard_address')}</span><span>${address}</span></div>
        </div>
      </div>`, opts); // 创建信息窗口对象
            // marker.openInfoWindow(infoWindow);
            marker.addEventListener("mouseover", function() {
                this.openInfoWindow(infoWindow);
            });
            marker.addEventListener("mouseout", function() {
                // this.closeInfoWindow(infoWindow);
            });
        });
    },
    echartsFullScreenBdMap: (equipmentId, title) => {
        if ($('#echartsBdmapFullscreenWindow').length) {
            $('#echartsBdmapFullscreenWindow').remove();
        }
        let winStyle = 'position:absolute;left:0;top:0;z-index:9999;width:100%;height:100%;background-color:#ffffff;-webkit-transition: all 0.4s;-moz-transition: all 0.4s;transition: all 0.4s;';
        let titleWrapStyle = 'position: relative;font-family: MicrosoftYaHei;font-size: 16px;font-weight: normal;font-stretch: normal;height: 54px;line-height: 54px;letter-spacing: 0px;';
        titleWrapStyle += 'padding:0 30px;color: #111111;border-bottom:1px solid #e5e5e5;align-items:center;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;'
        let iconStyle = 'width:20px;height:20px;background: url(\'modules/pro/static/image/icon/fullscreen_normal.png\') no-repeat center center;';
        let $fullScreenWin = $('<div id="echartsBdmapFullscreenWindow" class="flex-column" style="' + winStyle + '"></div>');
        let $titleWrap = $('<div id="echartsBdmapFullscreenWindowTitle" class="flex-wrap" style="' + titleWrapStyle + '"></div>');
        let $titleContent = $('<div class="title">' + title + '</div><div id="echartsBdmapFullscreenWindowTitleIconBtn" style="' + iconStyle + '"></div>');
        let $container = $('<div id="echartsBdmapFullscreenWindowContainer" style="flex:1;"></div>');
        $titleWrap.append($titleContent);
        $fullScreenWin.append($titleWrap, $container);
        $('body').append($fullScreenWin);
        $('#echartsBdmapFullscreenWindowTitleIconBtn').bind('mouseover', function() {
            $(this).css("background-image", "url(modules/pro/static/image/icon/fullscreen_press.png)");
        });
        $('#echartsBdmapFullscreenWindowTitleIconBtn').bind('mouseout', function() {
            $(this).css("background-image", "url(modules/pro/static/image/icon/fullscreen_normal.png)");
        });
        $('#echartsBdmapFullscreenWindowTitleIconBtn').bind('click', function() {
            if ($('#echartsBdmapFullscreenWindow').length) {
                $('#echartsBdmapFullscreenWindow').remove();
            }
        });
        mixEcharts.getMapPoint('echartsBdmapFullscreenWindowContainer', { 'equipmentId': equipmentId });
    },
    createWebsocket: (tvalue) => {
        console.log(tvalue);
        mixEcharts.jsonSocket = new WebSocket(config.socketAddress); //"ws://192.168.1.208:16379/.json"
        mixEcharts.jsonSocket.onopen = function() {
            console.log("JSON socket connected!");
            // mixEcharts.jsonSocket.send(JSON.stringify(["UNSUBSCRIBE", "/channel/pro/"+tvalue]));
            mixEcharts.jsonSocket.send(JSON.stringify(["SUBSCRIBE", "/channel/equipment/" + tvalue]));
            mixEcharts.socketConnectCount = 0;
        };

        mixEcharts.jsonSocket.onmessage = function(messageEvent) {
            //JSON received: {"SUBSCRIBE":["message","/data/xinlei/prj01/862631039219935","[820, 932, 901, 934,	1290, 1330,	1320]"]}
            var message = messageEvent.data;
            // console.log(message);

            // var	start_idx=message.indexOf("[");
            // var	line_data =	message.substring(start_idx, message.length-1);
            // message=JSON.parse(JSON.parse(line_data)[2]);
            console.log('Message:', message);
            var line_data = JSON.parse(message);
            if (typeof(line_data) != "number") {
                console.log('WebSocket:', line_data);
                mixEcharts.throttle(mixEcharts.updatePageData, null, 3000, line_data, 3000);
            }
        };

        mixEcharts.jsonSocket.onclose = function(event) {
            // console.log(event);
            console.log("JSON socket closed!");
            if (mixEcharts.socketConnectCount >= 10 || mixEcharts.isDestroyed) {
                return;
            }
            mixEcharts.socketConnectCount++;
            // console.log(mixEcharts.socketConnectCount);
            setTimeout(function() {
                // mixEcharts.createWebsocket(tvalue);
                if (mixEcharts.jsonSocket) {
                    mixEcharts.jsonSocket.onopen = function() {
                        console.log("JSON socket connected!");
                        mixEcharts.jsonSocket.send(JSON.stringify(["SUBSCRIBE", "/channel/equipment/" + tvalue]));
                        mixEcharts.socketConnectCount = 0;
                    };
                }
            }, 3000);
        }
    },
    dashBoardSubscribe: (tvalue) => {
        if (mixEcharts.jsonSocket.readyState != 1) {
            return;
        }
        mixEcharts.jsonSocket.send(JSON.stringify(["SUBSCRIBE", "/channel/equipment/" + tvalue]));
    },
    dashBoardUnSubscribe: (tvalue) => {
        if (mixEcharts.jsonSocket.readyState != 1) {
            return;
        }
        mixEcharts.jsonSocket.send(JSON.stringify(["UNSUBSCRIBE", "/channel/equipment/" + tvalue]));
    },
    getDateTime: () => {
        let date = new Date();
        let year = date.getFullYear();
        let month = date.getMonth() + 1;
        let day = date.getDate();
        let h = date.getHours();
        let m = date.getMinutes();
        let s = date.getSeconds();

        function formatStr(str) {
            str = str < 10 ? '0' + str : str;
            return str;
        }
        let dateTime = year + '-' + formatStr(month) + '-' + formatStr(day) + ' ' + formatStr(h) + ':' + formatStr(m) + ':' + formatStr(s);
        // let dateTime = formatStr(h)+':'+formatStr(m)+':'+formatStr(s);
        return dateTime;
    },
    getStatistic: (equipmentId) => {
        // equipmentId = '100005';
        fetch(config.apis.getStatistic, 'post', { 'equipment_id': equipmentId }, mixEcharts.token)
            .then((data) => {
                if (data.code == '200') {
                    // console.log(data);
                    let result = data.info;
                    if (result.length) {
                        for (var i = 0; i < result.length; i++) {
                            let line_data = {};
                            line_data[result[i].statistics_id] = result[i].data;
                            // console.log(line_data);
                            mixEcharts.updatePageData(line_data, true);
                        }
                    }
                }
            })
            .catch((error) => {
                console.log(error);
            })
    },
    updatePageData: (line_data, isStatistic) => {
        // console.log(line_data);
        if (!$('#dashBoardContent').children().length) {
            return;
        }
        let clearTxtIdObj = $.extend(true, {}, mixEcharts.cacheUpdateTextId);
        let clearEchartIdObj = $.extend(true, {}, mixEcharts.updateAttribute);
        // 缓存数据已经更新完毕的组件
        let cacheUpdatedChartId = [];
        for (var key in line_data) {
            // console.log(key);
            if (line_data.hasOwnProperty(key)) {
                // if (isNaN(line_data[key])) {
                //   continue;
                // }
                // console.log($('#'+key));
                // console.log(document.getElementById(key));
                if (mixEcharts.cacheUpdateTextId[key]) { //document.getElementById(key)
                    delete clearTxtIdObj[key];
                    let value = line_data[key];
                    let bgColor = '';
                    // console.log(mixEcharts.updateStatusText);
                    if (mixEcharts.updateStatusText[key] && mixEcharts.updateStatusText[key][value]) {
                        let statusObj = mixEcharts.updateStatusText[key];
                        for (var sk in statusObj) {
                            if (statusObj.hasOwnProperty(sk)) {
                                if (/\$val/.test(sk)) {
                                    if (eval(sk.replace(/\$val/g, value))) {
                                        if (statusObj['flagColor'] && statusObj['flagColor'][sk]) {
                                            bgColor = statusObj['flagColor'][sk];
                                        }
                                        value = statusObj[sk];
                                    }
                                } else {
                                    if (sk == value && statusObj[value]) {
                                        if (statusObj['flagColor'] && statusObj['flagColor'][value]) {
                                            bgColor = statusObj['flagColor'][value];
                                        }
                                        value = statusObj[value];
                                    }
                                }
                            }
                        }
                        // if (mixEcharts.updateStatusText[key]['flagColor']&&mixEcharts.updateStatusText[key]['flagColor'][value]) {
                        //   bgColor = mixEcharts.updateStatusText[key]['flagColor'][value];
                        // }
                        // value = mixEcharts.updateStatusText[key][value];
                    }
                    for (var j = 0; j < mixEcharts.cacheUpdateTextId[key].length; j++) {
                        if (document.getElementById(mixEcharts.cacheUpdateTextId[key][j] + '_' + key)) {
                            document.getElementById(mixEcharts.cacheUpdateTextId[key][j] + '_' + key).innerHTML = value;
                        }
                    }
                    // document.getElementById(key).innerHTML=value;
                    if (bgColor != '' && document.getElementById('statusBgColor_' + key)) {
                        document.getElementById('statusBgColor_' + key).style.backgroundColor = bgColor;
                    }
                    if (mixEcharts.updateMonitorImage[key]) {
                        let monitorDom = document.getElementById('monitorImage_' + key);
                        if (monitorDom && monitorDom.dataset.monitor && monitorDom.dataset.monitor != mixEcharts.updateMonitorImage[key][line_data[key]]) {
                            let background = /^https?:\/\/.+/.test(mixEcharts.updateMonitorImage[key][line_data[key]])? 
                            'url(' + mixEcharts.updateMonitorImage[key][line_data[key]] + ')' 
                            : 
                            'url(/modules/pro/static/image/monitor/' + mixEcharts.updateMonitorImage[key][line_data[key]] + ')';
                            monitorDom.style.backgroundImage = background;
                            // monitorDom.style.backgroundImage = 'url(/modules/pro/static/image/monitor/' + mixEcharts.updateMonitorImage[key][line_data[key]] + ')';
                            monitorDom.dataset.monitor = mixEcharts.updateMonitorImage[key][line_data[key]];
                        }
                    }
                }
                // $('#'+key).text(line_data[key]);
                // console.log(mixEcharts.updateAttribute[key]);
                if (line_data[key] == '-Inf' || line_data[key] == '+Inf' || line_data[key] == 'NaN') {
                    continue;
                }
                if (mixEcharts.monitorLiquid[key] !== undefined) {
                    let max = Number(mixEcharts.monitorLiquid[key].max)
                    let min = Number(mixEcharts.monitorLiquid[key].min)
                    let precent = Number(line_data[key]) / (max-min) * 100
                    let dom = document.querySelector('#monitorLiquid-' + key)
                    if (dom) {
                        dom.style.height = precent + '%'
                    }
                }
                if (mixEcharts.monitorStatus[key] !== undefined) {
                    let dom = document.querySelector('#monitorStatus-' + key)
                    if (dom) {
                        if (Number(mixEcharts.monitorStatus[key].on) === Number(line_data[key])) {
                            dom.classList.remove('off')
                            dom.classList.add('on')
                            // dom.style.backgroundImage = "url('"+ dom.dataset.on +"');"
                        } else if (Number(mixEcharts.monitorStatus[key].off) === Number(line_data[key])) {
                            dom.classList.remove('on')
                            dom.classList.add('off')
                            // dom.style.backgroundImage = "url('"+ dom.dataset.off +"');"
                        } else {
                            dom.classList.remove('on')
                            dom.classList.remove('off')
                        }
                    }
                }
                if (mixEcharts.updateAttribute[key]) {
                    delete clearEchartIdObj[key];
                    // console.log(mixEcharts.updateAttribute[key]);
                    for (var k = 0; k < mixEcharts.updateAttribute[key].length; k++) {
                        if (!document.getElementById(mixEcharts.updateAttribute[key][k])) {
                            continue;
                        }
                        let echartsInstance = echarts.getInstanceByDom(document.getElementById(mixEcharts.updateAttribute[key][k]));
                        // console.log(echartsInstance);
                        let option = echartsInstance.getOption();
                        // 不需要更新的跳过
                        if (!option.isupdate) {
                            continue;
                        }
                        // console.log(option);
                        // console.log(option.series.length);
                        // 仪表盘
                        if (option.series.length == 1 && option.series[0].type == 'gauge' && option.series[0].data[0] && option.series[0].data[0].from && option.series[0].data[0].from == key) {
                            option.series[0].data[0].value = line_data[key];
                            echartsInstance.setOption(option);
                            continue;
                        }
                        // 雷达图
                        if (option.radar && Array.isArray(option.radar) && option.radar.length && !cacheUpdatedChartId.includes(echartsInstance.id)) {
                            let indicator = option.radar[0].indicator || [];
                            let radar_data = [];
                            for (let i = 0; i < indicator.length; i++) {
                                const item = indicator[i];
                                let value = item.from && line_data[item.from] ? line_data[item.from] : 0;
                                radar_data.push(value)
                            }
                            if (option.series.length) {
                                option.series[0].data[0].value = radar_data;
                            }
                            echartsInstance.setOption(option);
                            cacheUpdatedChartId.push(echartsInstance.id);
                            continue;
                        }
                        let firstXaisData = true;
                        for (var i = 0; i < option.series.length; i++) {
                            if (option.series[i].from && option.series[i].from == key) {
                                // console.log(option.series[i].data);
                                if (option.series[i].data.length >= 50) { //option.xAxis[0].data.length
                                    option.series[i].data.shift();
                                    option.series[i].data.push(line_data[key]);
                                } else {
                                    option.series[i].data.push(line_data[key]);
                                }
                                let xdata = option.xAxis[0].data;
                                if (firstXaisData) {
                                    if (xdata.length >= 50) {
                                        option.xAxis[0].data.shift();
                                    }
                                    option.xAxis[0].data.push(mixEcharts.getDateTime());
                                    firstXaisData = false;
                                }
                            }
                        }
                        echartsInstance.setOption(option);
                    }
                }
            }
        }
        cacheUpdatedChartId = null;
        if (!isStatistic) {
            mixEcharts.clearPageData(clearTxtIdObj, clearEchartIdObj);
        }
    },
    getStatisticByPeriod: (echartsObj, equipmentId, statistics, from) => {
        let formatStr = (str) => {
            if (statistics['type'] == 'month') {
                str = str > 0 && str < 10 ? '0' + str : str;
            } else if (statistics['type'] == 'week') {
                str = new Date(str).getDay()
                str = str == 0 ? 7 : str;
            }
            return str;
        };
        // statistics['type'] = 'week';
        let data = {
            'equipment_id': equipmentId, //equipmentId,
            'statistics_id': Array.isArray(from) ? from[0] : from, //Array.isArray(from)?from[0]:from,
            'timeFlag': statistics['type'] ? statistics['type'] : 'month', //statistics['type']?statistics['type']:'month'
        };

        fetch(config.apis.getStatisticByPeriod, 'post', data, mixEcharts.token)
            .then((data) => {
                if (data.code == '200') {
                    // console.log(data);
                    let option = echartsObj.getOption();
                    let xAxis = [];
                    let info = data.result.data;
                    let currData = [];
                    let currDate = [];
                    let lastData = [];
                    let lastDate = [];
                    if (info) {
                        for (var key in info) {
                            if (info.hasOwnProperty(key)) {
                                let result = info[key]
                                for (var i = 0; i < result.length; i++) { //分类
                                    let tmpDate = null;
                                    if (statistics['type'] == 'month') {
                                        tmpDate = result[i].created.split('-');
                                    } else if (statistics['type'] == 'week') {
                                        let tmpStr = result[i].year + '-' + result[i].month + '-' + result[i].day;
                                        tmpDate = ['1', tmpStr];
                                    }
                                    xAxis.push(formatStr(tmpDate[1]));
                                    if (key.indexOf('current') != -1) {
                                        currData.push(result[i].data);
                                        currDate.push(formatStr(tmpDate[1]));
                                    } else if (key.indexOf('last') != -1) {
                                        lastData.push(result[i].data);
                                        lastDate.push(formatStr(tmpDate[1]));
                                    }
                                }
                            }
                        }

                        xAxis = [...new Set(xAxis)].sort();
                        if (statistics['type'] == 'month') {
                            xAxis = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
                        } else if (statistics['type'] == 'week') {
                            xAxis = [1, 2, 3, 4, 5, 6, 7];
                        }

                        for (var i = 0; i < xAxis.length; i++) { //补位
                            if (currDate.indexOf(xAxis[i]) == -1) {
                                currDate.push(xAxis[i]);
                                currDate.sort();
                                let cindex = currDate.indexOf(xAxis[i]);
                                currData.splice(cindex, 0, 0);
                            }
                            if (lastDate.indexOf(xAxis[i]) == -1) {
                                lastDate.push(xAxis[i]);
                                lastDate.sort();
                                let lindex = lastDate.indexOf(xAxis[i]);
                                lastData.splice(lindex, 0, 0);
                            }
                        }
                        if (statistics['type'] == 'month') {
                            option.xAxis[0].data = xAxis;
                        } else if (statistics['type'] == 'week') {
                            option.xAxis[0].data = xAxis.map(function(item) {
                                let week = ['星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期天'];
                                return week[item - 1];
                            });
                        }
                        if (option.series.length) {
                            option.series[0].data = lastData.map((item) => {
                                return Number(item)
                            });
                            if (option.series.length>1) {
                                option.series[1].data = currData.map((item) => {
                                    return Number(item)
                                });
                            }
                        }
                        echartsObj.setOption(option, true);
                        currData = null;
                        currDate = null;
                        lastData = null;
                        lastDate = null;
                    }
                }
            })
            .catch((error) => {
                console.log(error);
            })
    },
    initStatisticsData: (obj, equipmentId, statistics, from) => {
        let params = {};
        // equipmentId = '1001';
        params['equipment_id'] = equipmentId;
        params['statistics_id'] = from ? from : statistics.id;
        switch (statistics['type']) {
            case 'hour':
                params['timeFlag'] = 'hour';
                params['timeValue'] = statistics['total'] ? statistics['total'] : 24;
                break;
            case 'day':
                params['timeFlag'] = 'day';
                params['timeValue'] = statistics['total'] ? statistics['total'] : 30;
                break;
            case 'week':
                params['timeFlag'] = 'week';
                params['timeValue'] = statistics['total'] ? statistics['total'] : 12;
                break;
            case 'month':
                params['timeFlag'] = 'month';
                params['timeValue'] = statistics['total'] ? statistics['total'] : 12;
                break;
            case 'year':
                params['timeFlag'] = 'year';
                params['timeValue'] = statistics['total'] ? statistics['total'] : 3;
                break;
            default:
        }

        fetch(config.apis.statisticByTimeFlag, 'post', params, mixEcharts.token)
            .then((data) => {
                if (data.code == 200) {
                    let result = data.result.data;
                    if (Array.isArray(result) && !result.length || result == null || result == '') {
                        return;
                    }
                    if (from == null) {
                        for (var key in result) {
                            if (result.hasOwnProperty(key) && (key == obj.statistics['id'] || (Array.isArray(obj.statistics['id']) && obj.statistics['id'].indexOf(key) != -1))) {
                                if (document.getElementById(obj.attribute + '_statistics_' + key)) {
                                    document.getElementById(obj.attribute + '_statistics_' + key).innerHTML = isNaN(result[key][0].data) ? '--' : result[key][0].data;
                                }
                            }
                        }
                        return;
                    }
                    let option = obj.getOption();
                    if (Array.isArray(option.series) && option.series[0].type === 'pie') {
                        let series = option.series;
                        for (let i = 0; i < series.length; i++) {
                            const ele = series[i];
                            let data = ele.data;
                            for (let j = 0; j < data.length; j++) {
                                const item = data[j];
                                if (result[item['from']] !== undefined) {
                                    series[i].data[j]['value'] = result[item['from']];
                                }
                            }
                        }
                        obj.setOption(option, true);
                        return;
                    }
                    let fmt = (str) => {
                        let def = ':00:00';
                        return str > 9 ? str + def : '0' + str + def;
                    }
                    let fmtmd = (str) => {
                        return str > 9 ? str : '0' + str;
                    }
                    let xAxis = [];
                    let sortData = {};
                    for (var key in result) {
                        if (result.hasOwnProperty(key)) {
                            let item = result[key];
                            // let seriesData = [];
                            sortData[key] = [];
                            sortData[key]['data'] = [];
                            sortData[key]['time'] = [];
                            for (var i = 0; i < item.length; i++) {
                                let value = item[i].data.replace(/,/g, '');
                                if (isNaN(value)) { continue }
                                // seriesData.push(Number(value))
                                let time = '';
                                if (item[i].week) {
                                    time += item[i].year + ',' + item[i].week;
                                } else {
                                    time = item[i].year + '-' + fmtmd(item[i].month) + (item[i].day ? ('-' + fmtmd(item[i].day)) : '') + (item[i].hour || item[i].hour == 0 ? (' ' + fmt(item[i].hour)) : '');
                                }
                                sortData[key]['data'].push(Number(value));
                                sortData[key]['time'].push(time);
                                if (xAxis.indexOf(time) == -1) {
                                    xAxis.push(time);
                                }
                            }
                            // let series = option.series;
                            // for (var j = 0; j < option.series.length; j++) {
                            //   if (series[j].from.toLowerCase() == key.toLowerCase()) {
                            //     option.series[j].data = seriesData;
                            //   }
                            // }
                        }
                    }
                    xAxis.sort(function(a, b) { return Date.parse(a) - Date.parse(b) });
                    for (var k = 0; k < xAxis.length; k++) {
                        for (var s in sortData) {
                            if (sortData.hasOwnProperty(s)) {
                                if (sortData[s]['time'].indexOf(xAxis[k]) == -1) {
                                    sortData[s]['data'].splice(k, 0, '');
                                    sortData[s]['time'].splice(k, 0, xAxis[k]);
                                }
                            }
                        }
                    }
                    let series = option.series;
                    for (var j = 0; j < option.series.length; j++) {
                        if (sortData[series[j].from]) {
                            option.series[j].data = sortData[series[j].from]['data'];
                        }
                    }
                    if (option.series[0].data.length) {
                        option.xAxis[0].data = xAxis;
                    }
                    // console.log(option);
                    obj.setOption(option, true);
                }
            })
            .catch((error) => {
                console.log(error);
            })
    },
    getCumulativeData: (item, chart) => {
        fetch(config.apis.getAggregate, 'post', { 'statistics_id': item.cumulative['id'], 'equipment_id': item.equipmentId, 'timeFlag': item.cumulative['type'] })
            .then((data) => {
                if (data.code == 200) {
                    let result = data.result.data;
                    if (Array.isArray(result) && !result.length || result == null || result == '') {
                        return;
                    }
                    if (typeof chart == 'object' && item.type === 'pie') { //饼图
                        let option = chart.getOption();
                        let series = option.series;
                        for (let i = 0; i < series.length; i++) {
                            const ele = series[i];
                            let data = ele.data;
                            for (let j = 0; j < data.length; j++) {
                                const item = data[j];
                                if (result[item['from']] !== undefined) {
                                    series[i].data[j]['value'] = result[item['from']];
                                }
                            }
                        }
                        chart.setOption(option, true)
                        return;
                    }
                    for (var key in result) {
                        if (result.hasOwnProperty(key) && (key == item.cumulative['id'] || (Array.isArray(item.cumulative['id']) && item.cumulative['id'].indexOf(key) != -1))) {
                            if (document.getElementById(item.attribute + '_statistics_' + key)) {
                                document.getElementById(item.attribute + '_statistics_' + key).innerHTML = isNaN(result[key]) ? '--' : result[key];
                            }
                        }
                    }
                }
            })
            .catch((error) => {
                console.log(error);
            })
    },
    clearPageData: (clearTxtIdObj, clearEchartIdObj) => {
        // console.log(clearTxtIdObj);
        for (var tkey in clearTxtIdObj) {
            if (clearTxtIdObj.hasOwnProperty(tkey)) {
                for (var j = 0; j < clearTxtIdObj[tkey].length; j++) {
                    if (document.getElementById(clearTxtIdObj[tkey][j] + '_' + tkey)) {
                        document.getElementById(clearTxtIdObj[tkey][j] + '_' + tkey).innerHTML = '-';
                    }
                }
                if (mixEcharts.updateMonitorImage[tkey]) {
                    let monitorDom = document.getElementById('monitorImage_' + tkey);
                    if (monitorDom && monitorDom.dataset.monitor && monitorDom.dataset.monitor != mixEcharts.updateMonitorImage[tkey]['_defImg']) {
                        let background = /^https?:\/\/.+/.test(mixEcharts.updateMonitorImage[tkey]['_defImg']) ?
                        'url(' + mixEcharts.updateMonitorImage[tkey]['_defImg'] + ')'
                        :
                        'url(/modules/pro/static/image/monitor/' + mixEcharts.updateMonitorImage[tkey]['_defImg'] + ')';
                        monitorDom.style.backgroundImage = background;
                        // monitorDom.style.backgroundImage = 'url(/modules/pro/static/image/monitor/' + mixEcharts.updateMonitorImage[tkey]['_defImg'] + ')';
                        monitorDom.dataset.monitor = mixEcharts.updateMonitorImage[tkey]['_defImg'];
                    }
                }
            }
        }
        // console.log(clearEchartIdObj);
        for (var ekey in clearEchartIdObj) {
            if (clearEchartIdObj.hasOwnProperty(ekey)) {
                for (var k = 0; k < clearEchartIdObj[ekey].length; k++) {
                    if (!document.getElementById(clearEchartIdObj[ekey][k])) {
                        continue;
                    }
                    let echartsInstance = echarts.getInstanceByDom(document.getElementById(clearEchartIdObj[ekey][k]));
                    // console.log(echartsInstance);
                    let option = echartsInstance.getOption();
                    if (option.series.length == 1 && option.series[0].type == 'gauge' && option.series[0].data[0] && option.series[0].data[0].from && option.series[0].data[0].from == ekey) {
                        option.series[0].data[0].value = '-';
                        echartsInstance.setOption(option);
                        continue;
                    }
                    // 雷达图
                    if (option.radar && Array.isArray(option.radar) && option.radar.length) {
                        if (option.series.length) {
                            option.series[0].data[0].value = [];
                        }
                        echartsInstance.setOption(option);
                        continue;
                    }
                    for (var i = 0; i < option.series.length; i++) {
                        if (option.series[i].from && option.series[i].from == ekey) {
                            // console.log(option.series[i].data);
                            option.series[i].data = [];
                            if (i == 0) {
                                option.xAxis[0].data = [];
                            }
                        }
                    }
                    echartsInstance.setOption(option);
                }
            }
        }
    },
    getEquipmentStatus: (item) => {
        fetch(config.apiq.normal_info, 'post', { 'equipment_id': item.equipmentId })
            .then((data) => {
                if (data.code == 200) {
                    let result = data.result;
                    let dom = document.getElementById(item.attribute + '_' + item['equipmentStatus']['id']);
                    if (dom) {
                        dom.innerHTML = item['equipmentStatus']['status'][result['is_online']] ? item['equipmentStatus']['status'][result['is_online']] : '-';
                    }
                    mixEcharts.getEquipmentStatusTimer = setTimeout(() => {
                        mixEcharts.getEquipmentStatus(item);
                    }, 5 * 1000);
                }
            })
            .catch((error) => {
                console.log(error);
            })
    },
    throttle: (fn, context, delay, text, mustApplyTime) => {
        clearTimeout(fn.timer);
        fn._cur = Date.now(); //记录当前时间

        if (!fn._start) { //若该函数是第一次调用，则直接设置_start,即开始时间，为_cur，即此刻的时间,第一次先执行一次函数
            fn.call(context, text);
            fn._start = fn._cur;
        }
        if (fn._cur - fn._start > mustApplyTime) {
            //当前时间与上一次函数被执行的时间作差，与mustApplyTime比较，若大于，则必须执行一次函数，若小于，则重新设置计时器
            fn.call(context, text);
            fn._start = fn._cur;
        } else {
            fn.timer = setTimeout(function() {
                fn.call(context, text);
            }, delay);
        }
    },
    initVideo: ($dom, item) => {
        if ($dom.length) {
            let videoId = item.attribute + '_' + parseInt(Math.random() * Date.now());
            let $video = $(`<video id="${videoId}" poster="" controls playsInline webkit-playsinline autoplay>
        <source src="${item.videoSrc['rtmp']}" type="" />
        <source src="${item.videoSrc['http']}" type="application/x-mpegURL" />
      </video>`);
            $dom.append($video);
            let player = null;
            let count = 0;
            if ($('#videoScript_' + item.platform).length) {
                switch (item.platform) {
                    case 'ys7':
                        mixInitEZUIPlayer();
                        break;
                    default:
                }
            }

            function mixInitEZUIPlayer() {
                try {
                    player = new EZUIPlayer(videoId);
                } catch (e) {
                    console.log(e);
                    if (count < 10) {
                        setTimeout(mixInitEZUIPlayer, 1000);
                    }
                    count++;
                }
                if (player) {
                    mixEcharts.videoCache.push(player);
                }
            };
        }
    },
    cacheItemId: (item) => {
        let itemData = item.itemData;
        if (!Array.isArray(itemData)) {
            let tmpArr = [];
            itemData = itemData ? tmpArr.push(itemData) : tmpArr;
            tmpArr = null;
        }
        for (var i = 0; i < itemData.length; i++) {
            let element = itemData[i]
            if (item.type == 'monitor' && element.type != undefined) {
                if (element.type == 'liquid') {
                    mixEcharts.monitorLiquid[element.id] = {}
                    mixEcharts.monitorLiquid[element.id]['max'] = element.max || 100
                    mixEcharts.monitorLiquid[element.id]['min'] = element.min || 0
                    continue
                }
                if (element.type == 'status' || element.type == 'light') {
                    mixEcharts.monitorStatus[element.id] = {}
                    mixEcharts.monitorStatus[element.id].on = element.on
                    mixEcharts.monitorStatus[element.id].off = element.off
                    continue
                }
            }
            if (element.flag && !mixEcharts.updateStatusText[element.id]) {
                mixEcharts.updateStatusText[element.id] = element.flag;
            }
            if (element.cache !== false) {
                if (Array.isArray(element.id)) {
                    for (var j = 0; j < element.id.length; j++) {
                        if (mixEcharts.cacheUpdateTextId[element.id[j]]) {
                            mixEcharts.cacheUpdateTextId[element.id[j]].push(item.attribute);
                        } else {
                            mixEcharts.cacheUpdateTextId[element.id[j]] = [];
                            mixEcharts.cacheUpdateTextId[element.id[j]].push(item.attribute);
                        }
                    }
                } else {
                    if (mixEcharts.cacheUpdateTextId[element.id]) {
                        mixEcharts.cacheUpdateTextId[element.id].push(item.attribute);
                    } else {
                        mixEcharts.cacheUpdateTextId[element.id] = [];
                        mixEcharts.cacheUpdateTextId[element.id].push(item.attribute);
                    }
                }
            }
        }
        let statusData = item.statusData;
        if (!Array.isArray(statusData)) {
            let tmpArr = [];
            statusData = statusData ? tmpArr.push(statusData) : tmpArr;
            tmpArr = null;
        }
        for (var i = 0; i < statusData.length; i++) {
            if (statusData[i].flag) {
                mixEcharts.updateStatusText[statusData[i].id] = statusData[i].flag;
                if (statusData[i].flagColor) {
                    mixEcharts.updateStatusText[statusData[i].id]['flagColor'] = statusData[i].flagColor;
                }
            }
            if (statusData[i].cache !== false) {
                if (mixEcharts.cacheUpdateTextId[statusData[i].id]) {
                    mixEcharts.cacheUpdateTextId[statusData[i].id].push(item.attribute);
                } else {
                    mixEcharts.cacheUpdateTextId[statusData[i].id] = [];
                    mixEcharts.cacheUpdateTextId[statusData[i].id].push(item.attribute);
                }
            }
        }
        if (item.monitorImages) {
            mixEcharts.updateMonitorImage[item.monitorImages['id']] = item.monitorImages['flagImage'];
            mixEcharts.updateMonitorImage[item.monitorImages['id']]['_defImg'] = item.monitorImages['defImg'];
        }
    }
}
export default mixEcharts