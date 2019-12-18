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
import config from '$config'

export default {

    setLocal: function(name, val) {
        localStorage.setItem(name, val)
    },
    getLocal: function(name) {
        return localStorage.getItem(name)
    },
    setJsonLocal: function(name, json) {
        localStorage.setItem(name, JSON.stringify(json))
    },
    getJsonLocal: function(name) {
        if (!JSON.parse(localStorage.getItem(name))) {
            return ''
        } else {
            return JSON.parse(localStorage.getItem(name))
        }
    },
    isMobile: function(mobileNum) {
        return (new RegExp(/^1[3|4|5|6|7|8|9][0-9]\d{8}$/)).test(mobileNum)
    },
    isEmail: function(str) {
        var re = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        if (re.test(str) != true) {
            return false;
        } else {
            return true;
        }
    },

    getUrlParam: function(param) {
        var re = new RegExp("(\\\?|&)" + param + "=([^&]+)(&|$)", "i");
        var m = window.location.href.match(re);
        if (m) {
            return decodeURIComponent(m[2]);
        } else {
            return '';
        }
    },

    getNowTime() {
        var myDate = new Date();
        var year = myDate.getFullYear();
        //var year=myDate.getYear();
        var month = myDate.getMonth() + 1;
        var date = myDate.getDate();
        var hours = myDate.getHours();
        var minutes = myDate.getMinutes();
        var seconds = myDate.getSeconds();
        return year.toString() + "-" + month.toString() + "-" + date.toString() + " " + hours.toString() + ":" + minutes.toString() + ":" + seconds.toString();
    },


    getDays() { //获取当前月的天数
        let date = new Date();
        //获取年份
        let year = date.getFullYear();
        //获取当前月份
        let mouth = date.getMonth() + 1;
        //定义当月的天数；
        let days;
        //当月份为二月时，根据闰年还是非闰年判断天数
        if (mouth == 2) {
            days = year % 4 == 0 ? 29 : 28;
        } else if (mouth == 1 || mouth == 3 || mouth == 5 || mouth == 7 || mouth == 8 || mouth == 10 || mouth == 12) {
            //月份为：1,3,5,7,8,10,12 时，为大月.则天数为31；
            days = 31;
        } else {
            //其他月份，天数为：30.
            days = 30;
        }
        return days;
    },

}
