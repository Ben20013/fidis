<!doctype html>
<!--******************************************************************************
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
 *****************************************************************************-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title?$title:'FIDIS Admin'}}</title>
    <link href="/modules/admin/css/admin.css" rel="stylesheet">

</head>
<body>
    <script>
        const version = 'V.1.3.3';
        const mixPortal_url='delivery.mixiot.top';
        const mixPassport_url='passport.delivery.mixiot.top';
        const protocol = '';
        const host = '{{$host}}';
        const adminHost = '{{$host}}';
        const adminSource = 'MixPortal';
        localStorage.setItem('loginState',1);
        let user=JSON.stringify(<?php echo json_encode($user);?>);
        if(user!='[]'){
            localStorage.setItem('user', user);
        }
    </script>
<div id="app">
    <router-view></router-view>
</div>
</body>
<script src="/modules/admin/js/admin.js"></script>
</html>
