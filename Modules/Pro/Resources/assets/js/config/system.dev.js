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
const gas = {
    name: '气站',
    hasStatus: 1,
    header: ['气电比', '供气压力/Mpa', '累计用气量/Nm³'],
}
const electricity = {
    name: '电站',
    hasStatus: 1,
    header: ['当前总功率/MW', '装机容量/MW', '开机率'],
}
const boiler = {
    name: '项目',
    hasStatus: 0,
    header: ['热效率/%', '累计流量/T', '累计耗电量/kW·h', '累计耗水量/T'],
}
const pumping = {
    name: '泵站',
    hasStatus: 1,
    header: ['累计流量/m³', '耗能/kW·h', '运行时间/H'],
}
const normal = {
    name: '项目',
    header: [],
}
module.exports = gas
