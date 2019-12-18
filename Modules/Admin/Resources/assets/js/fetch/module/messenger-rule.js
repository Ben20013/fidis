import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.rule.list,'post',params,conf).then((data)=>{cb(data)})
    },
    get(cb, params, conf) {
        mixGetJson(config.rule.detail,'post',params,conf).then((data)=>{cb(data)})
    },
    modify(cb, params, conf) {
        mixGetJson(config.rule.modify,'post',params,conf).then((data)=>{cb(data)})
    },
    delete(cb, params, conf) {
        mixGetJson(config.rule.delete,'post',params,conf).then((data)=>{cb(data)})
    },
    status(cb, params, conf) {
        mixGetJson(config.rule.status,'post',params,conf).then((data)=>{cb(data)})
    },
    get_tpl_list(cb, params, conf) {
        mixGetJson(config.rule.tplType,'post',params,conf).then((data)=>{cb(data)})
    },
    get_agent_type_list(cb, params, conf) {
        mixGetJson(config.rule.agentType,'post',params,conf).then((data)=>{cb(data)})
    },
}