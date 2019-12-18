import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.admin.aprus.getList,'get',params,conf).then((data)=>{cb(data)})
    },
    get(cb, params, conf) {
        mixGetJson(config.admin.aprus.get,'get',params,conf).then((data)=>{cb(data)})
    },
    add(cb, params, conf) {
        mixGetJson(config.admin.aprus.add,'post',params,conf).then((data)=>{cb(data)})
    },
    edit(cb, params, conf) {
        mixGetJson(config.admin.aprus.edit,'post',params,conf).then((data)=>{cb(data)})
    },
    delete(cb, params, conf) {
        mixGetJson(config.admin.aprus.delete,'post',params,conf).then((data)=>{cb(data)})
    },
}