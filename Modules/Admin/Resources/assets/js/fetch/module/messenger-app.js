import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    list(cb, params, conf) {
        mixGetJson(config.app.list,'post',params,conf).then((data)=>{cb(data)})
    },
    modify(cb, params, conf) {
        mixGetJson(config.app.modify,'post',params,conf).then((data)=>{cb(data)})
    },
    delete(cb, params, conf) {
        mixGetJson(config.app.delete,'post',params,conf).then((data)=>{cb(data)})
    },
    add(cb, params, conf) {
        mixGetJson(config.app.add,'post',params,conf).then((data)=>{cb(data)})
    },
    getRuleGroup(cb, params, conf) {
        mixGetJson(config.app.getRuleGroup,'post',params,conf).then((data)=>{cb(data)})
    },
    mapping(cb, params, conf) {
        mixGetJson(config.app.mapping,'post',params,conf).then((data)=>{cb(data)})
    },
    mappingType(cb, params, conf) {
        mixGetJson(config.app.mappingType,'post',params,conf).then((data)=>{cb(data)})
    },
    getRule(cb, params, conf) {
        mixGetJson(config.app.getRule,'post',params,conf).then((data)=>{cb(data)})
    },
    getName(cb, params, conf) {
        mixGetJson(config.app.getName,'post',params,conf).then((data)=>{cb(data)})
    },
}