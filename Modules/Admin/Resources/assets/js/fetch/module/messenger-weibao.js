import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    list(cb, params, conf) {
        mixGetJson(config.weibao.list,'post',params,conf).then((data)=>{cb(data)})
    },
}