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
const apixHost = apiqHost;
const apisHost = apiqHost;
const apirHost = apiqHost;
const apiwHost = apiqHost;
const apiq = {
    aprus: protocol + apiqHost + '/pro/aprus',
    customer: protocol + apiqHost + '/pro/customer',
    device: protocol + apiqHost + '/pro/equipment',
    service: protocol + apiqHost + '/pro/service',
    event: protocol + apiqHost + '/pro/event',
    alarm: protocol + apiqHost + '/pro/alert',
    fault: protocol + apiqHost + '/pro/fault',
    message: protocol + apiqHost + '/pro/message',
    user: protocol + apiqHost + '/pro/user',
    userCustomer: protocol + apiqHost + '/pro/customer',
    work: protocol + apiqHost + '/pro/work',
    user_equipment: protocol + apiqHost + '/pro/equipment',
    collect: protocol + apiqHost + '/pro/collect',
    collectos: protocol + apiqHost + '/pro/collect',
    fault_mosaic: protocol + apiqHost + '/pro/fault',
    alarm_mosaic: protocol + apiqHost + '/pro/alert',
    login: protocol + apiqHost + '/pro/index/login',
    upload: protocol + apiqHost + '/pro/file/public_upload',
    download: protocol + apiqHost + '/pro/file/public_download',
    dashboardConfig: protocol + apiqHost + '/pro/equipment/public_get_dashboard_config',
    getMapping: protocol + apiqHost + '/pro/equipment/public_get_mapping',
    alertPoint: protocol + apiqHost + '/pro/equipment/public_get_alert_point',
    history: protocol + apiqHost + '/pro/equipment/public_get_equip_process_history',
    historyItem: protocol + apiqHost + '/pro/equipment/public_get_equip_process_history_item',
    statistics: protocol + apiqHost + '/pro/index/public_get_statistics',
    statisticsPlus: protocol + apiqHost + '/pro/index/public_get_statistics_plus',
    statisticsQuestion: protocol + apiqHost + '/pro/index/public_get_efa_statistics',
    distributionInMap: protocol + apiqHost + '/pro/index/public_get_equip_map_distribution',
    singleInMap: protocol + apiqHost + '/pro/equipment/public_get_location',
    distribution: protocol + apiqHost + '/pro/index/public_get_equip_area_distribution',
    count: protocol + apiqHost + '/pro/index/public_get_service_statistics',
    pictureAddress: protocol + host_online + '/storage/uploads/',
    downloadAddress: protocol + apiqHost + '/pro/file/public_download',
    common: protocol + apiqHost + '/pro/index',
    equipment_group: protocol + apiqHost + '/pro/equipment_group',
    setting: protocol + apiqHost + '/pro/index',
    cost: protocol + apiqHost + '/pro/cost',
    earning: protocol + apiqHost + '/pro/earning',
    set_config: protocol + apiqHost + '/pro/setting/public_set_config',
    get_config: protocol + apiqHost + '/pro/setting/public_get_config',
    upload_logo: protocol + apiqHost + '/pro/setting/public_upload_logo',
    get_qrcode: protocol + apiqHost + '/pro/setting/create_qrcode',
    equipment_list_export: protocol + apiqHost + '/pro/equipment/public_export',
    group_list_export: protocol + apiqHost + '/pro/equipment_group/public_export',
    get_latest_line_data: protocol + apiqHost + '/pro/equipment/public_get_latest_line_data',
    normal_list: protocol + apiqHost + '/pro/equipment/public_get_normal_list',
    normal_info: protocol + apiqHost + '/pro/equipment/public_get_normal_info',
    log: protocol + apiqHost + '/pro/log',
    get_scheme: protocol + apiqHost + '/pro/equipment/get_scheme',
    add_scheme: protocol + apiqHost + '/pro/equipment/add_scheme',
    edit_scheme: protocol + apiqHost + '/pro/equipment/edit_scheme',
    delete_scheme: protocol + apiqHost + '/pro/equipment/delete_scheme',
    get_dashboard: protocol + apiqHost + '/pro/equipment/get_dashboard',
    get_state_list: protocol + apiqHost + '/pro/equipment/get_state_list',
    export_state_data: protocol + apiqHost + '/pro/equipment/export_state_data',
    get_state_status: protocol + apiqHost + '/pro/equipment/get_state_status',
    download_state_file: protocol + apiqHost + '/pro/equipment/download_state_file',
    delete_state_file: protocol + apiqHost + '/pro/equipment/delete_state_file',
};

const apix = {
    dataLine: protocol + apixHost + '/pro/equipment/public_get_line_data',
    mosaicImport: protocol + apixHost + '/pro/equipment/public_export_mosaic_data',
    mosaicByKey: protocol + apixHost + '/pro/equipment/public_get_mosaic_by_key',
    downloadFile: protocol + apixHost + '/pro/file/public_apix_download',
    latestGridsByDuration: protocol + apixHost + '/pro/equipment/public_get_latest_grids_by_duration',
    lastMosaic: protocol + apixHost + '/pro/equipment/public_get_last_mosaic',
};

const apip = {
    push: protocol + apiqHost + '/pro/index/public_push',
};

const apis = {
    getStatistic: protocol + apisHost + '/pro/equipment/public_get_statistics',
    getStatisticByPeriod: protocol + apisHost + '/pro/equipment/public_get_statistics_by_period',
    statisticByTimeFlag: protocol + apisHost + '/pro/equipment/public_get_statistics_by_timeflag',
    toDayStatistics: protocol + apisHost + '/pro/equipment/public_get_today_statistic',
    currentMonthStatistics: protocol + apisHost + '/pro/equipment/public_get_current_month_statistics',
    todayData: protocol + apisHost + '/pro/equipment/public_get_today_data',
    currentMonthData: protocol + apisHost + '/pro/equipment/public_get_current_month_data',
    currentYearData: protocol + apisHost + '/pro/equipment/public_get_current_year_data',
    history: protocol + apisHost + '/pro/equipment/public_get_history_data',
    getAggregate: protocol + apisHost + '/pro/equipment/public_get_current_aggregate_by_timeflag',
};

const apir = {
    getReportList: protocol + apirHost + '/pro/report/public_get_outlist',
    getReportListByUser: protocol + apirHost + '/pro/report/public_get_user_outlist',
    getReportDetail: protocol + apirHost + '/pro/report/public_get_outdata',
    download: protocol + apirHost + '/pro/report/public_download_report_file',
    delete: protocol + apirHost + '/pro/report/delete_report',
}
const apiw = {
    getTaskList: protocol + apiwHost + '/pro/task/public_get_tasklist',
    getTaskDetail: protocol + apiwHost + '/pro/task/public_get_taskdetail',
}
const weibao = {
    list: protocol + apiwHost + '/pro/task/get_maintenance',
    detail: {
        detail: protocol + apiwHost + '/pro/task/get_maintenance_detail',
        list: protocol + apiwHost + '/pro/task/get_maintenance_record',
        getName: protocol + apiwHost + '/pro/task/get_default_equipment',
        download: protocol + apiwHost + '/pro/task/down_file',
        getCliName: protocol + apiwHost + '/pro/task/get_default_customer',
        add: protocol + apiwHost + '/pro/task/change_record',
        edit: protocol + apiwHost + '/pro/task/change_period',
    }
}
const diag = {
    task: {
        list: '/api/diag/task/list',
        getInfoById: '/api/diag/task/get',
        createResultByHand: '/api/diag/task/diag',
    },

    result: {
        list: '/api/diag/result/list',
        delete: '/api/diag/result/delete',
        getInfoById: '/api/diag/result/get',
    },
}
module.exports = {
    protocol: protocol,
    apiqHost: apiqHost,
    apiq: apiq,
    system: system,
    apix: apix,
    apip: apip,
    apis: apis,
    apir: apir,
    apiw: apiw,
    socketAddress: socketAddress,
    pro_version: pro_version,
    mixPortal_url: mixPortal_url,
    diag: diag,
    weibao: weibao,
};