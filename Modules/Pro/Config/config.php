<?php
return array (
  'name' => 'Pro',
  'is_system' => 1,
  'status' => 1,
  'version' => 'V1.0.0',
  'upgrade_time' => '2019-05-10 00:00:00',
  'description' => 'Pro应用系统',
  'industry' => 
  array (
    'gas' => 
    array (
      'industry_name' => '气站',
      'name' => '气站',
      'hasStatus' => 1,
      'header' => 
      array (
        0 => 
        array (
          'key' => '',
          'name' => '气电比',
        ),
        1 => 
        array (
          'key' => '',
          'name' => '供气压力/Mpa',
        ),
        2 => 
        array (
          'key' => '',
          'name' => '累计用气量/Nm³',
        ),
      ),
    ),
    'electricity' => 
    array (
      'industry_name' => '发电机组',
      'name' => '电站',
      'hasStatus' => 1,
      'header' => 
      array (
        0 => 
        array (
          'key' => '',
          'name' => '当前总功率/MW',
        ),
        1 => 
        array (
          'key' => '',
          'name' => '装机容量/MW',
        ),
        2 => 
        array (
          'key' => '',
          'name' => '开机率',
        ),
      ),
    ),
    'boiler' => 
    array (
      'industry_name' => '锅炉',
      'name' => '项目',
      'hasStatus' => 0,
      'header' => 
      array (
        0 => 
        array (
          'key' => '',
          'name' => '热效率/%',
        ),
        1 => 
        array (
          'key' => '',
          'name' => '累计流量/T',
        ),
        2 => 
        array (
          'key' => '',
          'name' => '累计耗电量/kW·h',
        ),
        3 => 
        array (
          'key' => '',
          'name' => '累计耗水量/T',
        ),
      ),
    ),
    'pumping' => 
    array (
      'industry_name' => '泵站',
      'name' => '泵站',
      'hasStatus' => 1,
      'header' => 
      array (
        0 => 
        array (
          'key' => '',
          'name' => '累计流量/m³',
        ),
        1 => 
        array (
          'key' => '',
          'name' => '耗能/kW·h',
        ),
        2 => 
        array (
          'key' => '',
          'name' => '运行时间/H',
        ),
      ),
    ),
    'normal' => 
    array (
      'industry_name' => '通用',
      'name' => '项目',
      'header' => 
      array (
      ),
    ),
  ),
  'setting' => 
  array (
    'common' => 
    array (
      'product_name' => 'Mixlinker FIDIS Pro',
      'website_title' => 'Fidis pro',
      'copyright' => 'CopyRight 2014-2018 <a href="http://www.mixlinker.com" target="_blank">深圳市智物联网络有限公司</a>',
      'app_url' => 'http://app.mixlinker.com:9000/download/app/60/',
      'logo_path' => 'http://localhost/000/fidis.pro/trunk/modules/pro/static/images/login/logo.png',
      'icon_path' => 'http://base.fidis.com/favicon.ico',
      'help_url' => '',
    ),
    'system' => 
    array (
      'industry' => 'boiler',
      'hasStatus' => '1',
      'name' => '项目',
      'header' => 
      array (
        0 => 
        array (
          'name' => '吨汽耗燃料(Nm³)',
          'key' => '0',
        ),
        1 => 
        array (
          'name' => '吨汽耗电(kW·h)',
          'key' => '1',
        ),
        2 => 
        array (
          'name' => '吨汽耗水(T)',
          'key' => '2',
        ),
        3 => 
        array (
          'name' => '产汽量(T)',
          'key' => '3',
        ),
        4 => 
        array (
          'name' => '耗燃料(Nm³)',
          'key' => '4',
        ),
        5 => 
        array (
          'name' => '总耗电量(kW·h)',
          'key' => '5',
        ),
      ),
      'status' => 
      array (
        'key' => 'Z',
        'name' => '项目状态',
      ),
      'equipment' => 
      array (
        0 => 
        array (
          'id' => 'equipment_image',
          'listorder' => 10,
          'name' => '设备图片',
          'show' => 1,
          'search' => 0,
          'width' => '100',
        ),
        1 => 
        array (
          'id' => 'equipment_name',
          'listorder' => 20,
          'name' => '设备名称',
          'show' => 1,
          'search' => 0,
          'width' => '100',
        ),
        2 => 
        array (
          'id' => 'model',
          'listorder' => 30,
          'name' => '设备型号',
          'show' => 1,
          'search' => 0,
          'width' => '100',
        ),
        3 => 
        array (
          'id' => 'status_name',
          'listorder' => 40,
          'name' => '设备状态',
          'show' => 1,
          'search' => 0,
          'width' => '100',
        ),
        4 => 
        array (
          'id' => 'customer_name',
          'listorder' => 50,
          'name' => '客户名称',
          'show' => 1,
          'search' => 0,
          'width' => '100',
        ),
        5 => 
        array (
          'id' => 'created',
          'listorder' => 60,
          'name' => '设备创建时间',
          'show' => 1,
          'search' => 0,
          'width' => '100',
        ),
        6 => 
        array (
          'id' => 'equipment_id',
          'listorder' => 70,
          'name' => '设备编号',
          'show' => '0',
          'search' => 0,
          'width' => '100',
        ),
        7 => 
        array (
          'id' => 'customer_id',
          'listorder' => 80,
          'name' => '客户编号',
          'show' => 0,
          'search' => 0,
          'width' => '100',
        ),
        8 => 
        array (
          'id' => 'aprus_list',
          'listorder' => 90,
          'name' => '适配器列表',
          'show' => 0,
          'search' => 0,
          'width' => '100',
        ),
        9 => 
        array (
          'id' => 'description',
          'listorder' => 100,
          'name' => '描述',
          'show' => 0,
          'search' => 0,
          'width' => '100',
        ),
        10 => 
        array (
          'id' => 'gis',
          'listorder' => 110,
          'name' => '设备地理信息',
          'show' => 0,
          'search' => 0,
          'width' => '100',
        ),
      ),
    ),
  ),
);
