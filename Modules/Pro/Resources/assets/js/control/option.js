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
import i18n from '../../../lang/i18n';

var mixControlOptions = {
    switchControl: function(opt) {
        if (opt.itemData && Array.isArray(opt.itemData)) {
            let itemArr = [];
            for (let i = 0; i < opt.itemData.length; i++) {
                const item = opt.itemData[i];
                itemArr.push(`
                  <div class="mix-control__switch flex-wrap">
                    <div class="mix-control__switch_name">${item.name}</div>
                    <div class="mix-control__switch_btn">
                      <input type="checkbox" id="${opt.attribute + '__' + item.id}" data-status-code="${item.statusCode}" data-id="${item.id}" class="mix-control__switch_checkbox">
                      <label for="${opt.attribute + '__' + item.id}" class="mix-control__switch_left"></label>
                      <label for="${opt.attribute + '__' + item.id}" class="mix-control__switch_right">
                        <div class="switch__text flex-wrap">
                          <span class="switch__text_on">${i18n.t('deviceLang.control_on_btn_label')}</span>
                          <span class="switch__text_off">${i18n.t('deviceLang.control_off_btn_label')}</span>
                        </div>
                      </label>
                    </div>
                  </div>
                `)
            }
            let strTemplate = ''
            if (opt.name) {
              strTemplate = `
              <div class="mix-control__box_header">
                <div class="name">${opt.name}</div>
              </div>
              <div class="mix-control__box_body flex-column">
                <div class="mix-control__switchgroup flex-column">${itemArr.join('')}</div>
              </div>
              `;
            } else {
              strTemplate = `
              <div class="mix-control__switch_wrap flex-column">
                ${itemArr.join('')}
              </div>
            `;
            }
            return strTemplate;
        }
        return ''
    },
    switchControlBtn: function(opt) {
        if (opt.itemData && Array.isArray(opt.itemData)) {
            let itemArr = [];
            for (let i = 0; i < opt.itemData.length; i++) {
                const item = opt.itemData[i];
                itemArr.push(`
                  <div class="mix-control__switch flex-wrap">
                    <div class="mix-control__switch_name">${item.name}</div>
                    <div class="mix-control__switchbtn">
                      <input type="checkbox" id="${opt.attribute + '__' + item.id}" data-status-code="${item.statusCode}" data-id="${item.id}" class="mix-control__switch_checkbox">
                      <label for="${opt.attribute + '__' + item.id}" class="mix-control__switchbtn_style"></label>
                    </div>
                  </div>
                `)
            }
            let strTemplate = ''
            if (opt.name) {
              strTemplate = `
              <div class="mix-control__box_header">
                <div class="name">${opt.name}</div>
              </div>
              <div class="mix-control__box_body flex-column">
                <div class="mix-control__switchgroup flex-column">${itemArr.join('')}</div>
              </div>
              `;
            } else {
              strTemplate = `
              <div class="mix-control__switch_wrap flex-column">
                ${itemArr.join('')}
              </div>
            `;
            }
            return strTemplate;
        }
        return ''
    },
    btnGroupControl: function(opt) {
        let itemArr = [];
        if (opt.itemData && Array.isArray(opt.itemData)) {
            for (let i = 0; i < opt.itemData.length; i++) {
                const item = opt.itemData[i];
                let style = item.background !== undefined ? 'background: ' + item.background + ';' : ''
                itemArr.push('<div class="mix-control__btngroup_item" data-attribute="' + opt.attribute + '" data-id="' + item.id + '" style="' + style + '">' + item.name + '</div>')
            }
        }
        let strTemplate = `
      <div class="mix-control__box_header">
        <div class="name">${opt.name}</div>
        ${opt.valueItem !== undefined ? '<div class="value" id="'+ opt.attribute +'__value">'+ opt.valueItem['value'] +'</div>': ''}
      </div>
      <div class="mix-control__box_body">
        <div class="mix-control__btngroup">
          ${itemArr.join('')}
        </div>
      </div>
    `;
        return strTemplate;
    },
    gaugeSetControl: function(opt) {
        if (opt.itemData && Array.isArray(opt.itemData) && opt.itemData[0]) {
            let item = opt.itemData[0]
            let strTemplate = `
        <div class="mix-control__box_header">
          <div class="name">${opt.name}</div>
        </div>
        <div class="mix-control__box_body">
          <div class="mix-control__gaugeset">
            <div class="gaugeset__gauge">
              <svg version="1.0" id="${opt.attribute}__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" viewBox="0 0 200 200" xml:space="preserve">
                <path d="M37.6,187.9c-1.7,0-3.5-0.6-4.9-1.9C11.9,167.1,0,140.2,0,112.1c0-55.1,44.9-100,100-100c55.1,0,100,44.9,100,100
                c0,28.1-11.9,55.1-32.7,74c-2.9,2.7-7.5,2.5-10.2-0.5c-2.7-2.9-2.5-7.5,0.5-10.2c17.8-16.2,28-39.3,28-63.3
                c0-47.2-38.4-85.6-85.6-85.6c-47.2,0-85.6,38.4-85.6,85.6c0,24,10.2,47.1,28,63.3c2.9,2.7,3.2,7.2,0.5,10.2
                C41.5,187.1,39.5,187.9,37.6,187.9z" fill="#ffffff" />
              </svg>
              <div class="gauge__content_wrap">
                <div class="gauge__content flex-column">
                  <div class="gauge__content_value flex-column"><span id="${opt.attribute}__value" ${item.color !== undefined ? 'style="color:'+item.color+';"' : ''}>${item.value}</span></div>
                  <div class="gauge__content_name">${item.name}</div>
                </div>
              </div>
            </div>
            <div class="input__set flex-wrap">
              <div class="mix-control_increase" data-attribute="${opt.attribute}" data-step="${item.step}"><i class="icon"></i></div>
              <div class="mix-control_input">
                <input type="text" id="${opt.attribute}__input" step="${item.step}" value="${item.value}">
              </div>
              <div class="mix-control_decrease" data-attribute="${opt.attribute}" data-step="${-item.step}"><i class="icon"></i></div>
            </div>
            <div class="mix-control__button" data-attribute="${opt.attribute}" data-id="${item.id}">${i18n.t('deviceLang.control_confirm_btn_label')}</div>
          </div>
        </div>
      `;
            return strTemplate;
        }
        return ''
    },
    setControl: function(opt) {
      if (opt.itemData && Array.isArray(opt.itemData) && opt.itemData[0]) {
        let item = opt.itemData[0]
        let strTemplate = `
          <div class="mix-control__box_header">
            <div class="name">${opt.name}</div>
          </div>
          <div class="mix-control__box_body">
            <div class="mix-control__setcontrol flex-column">
              <div class="input__set flex-wrap">
                <div class="mix-control_increase" data-attribute="${opt.attribute}" data-step="${item.step}"><i class="icon"></i></div>
                <div class="mix-control_input">
                  <input type="text" id="${opt.attribute}__input" step="${item.step}" value="${item.value}" data-is-edit="0">
                </div>
                <div class="mix-control_decrease" data-attribute="${opt.attribute}" data-step="${-item.step}"><i class="icon"></i></div>
              </div>
              <div class="mix-control__button" data-attribute="${opt.attribute}" data-id="${item.id}">${i18n.t('deviceLang.control_confirm_btn_label')}</div>
            </div>
          </div>
        `;
        return strTemplate;
      }
      return ''
    },
};

export default mixControlOptions