import config from '../config/api.conf';
import {
    mixGetJson
} from './api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.result.list, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    detail(cb, params, conf) {
        mixGetJson(config.result.detail, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    add(cb, params, conf) {
        mixGetJson(config.result.add, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
    edit(cb, params, conf) {
        mixGetJson(config.result.edit, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
    delete(cb, params, conf) {
        mixGetJson(config.result.delete, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
}