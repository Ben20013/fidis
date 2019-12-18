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
let mixControlData = {
  "AP2018121200001": {
    "name": "AP2018121200001",
    "row": 16,
    "col": 31,
    "data": [{
        "type": "SwitchControl",
        "attribute": "switchControl__01",
        "itemData": [{
          "id": "QQQ",
          "name": "报警提示音",
          "statusCode": [0, 1],
          "command": {
            "0": {
              "i_type": "equipment",
              "command": {"equipment_id": 1, "aprus_id": "zwl_test", "param": "[\"Control1\",\"0\"]", "platform": "P"}
            },
            "1": {
              "i_type": "equipment",
              "command": {"equipment_id": 1, "aprus_id": "zwl_test", "param": "[\"Control1\",\"1\"]", "platform": "P"}
            }
          }
        }],
        "xys": {
          "pos": [0, 0],
          "len": [1, 5]
        }
      },
      {
        "type": "SwitchControlBtn",
        "attribute": "switchControl__01",
        "itemData": [{
          "id": "QQQ",
          "name": "风机开关",
          "statusCode": [0, 1],
          "command": {
            "0": {
              "i_type": "equipment",
              "command": {"equipment_id": 1, "aprus_id": "zwl_test", "param": "[\"Control1\",\"0\"]", "platform": "P"}
            },
            "1": {
              "i_type": "equipment",
              "command": {"equipment_id": 1, "aprus_id": "zwl_test", "param": "[\"Control1\",\"1\"]", "platform": "P"}
            }
          }
        }],
        "xys": {
          "pos": [1, 0],
          "len": [1, 5]
        }
      },
      {
        "type": "BtnGroupControl",
        "attribute": "btnGroupControl__01",
        "name": "原料累计(m3)",
        "valueItem": {
          "id": "S010135",
          "value": 0
        },
        "itemData": [{
            "id": "AAA",
            "name": "清除",
            "background": "#dc3550",
            "command": {
              "i_type": "equipment",
              "command": {"equipment_id": 1, "aprus_id": "zwl_test", "param": "[\"Control1\",\"1\"]", "platform": "P"}
            }
          },
          {
            "id": "BBB",
            "name": "远程启动",
            "background": "#17c68e",
            "command": {
              "i_type": "equipment",
              "command": {"equipment_id": 1, "aprus_id": "zwl_test", "param": "[\"Control1\",\"1\"]", "platform": "P"}
            }
          }
        ],
        "xys": {
          "pos": [0, 5],
          "len": [4, 5]
        }
      },
      {
        "type": "GaugeSetControl",
        "attribute": "gaugeSetControl__01",
        "name": "TT030进料预热后温度调节",
        "itemData": [{
          "id": "H2",
          "name": "当前温度",
          "value": 0,
          "step": 1,
          "color": "#fa8f2a",
          "command": {
            "i_type": "equipment",
            "command": {"equipment_id": 1, "aprus_id": "zwl_test", "param": "[\"Control1\",\"$val\"]", "platform": "P"}
          }
        }],
        "xys": {
          "pos": [0, 10],
          "len": [5, 6]
        }
      },
      {
        "type": "SetControl",
        "attribute": "setControl__01",
        "name": "TT030进料预热后温度调节",
        "itemData": [{
          "id": "H2",
          "value": 0,
          "step": 1,
          "command": {
            "i_type": "equipment",
            "command": {"equipment_id": 1, "aprus_id": "zwl_test", "param": "[\"Control1\",\"$val\"]", "platform": "P"}
          }
        }],
        "xys": {
          "pos": [0, 16],
          "len": [5, 6]
        }
      },
    ]
  }
}

export default mixControlData