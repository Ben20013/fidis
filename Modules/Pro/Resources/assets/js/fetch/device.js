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

export default {
    //获取设备列表
    get_list(cb, data, token) {
        fetch(config.apiq.device + '/public_get_list', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    //获取设备列表(设备单独页面使用)
    get_all_list(cb, data, token) {
        fetch(config.apiq.device + '/public_get_all_list', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取菜单列表
    get_menu_list(cb, data, token) {
        fetch(config.apiq.device + '/public_get_menu_list', 'post', data, token).then(function(data) {
            cb(data);
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取设备详细信息
    get_detail(cb, data, token) {
        fetch(config.apiq.device + '/public_get_info', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 编辑设备信息
    edit_equipment_info(cb, data, token) {
        fetch(config.apiq.device + '/public_edit', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取codebase配置
    get_control_conf(cb, data, token) {
        fetch(config.apiq.device + '/public_get_codebase_template', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 发送codebase命令
    push_control_command(cb, data, token) {
        fetch(config.apip.push, 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 添加设备关注
    add_attention(cb, data, token) {
        fetch(config.apiq.user_equipment + '?a=public_add', 'post', data, token).then(function(data) {
            cb(data);
        }).catch((e) => {
            cb(e)
        })
    },
    //取消设备关注
    delete_attention(cb, data, token) {
        fetch(config.apiq.user_equipment + '/public_multi_delete', 'post', data, token).then(function(data) {
            cb(data);
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取生成设备状态图表配置
    get_equipment_status_conf(cb, data, token) {
        fetch(config.apiq.dashboardConfig, 'post', data).then(function(data, token) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取设备历史表头
    get_table_header_list(cb, data, token) {
        fetch(config.apiq.getMapping, 'post', data).then(function(data, token) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 根据表头获取历史记录数据
    get_record_list_data(cb, data, token) {
        fetch(config.apix.mosaicByKey, 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 根据表头导出历史记录数据
    import_record_list_data(cb, data, token) {
        fetch(config.apix.mosaicImport, 'post', data, token).then(function(data) {
            cb(data)
            if (data.code == 200) {
                let fileInfo = data.result;
                let url = config.apix.downloadFile + '?path=' + fileInfo.path + '&fileName=' + fileInfo.fileName;
                let iframe = document.createElement('iframe');
                iframe.style.display = 'none';
                iframe.src = url;
                iframe.onload = function() {
                    document.body.removeChild(iframe);
                }
                document.body.appendChild(iframe);
            }
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取历史记录曲线数据
    get_record_line_data(cb, data, token) {
        fetch(config.apix.dataLine, 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取历史记录数据曲线告警点
    get_record_alarm_point(cb, data, token) {
        fetch(config.apiq.alertPoint, 'get', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取设备历程列表
    get_equipment_history_list(cb, data, token) {
        fetch(config.apiq.history, 'get', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取设备历程详细信息
    get_equipment_history_info(cb, data, token) {
        fetch(config.apiq.historyItem, 'get', data).then(function(data) {
            cb(data)
        })
    },
    // 获取设备报警&故障挂板列表
    get_mosaic_warn_list(cb, data, token) {
        fetch(config.apiq.device + '/public_get_mosaic_warn', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取设备报警-故障挂板列表
    get_falut_mosaic_list(cb, data, token) {
        fetch(config.apiq.fault_mosaic + '/public_get_list_by_equipment_id', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取设备报警-故障挂板故障详细信息
    get_falut_mosaic_detial_info(cb, data, token) {
        fetch(config.apiq.fault_mosaic + '/public_get_info', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取设备报警-报警挂板列表
    get_alarm_mosaic_list(cb, data, token) {
        fetch(config.apiq.alarm_mosaic + '/public_get_list_by_equipment_id', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    // 获取设备报警-报警挂板报警详细信息
    get_alarm_mosaic_detial_info(cb, data, token) {
        fetch(config.apiq.alarm_mosaic + '/public_get_info', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    //上传
    upload(cb, data, token) {
        fetch(config.apiq.upload, 'upload', data, token).then(function(data) {
            cb(data)
        }).catch((e) => {
            cb(e)
        })
    },
    //下载
    download(path) {
        let url = config.apiq.download + '?path=' + path;
        let iframe = document.createElement('iframe')
        iframe.style.display = 'none'
        iframe.src = url
        iframe.onload = function() {
            document.body.removeChild(iframe)
        }
        document.body.appendChild(iframe);
    },
    // 导出设备列表
    export_list(cb, data) {
        fetch(config.apiq.equipment_list_export, 'get', data).then((data) => {
            cb(data)
        })
    },
    // 反向控制鉴权
    check_control_auth(cb, data) {
        fetch(config.apiq.device + '/public_check_control_auth', 'post', data).then((data) => {
            cb(data)
        })
    },
    // 更改控制码
    reset_control_auth(cb, data) {
        fetch(config.apiq.device + '/public_reset_control_auth', 'post', data).then((data) => {
            cb(data)
        })
    },
    // log列表
    log_get_list(cb, data) {
        fetch(config.apiq.log + '/public_get_list', 'post', data).then((data) => {
            cb(data)
        })
    },
    // log信息
    log_get_info(cb, data) {
        fetch(config.apiq.log + '/public_get_info', 'post', data).then((data) => {
            cb(data)
        })
    },
    // log添加
    log_add(cb, data) {
        fetch(config.apiq.log + '/public_add', 'post', data).then((data) => {
            cb(data)
        })
    },
    // 获取方案列表
    get_scheme(cb, data) {
        fetch(config.apiq.get_scheme, 'post', data).then((data) => {
            cb(data)
        })
    },
    // 添加方案
    add_scheme(cb, data) {
        fetch(config.apiq.add_scheme, 'post', data).then((data) => {
            cb(data)
        })
    },
    // 编辑方案
    edit_scheme(cb, data) {
        fetch(config.apiq.edit_scheme, 'post', data).then((data) => {
            cb(data)
        })
    },
    // 删除方案
    delete_scheme(cb, data) {
        fetch(config.apiq.delete_scheme, 'post', data).then((data) => {
            cb(data)
        })
    },
    // 获取显示板配置
    get_dashboard(cb, data) {
        fetch(config.apiq.get_dashboard, 'post', data).then((data) => {
            cb(data)
        })
    },
    // 获取设备导出文件列表
    get_state_list(cb, data) {
        fetch(config.apiq.get_state_list, 'post', data).then((data) => {
            cb(data)
        })
    },
    // 导出设备数据
    export_state_data(cb, data) {
        fetch(config.apiq.export_state_data, 'post', data).then((data) => {
            cb(data)
        })
    },
    // 查询导出文件状态
    get_state_status(cb, data) {
        fetch(config.apiq.get_state_status, 'post', data).then((data) => {
            cb(data)
        })
    },
    // 下载导出文件
    download_state_file(data) {
        // let form = document.createElement("form")
        // form.setAttribute('method', 'post')
        // form.setAttribute('enctype', 'application/x-gzip')
        // let url = config.apiq.download_state_file + "?state_id=" + data.task_id
        // form.setAttribute("action", url)
        // form.style.display = "none"
        // document.body.appendChild(form);
        // form.submit()
        // document.body.removeChild(form);

        var elink = document.createElement("a");
        elink.download = '';
        elink.style.display = "none";
        elink.href = config.apiq.download_state_file + "?state_id=" +data.task_id;
        document.body.appendChild(elink);
        elink.click();
        document.body.removeChild(elink);
    },
    // 删除导出文件
    delete_state_file(cb, data) {
        fetch(config.apiq.delete_state_file, 'post', data).then((data) => {
            cb(data)
        })
    },
}
