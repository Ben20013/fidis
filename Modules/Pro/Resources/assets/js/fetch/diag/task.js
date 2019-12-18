/******************************************************************************
 * Copyright (c) 2019-2021 Mixlinker Networks Inc. <mixiot@mixlinker.com>
 * All rights reserved.
 *
 * This program and the accompanying materials are made available under the
 * terms of the Application License of Mixlinker Networks License and Mixlinker
 * Distribution License which accompany this distribution.
 *
 * The Mixlinker License is available at
 *    http://www.mixlinker.com/legal/license.html
 * and the Mixlinker Distribution License is available at
 *    http://www.mixlinker.com/legal/distribution.html
 *
 * Contributors:
 *    Mixlinker Technical Team
 *****************************************************************************/
import config from '$config';
import { fetch } from '$api.js';

export default {

    list(cb, data) {
        console.log('task.js');
        console.log(config.diag);
        fetch(config.diag.task.list, 'post', data).then( (data) => { cb(data) } ).catch( (e) => { cb(e) } )
    },

    getInfoById(cb, data) {
        fetch(config.diag.task.getInfoById, 'post', data).then( (data) => {cb(data)} ).catch( (e) => { cb(e) } )
    },

    createResultByHand(cb, data) {
        fetch(config.diag.task.createResultByHand, 'post', data).then((data) => {cb(data)} ).catch( (e) => { cb(e) } )
    },
}
