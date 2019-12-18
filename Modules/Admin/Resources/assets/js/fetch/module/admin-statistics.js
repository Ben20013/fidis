import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.admin.statistics.getList,'get',params,conf).then((data)=>{cb(data)})
    },
    get(cb, params, conf) {
        mixGetJson(config.admin.statistics.get,'get',params,conf).then((data)=>{cb(data)})
    },
    add(cb, params, conf) {
        mixGetJson(config.admin.statistics.add,'post',params,conf).then((data)=>{cb(data)})
    },
    edit(cb, params, conf) {
        mixGetJson(config.admin.statistics.edit,'post',params,conf).then((data)=>{cb(data)})
    },
    delete(cb, params, conf) {
        mixGetJson(config.admin.statistics.delete,'post',params,conf).then((data)=>{cb(data)})
    },
    start(cb, params, conf) {
        mixGetJson(config.admin.statistics.start,'post',params,conf).then((data)=>{cb(data)})
    },
    stop(cb, params, conf) {
        mixGetJson(config.admin.statistics.stop,'post',params,conf).then((data)=>{cb(data)})
    },
    status(cb, params, conf) {
        mixGetJson(config.admin.statistics.status,'get',params,conf).then((data)=>{cb(data)})
    },
    get_list_by_time(cb, params, conf) {
        mixGetJson(config.admin.statistics.listByTime,'get',params,conf).then((data)=>{cb(data)})
    },
}