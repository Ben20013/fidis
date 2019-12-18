import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.admin.log.getList,'get',params,conf).then((data)=>{cb(data)})
    },
    get(cb, params, conf) {
        mixGetJson(config.admin.log.get,'get',params,conf).then((data)=>{cb(data)})
    },
}