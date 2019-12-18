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
import axios from 'axios'
import config from '@/assets/js/config/config';

axios.interceptors.response.use(function(response){
  // console.log(response);
  // console.log(response.data);
  if(response&&response.data&&response.data.code==401){
    let source = user ? JSON.parse(user).source : false;
		window.location.href = config.protocol + config.mixPortal_url + (source ? ('?source=' + source) : '');
    return;
  }
  return response.data;
},function(error){
  if (!error.response) {
    let data = {}
    data['code'] = -1
    data['msg'] = error.message
    return data;
  }
  if (!error.response.data) {
    error.response.data = {}
  }
  error.response.data['code'] = error.response.status
  if (error.response.status == 504 || error.response.status == 404) {
    if (!error.response.data['msg']) {
      error.response.data['msg'] = '服务器被吃了⊙﹏⊙∥'
    }
    // console.log('服务器被吃了⊙﹏⊙∥');
  } else if (error.response.status == 403) {
    if (!error.response.data['msg']) {
      error.response.data['msg'] = '权限不足,请联系管理员!'
    }
    // console.log('权限不足,请联系管理员!');
  }else {
    if (!error.response.data['msg']) {
      error.response.data['msg'] = '未知错误!'
    }
    // console.log('未知错误!');
  }
  return error.response.data;
})

export function fetch(url='', method='get', params={}, config={}) {
  let user=localStorage.getItem('user');
  let token = '';
  if(user){
  	token=JSON.parse(user).token || JSON.parse(user).ticket;
  }
  // console.log(token);
  let defaultConfig = {
    url: url,
    method: 'post',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Authorization':'Bearer '+token,
    },
    responseType: 'json'
  };
  let getStringifyParams = function (data) {
    let ret = ''
    for (let it in data) {
      ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
    }
    return ret.replace(/&$/,'')
  };
  if (method.toLocaleLowerCase() == 'get') {
    defaultConfig['method'] = 'get';
    defaultConfig['params'] = params;
    defaultConfig['paramsSerializer'] = function (data) {
      return getStringifyParams(data)
    };
  } else if (method.toLocaleLowerCase() == 'post') {
    defaultConfig['data'] = params;
    defaultConfig['transformRequest'] = [function (data) {
        return getStringifyParams(data)
      }];
  } else if (method.toLocaleLowerCase() == 'upload') {
    defaultConfig['data'] = params;
    defaultConfig['headers']['Content-Type'] = 'multipart/form-data';
    // defaultConfig['headers']['Authorization'] = 'Bearer '+token;
  }
  defaultConfig = Object.assign(defaultConfig,config);
  // console.log(defaultConfig);
  return axios(defaultConfig)
}
