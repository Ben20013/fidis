<!DOCTYPE html>
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
    <title>FIDIS Pro</title>
    <script type="text/javascript" src="http://api.map.baidu.com/getscript?v=2.0&ak=8haOo8aFgfas3EWFbFG7MHBI8GbLFvYc"></script>
    <link href="/modules/pro/css/pro.css" rel="stylesheet">

</head>
<body>
    <script>
        localStorage.setItem('loginState',1);
        let user=JSON.stringify(<?php echo json_encode($user);?>);
        if(user!='[]'){
            localStorage.setItem('user', user);
        }

        const pro_version = '<?php echo $config['pro_version'];?>';
        const mixPortal_url = '<?php echo $config['mixPortal_url'];?>';
        const protocol = '<?php echo $config['protocol'];?>';
        const apiqHost = '<?php echo $config['apiqHost'];?>';
        const host_online = '<?php echo $config['host_online'];?>';
        const socketAddress = '<?php echo $config['socketAddress'];?>';
        const system = '<?php echo $config['system'];?>';
        const industry=<?php echo $config['industry'];?>;
        const report_url='<?php echo $config['report_url'];?>';
    </script>
    <div id="app" style="background: #eff2f7;">
        <router-view><router-view>
    </div>
</body>
<script src="/modules/pro/js/pro.js"></script>
</html>
