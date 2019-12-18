import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.indass.message.getList,'get',params,conf).then((data)=>{cb(data)})
    },
    get(cb, params, conf) {
        mixGetJson(config.indass.message.get,'get',params,conf).then((data)=>{cb(data)})
    },
    add(cb, params, conf) {
        mixGetJson(config.indass.message.add,'post',params,conf).then((data)=>{cb(data)})
    },
    edit(cb, params, conf) {
        mixGetJson(config.indass.message.edit,'post',params,conf).then((data)=>{cb(data)})
    },
    delete(cb, params, conf) {
        mixGetJson(config.indass.message.delete,'post',params,conf).then((data)=>{cb(data)})
    }
}