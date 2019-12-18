import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    list(cb, params, conf) {
        mixGetJson(config.detail.list,'post',params,conf).then((data)=>{cb(data)})
    },
    detail(cb, params, conf) {
        mixGetJson(config.detail.detail,'post',params,conf).then((data)=>{cb(data)})
    },
    getName(cb, params, conf) {
        mixGetJson(config.detail.getName,'post',params,conf).then((data)=>{cb(data)})
    },
    getCliName(cb, params, conf) {
        mixGetJson(config.detail.getCliName,'post',params,conf).then((data)=>{cb(data)})
    },
    download(cb, params, conf) {
        mixGetJson(config.detail.download,'get',params,conf).then((data)=>{cb(data)})
    },
    add(cb, params, conf) {
        mixGetJson(config.detail.add,'upload',params,conf).then((data)=>{cb(data)})
    },
    edit(cb, params, conf) {
        mixGetJson(config.detail.edit,'post',params,conf).then((data)=>{cb(data)})
    },
    

}