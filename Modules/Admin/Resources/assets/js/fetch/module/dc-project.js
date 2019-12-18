import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.dc.project.getList,'get',params,conf).then((data)=>{cb(data)})
    },
    get(cb, params, conf) {
        mixGetJson(config.dc.project.get,'get',params,conf).then((data)=>{cb(data)})
    },
    add(cb, params, conf) {
        mixGetJson(config.dc.project.add,'post',params,conf).then((data)=>{cb(data)})
    },
    edit(cb, params, conf) {
        mixGetJson(config.dc.project.edit,'post',params,conf).then((data)=>{cb(data)})
    },
    delete(cb, params, conf) {
        mixGetJson(config.dc.project.delete,'post',params,conf).then((data)=>{cb(data)})
    },
    start(cb, params, conf) {
        mixGetJson(config.dc.project.start,'post',params,conf).then((data)=>{cb(data)})
    },
    stop(cb, params, conf) {
        mixGetJson(config.dc.project.stop,'post',params,conf).then((data)=>{cb(data)})
    },
    status(cb, params, conf) {
        mixGetJson(config.dc.project.status,'get',params,conf).then((data)=>{cb(data)})
    },
}