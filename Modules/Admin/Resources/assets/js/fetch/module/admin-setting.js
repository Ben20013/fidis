import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    get(cb, params, conf) {
        mixGetJson(config.admin.setting.get,'get',params,conf).then((data)=>{cb(data)})
    },
    add(cb, params, conf) {
        mixGetJson(config.admin.setting.add,'post',params,conf).then((data)=>{cb(data)})
    },
}