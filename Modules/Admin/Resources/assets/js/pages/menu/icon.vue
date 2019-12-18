<!--
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
 -->
<template>
    <div style="padding: 0 0px;border-top: 1px solid #eee;border-left: 1px solid #eee;">
        <section id="icons-web-app" class="row">
            <div class="span3">
                <ul class="the-icons">
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-500px fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-500px</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-accessible-icon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-accessible-icon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-accusoft fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-accusoft</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-acquisitions-incorporated fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-acquisitions-incorporated</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ad fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ad</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-address-book fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-address-book</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-address-card fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-address-card</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-adjust fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-adjust</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-adn fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-adn</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-adobe fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-adobe</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-adversal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-adversal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-affiliatetheme fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-affiliatetheme</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-air-freshener fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-air-freshener</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-airbnb fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-airbnb</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-algolia fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-algolia</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-align-center fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-align-center</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-align-justify fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-align-justify</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-align-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-align-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-align-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-align-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-alipay fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-alipay</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-allergies fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-allergies</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-amazon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-amazon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-amazon-pay fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-amazon-pay</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ambulance fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ambulance</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i
                                class="fas fa-american-sign-language-interpreting fa-2x"
                                aria-hidden="true"
                            ></i>
                            <span class="icon-name">fa-american-sign-language-interpreting</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-amilia fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-amilia</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-anchor fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-anchor</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-android fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-android</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-angellist fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angellist</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-angle-double-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angle-double-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-angle-double-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angle-double-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-angle-double-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angle-double-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-angle-double-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angle-double-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-angle-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angle-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-angle-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angle-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-angle-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angle-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-angle-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angle-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-angry fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angry</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-angrycreative fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angrycreative</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-angular fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-angular</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ankh fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ankh</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-app-store fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-app-store</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-app-store-ios fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-app-store-ios</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-apper fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-apper</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-apple fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-apple</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-apple-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-apple-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-apple-pay fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-apple-pay</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-archive fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-archive</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-archway fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-archway</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-alt-circle-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-alt-circle-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-alt-circle-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-alt-circle-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-alt-circle-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-alt-circle-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-alt-circle-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-alt-circle-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-circle-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-circle-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-circle-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-circle-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-circle-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-circle-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-circle-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-circle-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrow-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrow-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrows-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrows-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrows-alt-h fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrows-alt-h</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-arrows-alt-v fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-arrows-alt-v</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-artstation fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-artstation</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-assistive-listening-systems fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-assistive-listening-systems</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-asterisk fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-asterisk</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-asymmetrik fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-asymmetrik</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-at fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-at</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-atlas fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-atlas</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-atlassian fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-atlassian</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-atom fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-atom</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-audible fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-audible</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-audio-description fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-audio-description</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-autoprefixer fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-autoprefixer</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-avianex fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-avianex</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-aviato fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-aviato</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-award fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-award</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-aws fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-aws</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-baby fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-baby</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-baby-carriage fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-baby-carriage</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-backspace fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-backspace</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-backward fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-backward</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bacon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bacon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-balance-scale fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-balance-scale</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ban fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ban</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-band-aid fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-band-aid</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-bandcamp fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bandcamp</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-barcode fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-barcode</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bars fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bars</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-baseball-ball fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-baseball-ball</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-basketball-ball fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-basketball-ball</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bath fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bath</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-battery-empty fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-battery-empty</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-battery-full fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-battery-full</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-battery-half fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-battery-half</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-battery-quarter fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-battery-quarter</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-battery-three-quarters fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-battery-three-quarters</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-battle-net fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-battle-net</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bed fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bed</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-beer fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-beer</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-behance fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-behance</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-behance-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-behance-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bell fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bell</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bell-slash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bell-slash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bezier-curve fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bezier-curve</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bible fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bible</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bicycle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bicycle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-bimobject fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bimobject</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-binoculars fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-binoculars</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-biohazard fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-biohazard</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-birthday-cake fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-birthday-cake</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-bitbucket fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bitbucket</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-bitcoin fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bitcoin</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-bity fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bity</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-black-tie fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-black-tie</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-blackberry fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-blackberry</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-blender fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-blender</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-blender-phone fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-blender-phone</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-blind fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-blind</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-blog fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-blog</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-blogger fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-blogger</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-blogger-b fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-blogger-b</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-bluetooth fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bluetooth</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-bluetooth-b fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bluetooth-b</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bold fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bold</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bolt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bolt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bomb fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bomb</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bone fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bone</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bong fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bong</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-book fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-book</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-book-dead fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-book-dead</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-book-medical fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-book-medical</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-book-open fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-book-open</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-book-reader fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-book-reader</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bookmark fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bookmark</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-bootstrap fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bootstrap</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bowling-ball fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bowling-ball</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-box fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-box</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-box-open fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-box-open</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-boxes fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-boxes</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-braille fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-braille</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-brain fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-brain</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bread-slice fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bread-slice</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-briefcase fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-briefcase</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-briefcase-medical fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-briefcase-medical</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-broadcast-tower fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-broadcast-tower</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-broom fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-broom</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-brush fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-brush</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-btc fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-btc</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-buffer fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-buffer</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bug fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bug</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-building fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-building</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bullhorn fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bullhorn</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bullseye fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bullseye</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-burn fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-burn</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-buromobelexperte fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-buromobelexperte</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-bus-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-bus-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-business-time fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-business-time</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-buysellads fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-buysellads</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-calculator fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-calculator</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-calendar fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-calendar</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-calendar-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-calendar-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-calendar-check fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-calendar-check</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-calendar-day fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-calendar-day</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-calendar-minus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-calendar-minus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-calendar-plus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-calendar-plus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-calendar-times fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-calendar-times</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-calendar-week fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-calendar-week</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-camera fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-camera</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-camera-retro fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-camera-retro</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-campground fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-campground</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-canadian-maple-leaf fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-canadian-maple-leaf</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-candy-cane fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-candy-cane</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cannabis fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cannabis</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-capsules fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-capsules</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-car fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-car</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-car-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-car-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-car-battery fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-car-battery</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-car-crash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-car-crash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-car-side fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-car-side</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-caret-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-caret-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-caret-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-caret-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-caret-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-caret-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-caret-square-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-caret-square-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-caret-square-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-caret-square-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-caret-square-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-caret-square-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-caret-square-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-caret-square-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-caret-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-caret-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-carrot fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-carrot</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cart-arrow-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cart-arrow-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cart-plus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cart-plus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cash-register fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cash-register</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cat fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cat</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cc-amazon-pay fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cc-amazon-pay</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cc-amex fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cc-amex</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cc-apple-pay fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cc-apple-pay</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cc-diners-club fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cc-diners-club</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cc-discover fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cc-discover</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cc-jcb fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cc-jcb</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cc-mastercard fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cc-mastercard</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cc-paypal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cc-paypal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cc-stripe fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cc-stripe</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cc-visa fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cc-visa</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-centercode fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-centercode</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-centos fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-centos</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-certificate fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-certificate</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chair fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chair</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chalkboard fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chalkboard</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chalkboard-teacher fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chalkboard-teacher</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-charging-station fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-charging-station</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chart-area fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chart-area</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chart-bar fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chart-bar</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chart-line fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chart-line</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chart-pie fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chart-pie</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-check fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-check</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-check-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-check-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-check-double fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-check-double</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-check-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-check-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cheese fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cheese</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chess fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chess</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chess-bishop fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chess-bishop</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chess-board fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chess-board</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chess-king fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chess-king</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chess-knight fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chess-knight</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chess-pawn fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chess-pawn</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chess-queen fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chess-queen</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chess-rook fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chess-rook</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chevron-circle-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chevron-circle-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chevron-circle-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chevron-circle-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chevron-circle-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chevron-circle-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chevron-circle-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chevron-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chevron-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chevron-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chevron-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chevron-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chevron-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-chevron-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chevron-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-child fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-child</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-chrome fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chrome</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-chromecast fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-chromecast</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-church fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-church</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-circle-notch fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-circle-notch</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-city fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-city</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-clinic-medical fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-clinic-medical</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-clipboard fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-clipboard</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-clipboard-check fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-clipboard-check</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-clipboard-list fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-clipboard-list</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-clock fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-clock</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-clone fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-clone</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-closed-captioning fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-closed-captioning</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cloud fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloud</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cloud-download-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloud-download-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cloud-meatball fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloud-meatball</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cloud-moon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloud-moon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cloud-moon-rain fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloud-moon-rain</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cloud-rain fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloud-rain</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cloud-showers-heavy fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloud-showers-heavy</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cloud-sun fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloud-sun</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cloud-sun-rain fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloud-sun-rain</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cloud-upload-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloud-upload-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cloudscale fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloudscale</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cloudsmith fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloudsmith</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cloudversify fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cloudversify</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cocktail fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cocktail</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-code fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-code</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-code-branch fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-code-branch</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-codepen fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-codepen</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-codiepie fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-codiepie</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-coffee fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-coffee</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cog fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cog</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cogs fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cogs</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-coins fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-coins</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-columns fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-columns</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-comment fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-comment</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-comment-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-comment-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-comment-dollar fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-comment-dollar</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-comment-dots fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-comment-dots</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-comment-medical fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-comment-medical</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-comment-slash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-comment-slash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-comments fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-comments</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-comments-dollar fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-comments-dollar</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-compact-disc fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-compact-disc</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-compass fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-compass</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-compress fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-compress</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-compress-arrows-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-compress-arrows-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-concierge-bell fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-concierge-bell</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-confluence fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-confluence</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-connectdevelop fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-connectdevelop</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-contao fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-contao</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cookie fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cookie</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cookie-bite fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cookie-bite</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-copy fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-copy</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-copyright fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-copyright</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-couch fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-couch</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cpanel fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cpanel</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-by fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-by</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-nc fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-nc</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-nc-eu fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-nc-eu</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-nc-jp fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-nc-jp</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-nd fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-nd</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-pd fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-pd</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-pd-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-pd-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-remix fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-remix</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-sa fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-sa</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-sampling fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-sampling</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i
                                class="fab fa-creative-commons-sampling-plus fa-2x"
                                aria-hidden="true"
                            ></i>
                            <span class="icon-name">fa-creative-commons-sampling-plus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-share fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-share</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-creative-commons-zero fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-creative-commons-zero</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-credit-card fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-credit-card</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-critical-role fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-critical-role</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-crop fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-crop</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-crop-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-crop-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cross fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cross</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-crosshairs fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-crosshairs</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-crow fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-crow</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-crown fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-crown</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-crutch fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-crutch</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-css3 fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-css3</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-css3-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-css3-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cube fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cube</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cubes fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cubes</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-cut fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cut</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-cuttlefish fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-cuttlefish</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-d-and-d fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-d-and-d</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-d-and-d-beyond fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-d-and-d-beyond</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-dashcube fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dashcube</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-database fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-database</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-deaf fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-deaf</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-delicious fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-delicious</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-democrat fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-democrat</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-deploydog fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-deploydog</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-deskpro fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-deskpro</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-desktop fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-desktop</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-dev fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dev</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-deviantart fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-deviantart</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dharmachakra fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dharmachakra</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-dhl fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dhl</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-diagnoses fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-diagnoses</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-diaspora fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-diaspora</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dice fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dice</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dice-d20 fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dice-d20</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dice-d6 fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dice-d6</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dice-five fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dice-five</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dice-four fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dice-four</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dice-one fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dice-one</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dice-six fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dice-six</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dice-three fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dice-three</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dice-two fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dice-two</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-digg fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-digg</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-digital-ocean fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-digital-ocean</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-digital-tachograph fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-digital-tachograph</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-directions fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-directions</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-discord fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-discord</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-discourse fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-discourse</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-divide fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-divide</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dizzy fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dizzy</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dna fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dna</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-dochub fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dochub</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-docker fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-docker</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dog fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dog</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dollar-sign fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dollar-sign</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dolly fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dolly</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dolly-flatbed fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dolly-flatbed</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-donate fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-donate</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-door-closed fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-door-closed</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-door-open fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-door-open</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dot-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dot-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dove fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dove</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-download fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-download</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-draft2digital fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-draft2digital</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-drafting-compass fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-drafting-compass</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dragon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dragon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-draw-polygon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-draw-polygon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-dribbble fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dribbble</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-dribbble-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dribbble-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-dropbox fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dropbox</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-drum fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-drum</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-drum-steelpan fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-drum-steelpan</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-drumstick-bite fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-drumstick-bite</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-drupal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-drupal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dumbbell fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dumbbell</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dumpster fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dumpster</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dumpster-fire fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dumpster-fire</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-dungeon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dungeon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-dyalog fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-dyalog</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-earlybirds fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-earlybirds</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-ebay fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ebay</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-edge fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-edge</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-edit fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-edit</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-egg fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-egg</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-eject fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-eject</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-elementor fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-elementor</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ellipsis-h fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ellipsis-h</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ellipsis-v fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ellipsis-v</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-ello fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ello</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-ember fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ember</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-empire fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-empire</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-envelope fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-envelope</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-envelope-open fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-envelope-open</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-envelope-open-text fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-envelope-open-text</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-envelope-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-envelope-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-envira fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-envira</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-equals fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-equals</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-eraser fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-eraser</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-erlang fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-erlang</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-ethereum fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ethereum</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ethernet fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ethernet</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-etsy fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-etsy</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-euro-sign fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-euro-sign</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-evernote fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-evernote</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-exchange-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-exchange-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-exclamation fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-exclamation</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-exclamation-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-exclamation-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-exclamation-triangle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-expand fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-expand</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-expand-arrows-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-expand-arrows-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-expeditedssl fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-expeditedssl</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-external-link-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-external-link-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-external-link-square-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-external-link-square-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-eye fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-eye</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-eye-dropper fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-eye-dropper</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-eye-slash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-eye-slash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-facebook fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-facebook</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-facebook-f fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-facebook-f</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-facebook-messenger fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-facebook-messenger</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-facebook-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-facebook-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-fantasy-flight-games fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fantasy-flight-games</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fast-backward fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fast-backward</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fast-forward fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fast-forward</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fax fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fax</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-feather fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-feather</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-feather-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-feather-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-fedex fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fedex</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-fedora fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fedora</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-female fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-female</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fighter-jet fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fighter-jet</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-figma fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-figma</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-archive fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-archive</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-audio fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-audio</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-code fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-code</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-contract fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-contract</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-csv fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-csv</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-download fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-download</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-excel fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-excel</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-export fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-export</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-image fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-image</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-import fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-import</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-invoice fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-invoice</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-invoice-dollar fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-invoice-dollar</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-medical fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-medical</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-medical-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-medical-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-pdf fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-pdf</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-powerpoint fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-powerpoint</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-prescription fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-prescription</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-signature fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-signature</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-upload fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-upload</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-video fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-video</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-file-word fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-file-word</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fill fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fill</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fill-drip fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fill-drip</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-film fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-film</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-filter fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-filter</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fingerprint fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fingerprint</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fire fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fire</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fire-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fire-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fire-extinguisher fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fire-extinguisher</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-firefox fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-firefox</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-first-aid fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-first-aid</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-first-order fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-first-order</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-first-order-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-first-order-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-firstdraft fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-firstdraft</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fish fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fish</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-fist-raised fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fist-raised</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-flag fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-flag</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-flag-checkered fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-flag-checkered</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-flag-usa fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-flag-usa</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-flask fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-flask</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-flickr fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-flickr</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-flipboard fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-flipboard</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-flushed fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-flushed</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-fly fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fly</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-folder fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-folder</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-folder-minus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-folder-minus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-folder-open fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-folder-open</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-folder-plus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-folder-plus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-font fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-font</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-font-awesome fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-font-awesome</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-font-awesome-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-font-awesome-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-font-awesome-flag fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-font-awesome-flag</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-font-awesome-logo-full fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-font-awesome-logo-full</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-fonticons fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fonticons</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-fonticons-fi fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fonticons-fi</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-football-ball fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-football-ball</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-fort-awesome fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fort-awesome</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-fort-awesome-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fort-awesome-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-forumbee fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-forumbee</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-forward fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-forward</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-foursquare fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-foursquare</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-free-code-camp fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-free-code-camp</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-freebsd fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-freebsd</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-frog fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-frog</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-frown fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-frown</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-frown-open fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-frown-open</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-fulcrum fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-fulcrum</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-funnel-dollar fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-funnel-dollar</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-futbol fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-futbol</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-galactic-republic fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-galactic-republic</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-galactic-senate fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-galactic-senate</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-gamepad fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gamepad</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-gas-pump fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gas-pump</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-gavel fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gavel</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-gem fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gem</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-genderless fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-genderless</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-get-pocket fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-get-pocket</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-gg fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gg</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-gg-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gg-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ghost fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ghost</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-gift fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gift</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-gifts fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gifts</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-git fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-git</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-git-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-git-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-git-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-git-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-github fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-github</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-github-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-github-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-github-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-github-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-gitkraken fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gitkraken</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-gitlab fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gitlab</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-gitter fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gitter</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-glass-cheers fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-glass-cheers</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-glass-martini fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-glass-martini</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-glass-martini-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-glass-martini-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-glass-whiskey fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-glass-whiskey</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-glasses fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-glasses</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-glide fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-glide</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-glide-g fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-glide-g</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-globe fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-globe</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-globe-africa fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-globe-africa</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-globe-americas fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-globe-americas</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-globe-asia fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-globe-asia</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-globe-europe fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-globe-europe</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-gofore fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gofore</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-golf-ball fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-golf-ball</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-goodreads fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-goodreads</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-goodreads-g fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-goodreads-g</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-google fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-google</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-google-drive fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-google-drive</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-google-play fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-google-play</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-google-plus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-google-plus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-google-plus-g fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-google-plus-g</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-google-plus-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-google-plus-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-google-wallet fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-google-wallet</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-gopuram fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gopuram</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-graduation-cap fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-graduation-cap</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-gratipay fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gratipay</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-grav fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grav</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-greater-than fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-greater-than</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-greater-than-equal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-greater-than-equal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grimace fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grimace</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-beam fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-beam</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-beam-sweat fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-beam-sweat</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-hearts fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-hearts</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-squint fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-squint</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-squint-tears fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-squint-tears</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-stars fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-stars</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-tears fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-tears</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-tongue fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-tongue</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-tongue-squint fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-tongue-squint</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-tongue-wink fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-tongue-wink</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grin-wink fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grin-wink</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grip-horizontal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grip-horizontal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grip-lines fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grip-lines</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grip-lines-vertical fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grip-lines-vertical</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-grip-vertical fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grip-vertical</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-gripfire fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gripfire</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-grunt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-grunt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-guitar fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-guitar</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-gulp fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-gulp</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-h-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-h-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-hacker-news fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hacker-news</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-hacker-news-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hacker-news-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-hackerrank fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hackerrank</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hamburger fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hamburger</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hammer fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hammer</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hamsa fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hamsa</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-holding fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-holding</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-holding-heart fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-holding-heart</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-holding-usd fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-holding-usd</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-lizard fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-lizard</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-middle-finger fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-middle-finger</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-paper fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-paper</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-peace fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-peace</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-point-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-point-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-point-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-point-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-point-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-point-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-point-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-point-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-pointer fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-pointer</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-rock fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-rock</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-scissors fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-scissors</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hand-spock fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hand-spock</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hands fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hands</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hands-helping fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hands-helping</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-handshake fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-handshake</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hanukiah fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hanukiah</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hard-hat fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hard-hat</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hashtag fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hashtag</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hat-wizard fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hat-wizard</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-haykal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-haykal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hdd fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hdd</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-heading fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-heading</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-headphones fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-headphones</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-headphones-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-headphones-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-headset fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-headset</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-heart fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-heart</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-heart-broken fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-heart-broken</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-heartbeat fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-heartbeat</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-helicopter fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-helicopter</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-highlighter fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-highlighter</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hiking fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hiking</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hippo fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hippo</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-hips fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hips</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-hire-a-helper fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hire-a-helper</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-history fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-history</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hockey-puck fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hockey-puck</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-holly-berry fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-holly-berry</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-home fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-home</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-hooli fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hooli</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-hornbill fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hornbill</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-horse fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-horse</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-horse-head fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-horse-head</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hospital fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hospital</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hospital-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hospital-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hospital-symbol fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hospital-symbol</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hot-tub fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hot-tub</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hotdog fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hotdog</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hotel fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hotel</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-hotjar fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hotjar</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hourglass fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hourglass</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hourglass-end fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hourglass-end</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hourglass-half fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hourglass-half</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hourglass-start fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hourglass-start</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-house-damage fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-house-damage</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-houzz fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-houzz</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-hryvnia fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hryvnia</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-html5 fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-html5</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-hubspot fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-hubspot</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-i-cursor fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-i-cursor</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ice-cream fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ice-cream</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-icicles fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-icicles</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-id-badge fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-id-badge</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-id-card fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-id-card</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-id-card-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-id-card-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-igloo fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-igloo</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-image fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-image</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-images fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-images</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-imdb fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-imdb</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-inbox fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-inbox</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-indent fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-indent</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-industry fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-industry</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-infinity fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-infinity</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-info fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-info</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-info-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-info-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-instagram fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-instagram</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-intercom fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-intercom</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-internet-explorer fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-internet-explorer</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-invision fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-invision</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-ioxhost fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ioxhost</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-italic fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-italic</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-itch-io fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-itch-io</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-itunes fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-itunes</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-itunes-note fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-itunes-note</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-java fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-java</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-jedi fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-jedi</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-jedi-order fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-jedi-order</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-jenkins fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-jenkins</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-jira fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-jira</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-joget fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-joget</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-joint fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-joint</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-joomla fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-joomla</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-journal-whills fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-journal-whills</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-js fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-js</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-js-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-js-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-jsfiddle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-jsfiddle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-kaaba fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-kaaba</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-kaggle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-kaggle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-key fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-key</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-keybase fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-keybase</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-keyboard fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-keyboard</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-keycdn fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-keycdn</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-khanda fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-khanda</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-kickstarter fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-kickstarter</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-kickstarter-k fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-kickstarter-k</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-kiss fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-kiss</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-kiss-beam fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-kiss-beam</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-kiss-wink-heart fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-kiss-wink-heart</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-kiwi-bird fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-kiwi-bird</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-korvue fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-korvue</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-landmark fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-landmark</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-language fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-language</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-laptop fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-laptop</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-laptop-code fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-laptop-code</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-laptop-medical fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-laptop-medical</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-laravel fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-laravel</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-lastfm fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-lastfm</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-lastfm-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-lastfm-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-laugh fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-laugh</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-laugh-beam fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-laugh-beam</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-laugh-squint fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-laugh-squint</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-laugh-wink fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-laugh-wink</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-layer-group fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-layer-group</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-leaf fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-leaf</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-leanpub fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-leanpub</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-lemon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-lemon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-less fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-less</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-less-than fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-less-than</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-less-than-equal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-less-than-equal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-level-down-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-level-down-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-level-up-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-level-up-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-life-ring fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-life-ring</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-lightbulb fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-lightbulb</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-line fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-line</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-link fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-link</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-linkedin fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-linkedin</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-linkedin-in fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-linkedin-in</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-linode fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-linode</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-linux fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-linux</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-lira-sign fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-lira-sign</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-list fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-list</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-list-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-list-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-list-ol fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-list-ol</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-list-ul fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-list-ul</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-location-arrow fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-location-arrow</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-lock fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-lock</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-lock-open fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-lock-open</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-long-arrow-alt-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-long-arrow-alt-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-long-arrow-alt-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-long-arrow-alt-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-long-arrow-alt-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-long-arrow-alt-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-long-arrow-alt-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-long-arrow-alt-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-low-vision fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-low-vision</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-luggage-cart fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-luggage-cart</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-lyft fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-lyft</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-magento fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-magento</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-magic fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-magic</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-magnet fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-magnet</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mail-bulk fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mail-bulk</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-mailchimp fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mailchimp</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-male fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-male</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-mandalorian fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mandalorian</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-map fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-map</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-map-marked fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-map-marked</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-map-marked-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-map-marked-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-map-marker fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-map-marker</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-map-marker-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-map-marker-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-map-pin fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-map-pin</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-map-signs fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-map-signs</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-markdown fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-markdown</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-marker fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-marker</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mars fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mars</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mars-double fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mars-double</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mars-stroke fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mars-stroke</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mars-stroke-h fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mars-stroke-h</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mars-stroke-v fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mars-stroke-v</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mask fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mask</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-mastodon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mastodon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-maxcdn fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-maxcdn</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-medal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-medal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-medapps fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-medapps</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-medium fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-medium</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-medium-m fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-medium-m</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-medkit fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-medkit</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-medrt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-medrt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-meetup fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-meetup</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-megaport fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-megaport</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-meh fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-meh</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-meh-blank fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-meh-blank</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-meh-rolling-eyes fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-meh-rolling-eyes</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-memory fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-memory</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-mendeley fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mendeley</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-menorah fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-menorah</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mercury fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mercury</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-meteor fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-meteor</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-microchip fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-microchip</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-microphone fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-microphone</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-microphone-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-microphone-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-microphone-alt-slash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-microphone-alt-slash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-microphone-slash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-microphone-slash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-microscope fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-microscope</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-microsoft fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-microsoft</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-minus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-minus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-minus-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-minus-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-minus-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-minus-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mitten fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mitten</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-mix fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mix</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-mixcloud fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mixcloud</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-mizuni fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mizuni</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mobile fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mobile</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mobile-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mobile-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-modx fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-modx</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-monero fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-monero</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-money-bill fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-money-bill</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-money-bill-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-money-bill-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-money-bill-wave fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-money-bill-wave</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-money-bill-wave-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-money-bill-wave-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-money-check fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-money-check</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-money-check-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-money-check-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-monument fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-monument</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-moon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-moon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mortar-pestle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mortar-pestle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mosque fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mosque</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-motorcycle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-motorcycle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mountain fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mountain</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mouse-pointer fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mouse-pointer</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-mug-hot fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-mug-hot</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-music fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-music</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-napster fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-napster</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-neos fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-neos</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-network-wired fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-network-wired</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-neuter fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-neuter</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-newspaper fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-newspaper</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-nimblr fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-nimblr</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-nintendo-switch fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-nintendo-switch</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-node fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-node</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-node-js fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-node-js</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-not-equal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-not-equal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-notes-medical fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-notes-medical</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-npm fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-npm</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-ns8 fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ns8</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-nutritionix fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-nutritionix</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-object-group fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-object-group</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-object-ungroup fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-object-ungroup</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-odnoklassniki fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-odnoklassniki</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-odnoklassniki-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-odnoklassniki-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-oil-can fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-oil-can</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-old-republic fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-old-republic</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-om fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-om</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-opencart fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-opencart</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-openid fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-openid</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-opera fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-opera</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-optin-monster fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-optin-monster</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-osi fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-osi</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-otter fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-otter</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-outdent fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-outdent</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-page4 fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-page4</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-pagelines fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pagelines</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pager fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pager</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-paint-brush fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-paint-brush</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-paint-roller fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-paint-roller</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-palette fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-palette</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-palfed fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-palfed</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pallet fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pallet</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-paper-plane fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-paper-plane</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-paperclip fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-paperclip</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-parachute-box fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-parachute-box</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-paragraph fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-paragraph</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-parking fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-parking</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-passport fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-passport</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pastafarianism fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pastafarianism</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-paste fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-paste</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-patreon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-patreon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pause fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pause</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pause-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pause-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-paw fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-paw</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-paypal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-paypal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-peace fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-peace</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pen fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pen</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pen-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pen-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pen-fancy fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pen-fancy</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pen-nib fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pen-nib</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pen-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pen-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pencil-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pencil-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pencil-ruler fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pencil-ruler</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-penny-arcade fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-penny-arcade</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-people-carry fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-people-carry</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pepper-hot fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pepper-hot</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-percent fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-percent</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-percentage fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-percentage</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-periscope fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-periscope</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-person-booth fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-person-booth</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-phabricator fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-phabricator</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-phoenix-framework fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-phoenix-framework</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-phoenix-squadron fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-phoenix-squadron</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-phone fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-phone</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-phone-slash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-phone-slash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-phone-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-phone-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-phone-volume fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-phone-volume</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-php fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-php</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-pied-piper fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pied-piper</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-pied-piper-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pied-piper-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-pied-piper-hat fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pied-piper-hat</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-pied-piper-pp fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pied-piper-pp</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-piggy-bank fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-piggy-bank</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pills fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pills</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-pinterest fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pinterest</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-pinterest-p fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pinterest-p</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-pinterest-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pinterest-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pizza-slice fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pizza-slice</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-place-of-worship fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-place-of-worship</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-plane fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-plane</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-plane-arrival fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-plane-arrival</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-plane-departure fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-plane-departure</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-play fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-play</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-play-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-play-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-playstation fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-playstation</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-plug fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-plug</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-plus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-plus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-plus-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-plus-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-plus-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-plus-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-podcast fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-podcast</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-poll fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-poll</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-poll-h fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-poll-h</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-poo fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-poo</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-poo-storm fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-poo-storm</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-poop fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-poop</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-portrait fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-portrait</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pound-sign fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pound-sign</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-power-off fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-power-off</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-pray fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pray</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-praying-hands fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-praying-hands</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-prescription fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-prescription</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-prescription-bottle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-prescription-bottle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-prescription-bottle-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-prescription-bottle-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-print fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-print</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-procedures fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-procedures</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-product-hunt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-product-hunt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-project-diagram fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-project-diagram</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-pushed fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-pushed</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-puzzle-piece fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-puzzle-piece</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-python fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-python</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-qq fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-qq</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-qrcode fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-qrcode</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-question fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-question</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-question-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-question-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-quidditch fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-quidditch</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-quinscape fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-quinscape</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-quora fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-quora</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-quote-left fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-quote-left</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-quote-right fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-quote-right</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-quran fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-quran</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-r-project fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-r-project</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-radiation fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-radiation</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-radiation-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-radiation-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-rainbow fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-rainbow</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-random fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-random</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-raspberry-pi fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-raspberry-pi</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-ravelry fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ravelry</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-react fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-react</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-reacteurope fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-reacteurope</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-readme fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-readme</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-rebel fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-rebel</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-receipt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-receipt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-recycle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-recycle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-red-river fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-red-river</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-reddit fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-reddit</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-reddit-alien fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-reddit-alien</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-reddit-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-reddit-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-redhat fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-redhat</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-redo fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-redo</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-redo-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-redo-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-registered fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-registered</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-renren fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-renren</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-reply fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-reply</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-reply-all fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-reply-all</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-replyd fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-replyd</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-republican fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-republican</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-researchgate fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-researchgate</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-resolving fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-resolving</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-restroom fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-restroom</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-retweet fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-retweet</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-rev fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-rev</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ribbon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ribbon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ring fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ring</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-road fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-road</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-robot fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-robot</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-rocket fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-rocket</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-rocketchat fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-rocketchat</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-rockrms fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-rockrms</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-route fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-route</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-rss fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-rss</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-rss-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-rss-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ruble-sign fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ruble-sign</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ruler fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ruler</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ruler-combined fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ruler-combined</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ruler-horizontal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ruler-horizontal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ruler-vertical fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ruler-vertical</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-running fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-running</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-rupee-sign fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-rupee-sign</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sad-cry fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sad-cry</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sad-tear fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sad-tear</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-safari fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-safari</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-salesforce fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-salesforce</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-sass fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sass</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-satellite fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-satellite</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-satellite-dish fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-satellite-dish</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-save fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-save</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-schlix fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-schlix</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-school fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-school</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-screwdriver fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-screwdriver</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-scribd fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-scribd</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-scroll fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-scroll</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sd-card fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sd-card</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-search fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-search</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-search-dollar fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-search-dollar</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-search-location fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-search-location</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-search-minus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-search-minus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-search-plus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-search-plus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-searchengin fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-searchengin</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-seedling fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-seedling</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-sellcast fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sellcast</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-sellsy fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sellsy</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-server fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-server</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-servicestack fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-servicestack</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-shapes fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shapes</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-share fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-share</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-share-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-share-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-share-alt-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-share-alt-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-share-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-share-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-shekel-sign fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shekel-sign</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-shield-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shield-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ship fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ship</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-shipping-fast fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shipping-fast</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-shirtsinbulk fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shirtsinbulk</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-shoe-prints fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shoe-prints</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-shopping-bag fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shopping-bag</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-shopping-basket fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shopping-basket</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-shopping-cart fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shopping-cart</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-shopware fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shopware</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-shower fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shower</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-shuttle-van fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-shuttle-van</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sign fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sign</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sign-in-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sign-in-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sign-language fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sign-language</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sign-out-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sign-out-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-signal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-signal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-signature fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-signature</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sim-card fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sim-card</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-simplybuilt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-simplybuilt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-sistrix fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sistrix</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sitemap fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sitemap</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-sith fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sith</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-skating fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-skating</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-sketch fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sketch</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-skiing fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-skiing</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-skiing-nordic fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-skiing-nordic</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-skull fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-skull</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-skull-crossbones fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-skull-crossbones</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-skyatlas fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-skyatlas</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-skype fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-skype</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-slack fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-slack</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-slack-hash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-slack-hash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-slash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-slash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sleigh fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sleigh</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sliders-h fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sliders-h</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-slideshare fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-slideshare</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-smile fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-smile</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-smile-beam fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-smile-beam</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-smile-wink fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-smile-wink</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-smog fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-smog</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-smoking fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-smoking</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-smoking-ban fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-smoking-ban</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sms fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sms</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-snapchat fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-snapchat</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-snapchat-ghost fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-snapchat-ghost</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-snapchat-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-snapchat-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-snowboarding fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-snowboarding</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-snowflake fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-snowflake</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-snowman fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-snowman</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-snowplow fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-snowplow</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-socks fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-socks</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-solar-panel fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-solar-panel</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sort fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sort</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sort-alpha-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sort-alpha-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sort-alpha-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sort-alpha-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sort-amount-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sort-amount-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sort-amount-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sort-amount-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sort-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sort-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sort-numeric-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sort-numeric-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sort-numeric-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sort-numeric-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sort-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sort-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-soundcloud fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-soundcloud</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-sourcetree fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sourcetree</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-spa fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-spa</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-space-shuttle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-space-shuttle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-speakap fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-speakap</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-speaker-deck fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-speaker-deck</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-spider fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-spider</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-spinner fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-spinner</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-splotch fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-splotch</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-spotify fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-spotify</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-spray-can fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-spray-can</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-square-full fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-square-full</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-square-root-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-square-root-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-squarespace fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-squarespace</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-stack-exchange fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stack-exchange</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-stack-overflow fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stack-overflow</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-stackpath fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stackpath</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-stamp fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stamp</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-star fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-star</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-star-and-crescent fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-star-and-crescent</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-star-half fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-star-half</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-star-half-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-star-half-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-star-of-david fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-star-of-david</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-star-of-life fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-star-of-life</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-staylinked fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-staylinked</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-steam fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-steam</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-steam-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-steam-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-steam-symbol fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-steam-symbol</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-step-backward fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-step-backward</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-step-forward fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-step-forward</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-stethoscope fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stethoscope</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-sticker-mule fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sticker-mule</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sticky-note fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sticky-note</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-stop fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stop</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-stop-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stop-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-stopwatch fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stopwatch</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-store fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-store</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-store-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-store-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-strava fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-strava</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-stream fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stream</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-street-view fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-street-view</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-strikethrough fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-strikethrough</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-stripe fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stripe</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-stripe-s fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stripe-s</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-stroopwafel fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stroopwafel</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-studiovinari fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-studiovinari</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-stumbleupon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stumbleupon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-stumbleupon-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-stumbleupon-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-subscript fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-subscript</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-subway fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-subway</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-suitcase fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-suitcase</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-suitcase-rolling fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-suitcase-rolling</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sun fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sun</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-superpowers fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-superpowers</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-superscript fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-superscript</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-supple fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-supple</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-surprise fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-surprise</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-suse fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-suse</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-swatchbook fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-swatchbook</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-swimmer fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-swimmer</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-swimming-pool fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-swimming-pool</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-symfony fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-symfony</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-synagogue fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-synagogue</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sync fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sync</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-sync-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-sync-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-syringe fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-syringe</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-table fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-table</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-table-tennis fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-table-tennis</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tablet fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tablet</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tablet-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tablet-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tablets fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tablets</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tachometer-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tachometer-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tag fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tag</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tags fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tags</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tape fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tape</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tasks fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tasks</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-taxi fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-taxi</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-teamspeak fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-teamspeak</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-teeth fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-teeth</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-teeth-open fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-teeth-open</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-telegram fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-telegram</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-telegram-plane fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-telegram-plane</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-temperature-high fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-temperature-high</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-temperature-low fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-temperature-low</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-tencent-weibo fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tencent-weibo</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tenge fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tenge</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-terminal fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-terminal</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-text-height fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-text-height</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-text-width fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-text-width</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-th fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-th</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-th-large fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-th-large</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-th-list fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-th-list</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-the-red-yeti fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-the-red-yeti</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-theater-masks fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-theater-masks</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-themeco fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-themeco</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-themeisle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-themeisle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-thermometer fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-thermometer</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-thermometer-empty fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-thermometer-empty</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-thermometer-full fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-thermometer-full</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-thermometer-half fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-thermometer-half</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-thermometer-quarter fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-thermometer-quarter</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-thermometer-three-quarters fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-thermometer-three-quarters</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-think-peaks fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-think-peaks</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-thumbs-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-thumbs-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-thumbs-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-thumbs-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-thumbtack fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-thumbtack</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-ticket-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ticket-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-times fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-times</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-times-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-times-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tint fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tint</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tint-slash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tint-slash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tired fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tired</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-toggle-off fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-toggle-off</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-toggle-on fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-toggle-on</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-toilet fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-toilet</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-toilet-paper fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-toilet-paper</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-toolbox fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-toolbox</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tools fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tools</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tooth fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tooth</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-torah fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-torah</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-torii-gate fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-torii-gate</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tractor fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tractor</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-trade-federation fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-trade-federation</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-trademark fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-trademark</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-traffic-light fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-traffic-light</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-train fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-train</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tram fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tram</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-transgender fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-transgender</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-transgender-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-transgender-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-trash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-trash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-trash-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-trash-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-trash-restore fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-trash-restore</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-trash-restore-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-trash-restore-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tree fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tree</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-trello fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-trello</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-tripadvisor fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tripadvisor</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-trophy fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-trophy</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-truck fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-truck</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-truck-loading fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-truck-loading</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-truck-monster fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-truck-monster</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-truck-moving fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-truck-moving</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-truck-pickup fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-truck-pickup</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tshirt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tshirt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tty fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tty</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-tumblr fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tumblr</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-tumblr-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tumblr-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-tv fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-tv</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-twitch fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-twitch</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-twitter fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-twitter</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-twitter-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-twitter-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-typo3 fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-typo3</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-uber fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-uber</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-ubuntu fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ubuntu</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-uikit fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-uikit</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-umbrella fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-umbrella</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-umbrella-beach fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-umbrella-beach</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-underline fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-underline</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-undo fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-undo</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-undo-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-undo-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-uniregistry fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-uniregistry</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-universal-access fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-universal-access</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-university fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-university</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-unlink fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-unlink</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-unlock fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-unlock</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-unlock-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-unlock-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-untappd fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-untappd</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-upload fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-upload</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-ups fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ups</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-usb fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-usb</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-alt-slash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-alt-slash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-astronaut fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-astronaut</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-check fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-check</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-circle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-circle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-clock fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-clock</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-cog fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-cog</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-edit fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-edit</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-friends fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-friends</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-graduate fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-graduate</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-injured fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-injured</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-lock fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-lock</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-md fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-md</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-minus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-minus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-ninja fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-ninja</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-nurse fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-nurse</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-plus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-plus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-secret fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-secret</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-shield fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-shield</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-slash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-slash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-tag fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-tag</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-tie fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-tie</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-user-times fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-user-times</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-users fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-users</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-users-cog fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-users-cog</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-usps fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-usps</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-ussunnah fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-ussunnah</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-utensil-spoon fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-utensil-spoon</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-utensils fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-utensils</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-vaadin fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vaadin</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-vector-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vector-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-venus fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-venus</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-venus-double fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-venus-double</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-venus-mars fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-venus-mars</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-viacoin fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-viacoin</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-viadeo fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-viadeo</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-viadeo-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-viadeo-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-vial fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vial</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-vials fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vials</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-viber fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-viber</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-video fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-video</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-video-slash fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-video-slash</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-vihara fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vihara</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-vimeo fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vimeo</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-vimeo-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vimeo-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-vimeo-v fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vimeo-v</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-vine fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vine</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-vk fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vk</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-vnv fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vnv</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-volleyball-ball fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-volleyball-ball</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-volume-down fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-volume-down</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-volume-mute fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-volume-mute</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-volume-off fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-volume-off</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-volume-up fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-volume-up</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-vote-yea fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vote-yea</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-vr-cardboard fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vr-cardboard</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-vuejs fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-vuejs</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-walking fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-walking</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-wallet fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wallet</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-warehouse fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-warehouse</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-water fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-water</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-wave-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wave-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-waze fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-waze</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-weebly fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-weebly</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-weibo fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-weibo</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-weight fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-weight</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-weight-hanging fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-weight-hanging</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-weixin fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-weixin</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-whatsapp fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-whatsapp</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-whatsapp-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-whatsapp-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-wheelchair fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wheelchair</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-whmcs fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-whmcs</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-wifi fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wifi</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-wikipedia-w fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wikipedia-w</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-wind fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wind</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-window-close fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-window-close</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-window-maximize fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-window-maximize</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-window-minimize fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-window-minimize</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-window-restore fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-window-restore</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-windows fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-windows</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-wine-bottle fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wine-bottle</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-wine-glass fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wine-glass</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-wine-glass-alt fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wine-glass-alt</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-wix fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wix</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-wizards-of-the-coast fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wizards-of-the-coast</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-wolf-pack-battalion fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wolf-pack-battalion</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-won-sign fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-won-sign</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-wordpress fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wordpress</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-wordpress-simple fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wordpress-simple</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-wpbeginner fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wpbeginner</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-wpexplorer fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wpexplorer</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-wpforms fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wpforms</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-wpressr fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wpressr</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-wrench fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-wrench</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-x-ray fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-x-ray</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-xbox fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-xbox</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-xing fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-xing</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-xing-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-xing-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-y-combinator fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-y-combinator</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-yahoo fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-yahoo</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-yammer fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-yammer</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-yandex fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-yandex</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-yandex-international fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-yandex-international</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-yarn fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-yarn</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-yelp fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-yelp</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-yen-sign fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-yen-sign</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fas fa-yin-yang fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-yin-yang</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-yoast fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-yoast</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-youtube fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-youtube</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-youtube-square fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-youtube-square</span>
                        </span>
                    </li>
                    <li>
                        <span
                            @dblclick="selectIcon($event, true)"
                            @click="selectIcon($event, false)"
                        >
                            <i class="fab fa-zhihu fa-2x" aria-hidden="true"></i>
                            <span class="icon-name">fa-zhihu</span>
                        </span>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    name: "iconForm",
    data() {
        return {};
    },
    mounted() {},
    methods: {
        selectIcon(event, dbclick) {
            this.$emit("selectMenuIcon", {
                icon: event.currentTarget.firstElementChild.className,
                dbclick: dbclick
            });
            let activeEl = document.querySelectorAll(".icon_active");
            if (typeof activeEl[0] != "undefined") {
                activeEl[0].className = "";
            }
            event.currentTarget.parentElement.className += "icon_active";
        }
    }
};
</script>
<style rel="stylesheet/scss" lang="scss" scoped>
</style>
<style >
/* ul.the-icons {
    padding: 0;
}
ul.the-icons li {
    border: 1px dashed white;
    width: 200px;
    display: inline-block;
    cursor: pointer;
    padding: 2px 5px;
    line-height: 30px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
ul.the-icons li:hover {
    background-color: #fbf4f4;
}
ul.the-icons li:hover [class^="fa fa-"]::before,
.the-icons li:hover [class*=" fa fa-"]::before {
    font-size: 28px;
    vertical-align: -5px;
}
ul.the-icons li i {
    width: 30px;
    display: inline-block;
}
ul.the-icons li.on {
    border-color: gray;
} */
ul.the-icons li {
    float: left;
    width: 10.66%;
    text-align: center;
    height: 120px;
    line-height: 120px;
    color: #666;
    font-size: 13px;
    border-right: 1px solid #eee;
    border-bottom: 1px solid #eee;
    display: list-item;
    cursor: pointer;
}
ul.the-icons li:hover {
    background-color: #eee;
}
ul.the-icons li span {
    line-height: normal;
    font-family: Helvetica Neue, Helvetica, PingFang SC, Hiragino Sans GB,
        Microsoft YaHei, SimSun, sans-serif;
    color: #99a9bf;
    transition: color 0.15s linear;
    display: inline-block;
    vertical-align: middle;
}
ul.the-icons li span i {
    display: block;
    font-size: 32px;
    margin-bottom: 15px;
    color: #606266;
    transition: color 0.15s linear;
    text-align: center;
}
ul.the-icons li span span {
    display: inline-block;
    padding: 0 3px;
    height: 1em;
    vertical-align: middle;
    word-break: break-all;
    white-space: normal;
    width: 95%;
}
.icon_active {
    background-color: #ddd;
}
</style>
