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
import mixControlOptions from '@/assets/js/control/option.js'
import config from '$config';

var mixControlCharts = {
    grid: null,
    jsonSocket: null,
    socketConnectCount: 0,
    cacheUpdateTextId: {},
    commandListMap: {},
    currentControlItem: '',
    isDestroyed: false,
    drawDashBoard: (equipmentId, data, ele) => {
        if (typeof data != 'object') {
            return;
        }
        $(ele).html('');

        var tmpdata = null;
        mixControlCharts.cacheUpdateTextId = {};
        mixControlCharts.commandListMap = {};
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                tmpdata = data[key];
                if (!tmpdata || tmpdata.length == 0) {
                    continue
                }
                mixControlCharts.createBlock(ele, key, tmpdata)
                for (var i = 0; i < tmpdata.data.length; i++) {
                    tmpdata.data[i].key = key;
                    tmpdata.data[i].equipmentId = equipmentId;
                    try {
                        mixControlCharts.createCharts(tmpdata.data[i]);
                    } catch (e) {
                        console.log(e);
                    }
                }
                $('#table__' + key).find('td:hidden').remove();
            }
        }
        if (mixControlCharts.jsonSocket == null) {
            mixControlCharts.createWebsocket(equipmentId);
        } else {
            mixControlCharts.dashBoardSubscribe(equipmentId)
        }
    },
    createBlock: (ele, key, data) => {
        let table = mixControlCharts.createGrid(ele, key, data.row, data.col)
        let str = `
    <div class="mix-control__block">
      <div class="mix-control__block-header">
        <div class="mix-control__block-header_title">${data.name}</div>
      </div>
      <div class="mix-control__block-body">${table.join('')}</div>
    </div>
    `
        $(ele).append($(str))
    },
    createGrid: (ele, key, row, col) => {
        if ($('#table__' + key).length) {
            return []
        }
        var clientWidth = $(ele).width();
        row = row ? row : 4;
        col = col ? col : 8;
        var w = Math.round(clientWidth / col); //行
        var h = (w - 8 * 2) //列
        var tmpArr = [];
        tmpArr.push('<table id="table__' + key + '" class="mix-control__table">');
        tmpArr.push('<colgroup>')
        for (var k = 0; k < col; k++) {
            tmpArr.push('<col width="*" />')
        }
        tmpArr.push('</colgroup>')
        for (var i = 0; i < row; i++) {
            tmpArr.push('<tr class="mix-control__table-row">');
            for (var j = 0; j < col; j++) {
                tmpArr.push('<td class="mix-control__table-grid" style="height:' + h + 'px;"></td>');
            }
            tmpArr.push('</tr>');
        }
        tmpArr.push('</table>');
        mixControlCharts.grid = {
            w: w,
            h: w
        }
        return tmpArr
    },
    createCharts: (item) => {
        var grid = mixControlCharts.grid;
        var posinfo = item.xys; //坐标、占用大小
        var option = mixControlCharts.dealOptions(item); //获取配置项
        var table = $('#table__' + item.key);
        // console.log(table);
        var tr = table.find('tr.mix-control__table-row');

        var $boxWrap = $('<div class="mix-control__box-wrap flex-wrap"></div>');
        var $box = $('<div id="echarts_box_' + item.attribute + '" class="mix-control__box-container" ></div>');
        $boxWrap.html($box)
        var height = grid.h * posinfo.len[0];
        // $box.width(width-4);$box.height(height-4);//设置echarts图表宽高

        var targetTr = tr[posinfo.pos[0]];
        // console.log(targetTr);
        var td = targetTr.children;
        var targetTd = td[posinfo.pos[1]];

        $(targetTd).attr({
            'colspan': posinfo.len[1],
            'rowspan': posinfo.len[0]
        });
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
            height: (grid.h - 16) * posinfo.len[0]
        }).html($boxWrap);
        $boxWrap.height(height - 16); //设置图表高度

    if (typeof option != 'object' && typeof option == 'string') {
      $box.html(option);
      // 查找存储flag对象
      if (item.itemData && Array.isArray(item.itemData)) {
        let itemData = item.itemData
        for (var i = 0; i < itemData.length; i++) {
          if (mixControlCharts.cacheUpdateTextId[itemData[i].id]) {
            mixControlCharts.cacheUpdateTextId[itemData[i].id].push(item.attribute);
          } else {
            mixControlCharts.cacheUpdateTextId[itemData[i].id] = [];
            mixControlCharts.cacheUpdateTextId[itemData[i].id].push(item.attribute);
          }
          mixControlCharts.commandListMap[item.attribute + '__' + itemData[i].id] = itemData[i].command
        }
      }
      if (item.valueItem !== undefined) {
        mixControlCharts.cacheUpdateTextId[item.valueItem.id] = []
        mixControlCharts.cacheUpdateTextId[item.valueItem.id].push(item.attribute)
      }
      return false;
    } //文本类的 end
 
  },
  dealOptions: (opt) => {
    var option = null;
    var type = opt.type;
    switch (type) {
      case 'SwitchControl':
        option = mixControlOptions.switchControl(opt);
        break;
      case 'SwitchControlBtn':
        option = mixControlOptions.switchControlBtn(opt);
        break;
      case 'BtnGroupControl':
        option = mixControlOptions.btnGroupControl(opt);
        break;
      case 'GaugeSetControl':
        option = mixControlOptions.gaugeSetControl(opt);
        break;
      case 'SetControl':
        option = mixControlOptions.setControl(opt);
        break;
      default:

        }
        return option;
    },
    createWebsocket: (tvalue) => {
        console.log(tvalue);
        mixControlCharts.jsonSocket = new WebSocket(config.socketAddress); //"ws://192.168.1.208:16379/.json"
        mixControlCharts.jsonSocket.onopen = function() {
            console.log("JSON socket connected!");
            // mixControlCharts.jsonSocket.send(JSON.stringify(["UNSUBSCRIBE", "/channel/pro/"+tvalue]));
            mixControlCharts.jsonSocket.send(JSON.stringify(["SUBSCRIBE", "/channel/equipment/" + tvalue]));
            mixControlCharts.socketConnectCount = 0;
        };

        mixControlCharts.jsonSocket.onmessage = function(messageEvent) {
            //JSON received: {"SUBSCRIBE":["message","/data/xinlei/prj01/862631039219935","[820, 932, 901, 934,	1290, 1330,	1320]"]}
            var message = messageEvent.data;
            // console.log('Message:', message);
            var line_data = JSON.parse(message);
            if (typeof(line_data) != "number") {
                console.log('WebSocket:', line_data);
                mixControlCharts.throttle(mixControlCharts.updatePageData, null, 3000, line_data, 3000);
            }
        };

    mixControlCharts.jsonSocket.onclose = function(event) {
      // console.log(event);
      console.log("JSON socket closed!");
      if (mixControlCharts.socketConnectCount >= 10 || mixControlCharts.isDestroyed) {
        return;
      }
      mixControlCharts.socketConnectCount++;
      setTimeout(function() {
          if (mixControlCharts.jsonSocket) {
              mixControlCharts.jsonSocket.onopen = function() {
                console.log("JSON socket connected!");
                mixControlCharts.jsonSocket.send(JSON.stringify(["SUBSCRIBE", "/channel/equipment/" + tvalue]));
                mixControlCharts.socketConnectCount = 0;
              };
          }
      }, 3000);
    }
  },
	dashBoardSubscribe: (tvalue) => {
			if (mixControlCharts.jsonSocket.readyState != 1) {
					return;
			}
			mixControlCharts.jsonSocket.send(JSON.stringify(["SUBSCRIBE", "/channel/equipment/" + tvalue]));
	},
	dashBoardUnSubscribe: (tvalue) => {
			if (mixControlCharts.jsonSocket.readyState != 1) {
					return;
			}
			mixControlCharts.jsonSocket.send(JSON.stringify(["UNSUBSCRIBE", "/channel/equipment/" + tvalue]));
	},
	updatePageData: (line_data) => {
			// console.log(line_data);
			if (!$('#controlDashboardContainer').children().length) {
					return;
			}
			let clearTxtIdObj = $.extend(true, {}, mixControlCharts.cacheUpdateTextId);
			for (var key in line_data) {
					if (line_data.hasOwnProperty(key)) {
							if (mixControlCharts.cacheUpdateTextId[key]) { //document.getElementById(key)
									delete clearTxtIdObj[key];
									let value = line_data[key];
									for (var j = 0; j < mixControlCharts.cacheUpdateTextId[key].length; j++) {
											let txtDom = document.getElementById(mixControlCharts.cacheUpdateTextId[key][j] + '__value')
											if (txtDom) {
												txtDom.innerHTML = value;
												txtDom = null;
												continue
											}
											let inputDom = document.getElementById(mixControlCharts.cacheUpdateTextId[key][j] + '__input')
											if (inputDom && inputDom.dataset.isEdit === '0') {
												inputDom.value = value;
												inputDom = null
												continue
											}
											if (mixControlCharts.currentControlItem !== key && document.getElementById(mixControlCharts.cacheUpdateTextId[key][j] + '__' + key)) {
												let checkbox = document.getElementById(mixControlCharts.cacheUpdateTextId[key][j] + '__' + key)
												let statusCode = checkbox.dataset.statusCode
												if (typeof(statusCode) == "string") {
													statusCode = statusCode.split(",").map(Number);
												}
												//statusCode = JSON.parse(statusCode)
												if (statusCode.indexOf(line_data[key]) > 0) {
													checkbox.checked = true
												} else {
													checkbox.checked = false
												}
											}
									}
							}
					}
			}
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
  getItemCommand: (key, type) => {
    if (!mixControlCharts.commandListMap[key]) {
      return ''
    }
    let command = mixControlCharts.commandListMap[key]
    let result = ''
    switch (type) {
      case 'switch':
        let checked = document.getElementById(key).checked
        if (checked && command['1'] !== undefined) {
          result = JSON.parse(JSON.stringify(command['1']))
          result.command = JSON.stringify(result.command)
        } else if (command['0'] !== undefined){
          result = JSON.parse(JSON.stringify(command['0']))
          result.command = JSON.stringify(result.command)
        }
        break;
      case 'input':
        let index = key.lastIndexOf('__')
				let attribute = key.substring(0, index)
				let inputDom = document.getElementById(attribute + '__input')
        let value = inputDom.dataset.value != ''? inputDom.dataset.value : inputDom.value;
        value = value ? Number(value) : 0
        result = JSON.parse(JSON.stringify(command))
        result.command = JSON.stringify(result.command).replace(/\$val/g, value)
        break;
      default:
        result = JSON.parse(JSON.stringify(command))
        result.command = JSON.stringify(result.command)
        break
    }
    return result
  }
}

export default mixControlCharts
