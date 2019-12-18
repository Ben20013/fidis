<?php
return [
    [
        'name' => 'Openframe',
        'route'=>'/openframe',
        'params'=>1,
        'description'=>'OpenFrame基础模块',
        'children'=>[
            [
                'name' => '项目列表',
                'route'=>'/openframe/project',
                'params'=>'/project',
                'description'=>'项目列表',
            ],
            [
                'name' => '结果列表',
                'route'=>'/openframe/result',
                'params'=>'/result',
                'description'=>'结果列表',
            ]
        ]
    ]
];
