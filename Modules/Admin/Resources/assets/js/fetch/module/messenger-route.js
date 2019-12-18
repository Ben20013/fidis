import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.route.list,'post',params,conf).then((data)=>{cb(data)})
    },
    get(cb, params, conf) {
        mixGetJson(config.route.detail,'post',params,conf).then((data)=>{cb(data)})
    },
    modify(cb, params, conf) {
        mixGetJson(config.route.modify,'post',params,conf).then((data)=>{cb(data)})
    },
    delete(cb, params, conf) {
        mixGetJson(config.route.delete,'post',params,conf).then((data)=>{cb(data)})
    },
}