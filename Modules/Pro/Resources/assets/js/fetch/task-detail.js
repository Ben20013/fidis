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
  list(cb, params, conf) {
      fetch(config.weibao.detail.list,'post',params,conf).then((data)=>{cb(data)})
  },
  detail(cb, params, conf) {
      fetch(config.weibao.detail.detail,'post',params,conf).then((data)=>{cb(data)})
  },
  getName(cb, params, conf) {
      fetch(config.weibao.detail.getName,'post',params,conf).then((data)=>{cb(data)})
  },
  getCliName(cb, params, conf) {
      fetch(config.weibao.detail.getCliName,'post',params,conf).then((data)=>{cb(data)})
  },
  download(cb, params, conf) {
      fetch(config.weibao.detail.download,'get',params,conf).then((data)=>{cb(data)})
  },
  add(cb, params, conf) {
      fetch(config.weibao.detail.add,'upload',params,conf).then((data)=>{cb(data)})
  },
  edit(cb, params, conf) {
      fetch(config.weibao.detail.edit,'post',params,conf).then((data)=>{cb(data)})
  },
}
