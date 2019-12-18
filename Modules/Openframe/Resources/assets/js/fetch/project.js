import config from '../config/api.conf';
import {
    mixGetJson
} from './api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.project.list, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    detail(cb, params, conf) {
        mixGetJson(config.project.detail, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    add(cb, params, conf) {
        mixGetJson(config.project.add, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
    edit(cb, params, conf) {
        mixGetJson(config.project.edit, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
    delete(cb, params, conf) {
        mixGetJson(config.project.delete, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    enable(cb, params, conf) {
        mixGetJson(config.project.enable, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    disable(cb, params, conf) {
        mixGetJson(config.project.disable, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    upload(cb, params, conf) {
        mixGetJson(config.project.upload, 'upload', params, conf).then((data) => {
            cb(data)
        })
    },
}