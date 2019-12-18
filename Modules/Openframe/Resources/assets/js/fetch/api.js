import axios from 'axios'
//用于登录超时跳转
import router from '../router/index'

export function mixGetJson(url = '', method = 'get', params = {}, config = {}) {
    let user = localStorage.getItem('user');
    let token = '';
    if (user) {
        token = JSON.parse(user).token || JSON.parse(user).ticket;
    }
    // console.log(token);
    let defaultConfig = {
        url: url,
        method: 'post',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Authorization': 'Bearer ' + token,
        },
        // auth: {
        //   'Authorization':'Bearer '+token,
        // },
        responseType: 'json',
        timeout: 10000,
    };
    let getStringifyParams = function(data) {
        let ret = ''
        for (let it in data) {
            if (data[it] !== null && data[it] !== '') { //过滤掉没有值的参数
                ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
            }
        }
        return ret.replace(/&$/, '')
    };
    if (method.toLocaleLowerCase() == 'get') {
        defaultConfig['method'] = 'get';
        defaultConfig['params'] = params;
        defaultConfig['paramsSerializer'] = function(data) {
            return getStringifyParams(data)
        };
    } else if (method.toLocaleLowerCase() == 'post') {
        defaultConfig['data'] = params;
        defaultConfig['transformRequest'] = [function(data) {
            return getStringifyParams(data)
        }];
    } else if (method.toLocaleLowerCase() == 'upload') {
        defaultConfig['data'] = params;
        defaultConfig['headers']['Content-Type'] = 'multipart/form-data';
        // defaultConfig['headers']['Authorization'] = 'Bearer '+token;
    }
    defaultConfig = Object.assign(defaultConfig, config);
    // console.log(defaultConfig);
    return new Promise((resolve, reject) => {
        axios(defaultConfig)
            .then(response => {
                // console.log(response);
                if (response.data.code == 401) {
                    router.push('/login');
                    return;
                }
                resolve(response.data);
            })
            .catch(error => {
                console.log(error)
                resolve(error)
            })
    });
}