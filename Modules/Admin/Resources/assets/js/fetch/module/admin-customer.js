import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.admin.customer.getList,'get',params,conf).then((data)=>{cb(data)})
    },
    get(cb, params, conf) {
        mixGetJson(config.admin.customer.get,'get',params,conf).then((data)=>{cb(data)})
    },
    add(cb, params, conf) {
        mixGetJson(config.admin.customer.add,'post',params,conf).then((data)=>{cb(data)})
    },
    edit(cb, params, conf) {
        mixGetJson(config.admin.customer.edit,'post',params,conf).then((data)=>{cb(data)})
    },
    delete(cb, params, conf) {
        mixGetJson(config.admin.customer.delete,'post',params,conf).then((data)=>{cb(data)})
    },
    get_exp_list(cb, params, conf) {
        mixGetJson(config.common.expList,'get',params,conf).then((data)=>{cb(data)})
    },
}