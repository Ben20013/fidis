import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.indass.project.getList,'get',params,conf).then((data)=>{cb(data)})
    },
    get(cb, params, conf) {
        mixGetJson(config.indass.project.get,'get',params,conf).then((data)=>{cb(data)})
    },
    add(cb, params, conf) {
        mixGetJson(config.indass.project.add,'post',params,conf).then((data)=>{cb(data)})
    },
    edit(cb, params, conf) {
        mixGetJson(config.indass.project.edit,'post',params,conf).then((data)=>{cb(data)})
    },
    delete(cb, params, conf) {
        mixGetJson(config.indass.project.delete,'post',params,conf).then((data)=>{cb(data)})
    },
    start(cb, params, conf) {
        mixGetJson(config.indass.project.start,'post',params,conf).then((data)=>{cb(data)})
    },
    stop(cb, params, conf) {
        mixGetJson(config.indass.project.stop,'post',params,conf).then((data)=>{cb(data)})
    },
    status(cb, params, conf) {
        mixGetJson(config.indass.project.status,'get',params,conf).then((data)=>{cb(data)})
    },
}