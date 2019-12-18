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
import {fetch} from '$api.js';

export default {
    // 查询设备数量
    get_total(cb, data) {
        fetch(config.apiq.statistics, 'post', data).then((data) => { cb(data) })
    },
    // 查询设备数量
    get_statistics_plus(cb, data) {
        fetch(config.apiq.statisticsPlus, 'post', data).then((data) => { cb(data) })
    },
    // 查询告警/报警统计
    get_statistics(cb, data) {
        fetch(config.apiq.statisticsQuestion, 'get', data).then((data) => { cb(data) })
    },
    // 查询设备地图分布数据
    get_map_data(cb, data) {
        fetch(config.apiq.distributionInMap, 'get', data).then((data) => { cb(data) })
    },
    // 查询设备地区分布数据
    get_distribution_data(cb, data) {
        fetch(config.apiq.distribution, 'get', data).then((data) => { cb(data) })
    },
    // 查询服务统计数据
    get_service_count_data(cb, data) {
        fetch(config.apiq.count, 'get', data).then((data) => { cb(data) })
    },
}
