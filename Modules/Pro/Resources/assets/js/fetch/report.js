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
  //获取报告列表
  get_list(cb,data){
    fetch(config.apir.getReportList,'post',data).then((data)=>{cb(data)}).catch((e)=>{cb(e)})
  },
  //获取报告列表
  get_list_by_user(cb,data){
    fetch(config.apir.getReportListByUser,'post',data).then((data)=>{cb(data)}).catch((e)=>{cb(e)})
  },
  // 获取报告详细信息
  get_detail(cb,data){
    fetch(config.apir.getReportDetail,'get',data).then((data)=>{cb(data)}).catch((e)=>{cb(e)})
  },
  // 下载
  download_report(cb,data){
    fetch(config.apir.download,'get',data).then((data)=>{cb(data)}).catch((e)=>{cb(e)})
  },
  // 下载
  delete_report(cb,data){
    fetch(config.apir.delete,'post',data).then((data)=>{cb(data)}).catch((e)=>{cb(e)})
  },
}
