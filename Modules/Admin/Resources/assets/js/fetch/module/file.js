import config from '../../config/api.conf';
import {mixGetJson} from '../api';

export default {
    upload(cb, params, conf) {
        mixGetJson(config.common.file.upload,'upload',params,conf).then((data)=>{cb(data)})
    },
    download(file) {
        // 创建隐藏的可下载链接
        let eleLink = document.createElement('a');
        eleLink.download = file.name;
        eleLink.style.display = 'none';
        eleLink.href = config.common.file.download + '?path=' + file.url;
        console.log(eleLink.href);
        // 触发点击
        document.body.appendChild(eleLink);
        eleLink.click();
        // 然后移除
        document.body.removeChild(eleLink);
    },
}