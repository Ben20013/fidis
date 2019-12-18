import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    get_version(cb, params, conf) {
        mixGetJson(config.base.version,'get',params,conf).then((data)=>{cb(data)})
    },
    get_user(cb, params, conf) {
        mixGetJson(config.base.user,'get',params,conf).then((data)=>{cb(data)})
    },
    // edit_user(cb, params, conf) {
    //     mixGetJson(config.base.editUser,'post',params,conf).then((data)=>{cb(data)})
    // },
    logout(cb, params, conf) {
        mixGetJson(config.base.logout,'get',params,conf).then((data)=>{cb(data)})
    },
}