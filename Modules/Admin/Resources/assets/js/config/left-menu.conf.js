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
export default [{
        "label": "模块管理",
        "symbol": "module",
        "target": "/module",
        "normal_image": "/images/public/normal/equipment-group-icon.png",
        "press_image": "/images/public/press/equipment-group-icon.png",
        "isSubmenuShow": false,
        "target_list": []
    },
    {
        "label": "菜单管理",
        "symbol": "menu",
        "target": "/menu",
        "normal_image": "/images/public/normal/rule-icon.png",
        "press_image": "/images/public/press/rule-icon.png",
        "isSubmenuShow": false,
        "target_list": []
    },
    {
        "label": "门户中心",
        "symbol": "portal",
        "target": "/portal",
        "normal_image": "/images/public/normal/terminal-icon.png",
        "press_image": "/images/public/press/terminal-icon.png",
        "isSubmenuShow": false,
        "target_list": []
    },
    {
        "label": "模块列表",
        "symbol": "object",
        "target": "/object-manage",
        "normal_image": "/images/public/normal/object-icon.png",
        "press_image": "/images/public/press/object-icon.png",
        "isSubmenuShow": false,
        "target_list": [{
                "label": "维保",
                "symbol": "object",
                "target": "/object-manage/object",
            },
            {
                "label": "报表",
                "symbol": "datasheet",
                "target": "/object-manage/datasheet",
            },
            {
                "label": "工单",
                "symbol": "mapping",
                "target": "/object-manage/mapping",
            },
            {
                "label": "app",
                "symbol": "dashboard",
                "target": "/object-manage/dashboard",
            }
        ]
    },
    {
        "label": "系统设置",
        "symbol": "setting",
        "target": "/setting",
        "normal_image": "/images/public/normal/setting-icon.png",
        "press_image": "/images/public/press/setting-icon.png",
        "isSubmenuShow": false,
        "target_list": []
    }
]
