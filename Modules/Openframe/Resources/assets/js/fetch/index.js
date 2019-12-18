import config from '../config/api.conf';
import {
    mixGetJson
} from './api';

export default {
    getMenuList(cb, params, conf) {
        mixGetJson(config.base.getMenuList, 'get', params, conf).then((data) => {
            cb(data)
        })
    }
}