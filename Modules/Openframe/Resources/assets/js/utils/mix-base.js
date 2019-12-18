
exports.install = function (Vue, options) {
    Vue.prototype.$mix = new function(){
        this.initParams = function(target, source){
            if (!target) {
                return target
            }
            const params = target.constructor === Array ? [] : {};
            for (const tkey in target) {
                if (target.hasOwnProperty(tkey) && source.hasOwnProperty(tkey)) {
                    if (typeof target[tkey] === 'object' && typeof source[tkey] === 'object') {
                        params[tkey] = this.initParams(target[tkey], source[tkey]);
                    } else {
                        let value = source[tkey];
                        params[tkey] = value;
                    }
                }
            }
            return params;
        };
        this.stringToJson = function(str){
            try {
                return JSON.parse(str);
            } catch (error) {
                console.log(error)
                return str
            }
        };
        this.jsonToString = function(obj){
            try {
                return JSON.stringify(obj);
            } catch (error) {
                console.log(error)
                return obj
            }
        };
        this.formatJson = function(jsonString){
            if (!jsonString) {
                return jsonString
            }
            try {
                return JSON.stringify(JSON.parse(jsonString),null,2)
            } catch (error) {
                return jsonString
            }
        };
    }
};