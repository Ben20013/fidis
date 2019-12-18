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
<template lang="html">
  <div class="login-box">
    <div class="header flex-wrap">
      <div class="logo">
        <img v-if="logoPath!=''" :src="logoPath" alt="">
        <!-- <img v-else src="modules/pro/static/images/login/logo.png" alt=""> -->
      </div>
    </div>
    <div class="middle-content">
      <div class="tree-container" id="threeBackground"></div>
      <div class="login-container flex-wrap">
        <div class="content flex-wrap">
          <div class="left-content">
            <div class="pc-icon"></div>
            <div class="news-title">
              MIXPRO <span>{{version}}</span> {{$t('loginLang.new_online')}}
            </div>
            <div class="news-desc">
              {{$t('loginLang.new_desc')}}
            </div>
          </div>
          <div class="right-content" @keyup.enter="login()">
            <div class="title-wrap">
              <span>MIXPRO</span> {{$t('loginLang.account_login')}}
            </div>
            <div class="error-wrap" :class="{'hide':!isError}">
              <div class="err-tip">
                <i class="err-icon"></i>
                <span class="err-txt">{{errorTip}}</span>
              </div>
            </div>
            <div class="username-wrap" :class="{'is-error':isError}">
              <input type="text" name="username" value="" :placeholder="$t('loginLang.placeholder_user')" :class="{'active':username!=''}" v-model="username" autofocus="autofocus">
            </div>
            <div class="password-wrap">
              <input type="password" name="password" value="" :placeholder="$t('loginLang.placeholder_passwd')" :class="{'active':password!=''}" v-model="password">
            </div>
            <div class="button-wrap flex-wrap">
              <div class="btn-container flex-wrap">
                <a class="login-btn"  @click="login()">{{$t('loginLang.login')}}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p class="copyright-text" v-if="copyright!=''" v-html="copyright">{{$t('loginLang.copy_right')}}</p>
    </div>
  </div>
</template>

<script>
import login from "@/assets/js/fetch/login";
import settingApi from "@/assets/js/fetch/setting";
import config from "$config";
import * as THREE from "three";
export default {
    name: "login",
    data() {
        return {
            version: config.pro_version,
            pichost: config.apiq.pictureAddress,
            copyright: "",
            logoPath: "",
            aboutInfoData: null,
            username: "",
            password: "",
            errorTip: this.$t("loginLang.user_or_pwd_err"),
            isError: false
        };
    },
    created() {
        this.password = "";
    },
    mounted() {
        this.getAboutUs();
        // this.initThreeBackground();
    },
    methods: {
        getAboutUs() {
            let self = this;
            settingApi.get_config(function(data) {
                if (data.code == 200) {
                    let result = data.result;
                    if (result["common"]) {
                        let common = result["common"];
                        document.querySelector("title").innerHTML = common[
                            "website_title"
                        ]
                            ? common["website_title"]
                            : "MIXPRO";
                        self.copyright = common["copyright"]
                            ? common["copyright"]
                            : "";
                        self.logoPath = common["logo_path"]
                            ? common["logo_path"]
                            : "";
                        if (common["icon_path"]) {
                            var link =
                                document.querySelector("link[rel*='icon']") ||
                                document.createElement("link");
                            link.type = "image/x-icon";
                            link.rel = "shortcut icon";
                            link.href = common["icon_path"];
                            document
                                .getElementsByTagName("head")[0]
                                .appendChild(link);
                        }
                    }
                }
            }, {});
        },
        login() {
            if (this.username == "" || !this.username) {
                this.errorTip = this.$t("loginLang.user_name_not_null");
                this.isError = true;
                return;
            }
            if (this.password == "" || !this.password) {
                this.errorTip = this.$t("loginLang.password_not_null");
                this.isError = true;
                return;
            }
            if (this.isError) {
                this.isError = false;
            }
            let self = this;
            login.login(
                function(data) {
                    if (data.code == 200) {
                        localStorage.setItem("loginState", 1);
                        let user = JSON.stringify(data.result.data);
                        localStorage.setItem("user", user);
                        self.$router.push("/index");
                    } else {
                        self.isError = true;
                        self.errorTip = data.msg;
                    }
                },
                {
                    username: self.username,
                    password: self.password,
                    system: config.system
                }
            );
        },
        initThreeBackground() {
            var container = document.getElementById("threeBackground");
            if (!container) {
                console.log("no container");
                return;
            }

            var scene = null;
            var camera = null;
            var renderer = null;
            var uniforms = null;
            var vertexHeight = 15000;
            var planeDefinition = 200;
            var planeSize = 1245000;
            var totalObjects = 50000;
            var frame = 0;
            var vertexShaderCodeContent = `
        uniform float time;
        varying vec3 vNormal;
        void main(void) {
           vec3 v = position;
           vNormal = normal;
           v.z += cos(2.0 * position.x + (time)) * 4085.5;
           gl_Position = projectionMatrix * modelViewMatrix * vec4(v, 1.0);
        }
      `;
            var fragmentShaderCodeContent = `
        varying vec3 vNormal;
        uniform float time;
        void main(void) {
            vec3 light = vec3(0.1, .9, .1);
            light = normalize(light);
            float dProd = max(0.2, dot(vNormal, light));
            gl_FragColor = vec4(0.25, // R
                              0.29, // G
                              0.35, // B
                              1.0);  // A
        }
      `;

            camera = new THREE.PerspectiveCamera(
                55,
                window.innerWidth / window.innerHeight,
                1,
                400000
            );
            camera.position.z = 550000;
            camera.position.y = 25000;
            camera.position.x = 10000;
            camera.lookAt(new THREE.Vector3(0, 6000, 0));

            scene = new THREE.Scene();
            scene.fog = new THREE.Fog(0x263252, 1, 300000);

            uniforms = {
                time: { type: "f", value: 0.0 }
            };

            let shadermaterial = new THREE.ShaderMaterial({
                uniforms: uniforms,
                vertexShader: vertexShaderCodeContent,
                fragmentShader: fragmentShaderCodeContent,
                wireframe: true,
                fog: false
            });

            let plane = new THREE.Mesh(
                new THREE.PlaneGeometry(
                    planeSize,
                    planeSize,
                    planeDefinition,
                    planeDefinition
                ),
                shadermaterial
            );
            plane.rotation.x -= Math.PI * 0.5;

            scene.add(plane);

            let geometry = new THREE.Geometry();

            for (let i = 0; i < totalObjects; i++) {
                let vertex = new THREE.Vector3();
                vertex.x = Math.random() * planeSize - planeSize * 0.5;
                vertex.y = Math.random() * 100000 + 10000;
                vertex.z = Math.random() * planeSize - planeSize * 0.5;
                geometry.vertices.push(vertex);
            }

            let particlebasicmaterial = new THREE.PointsMaterial({ size: 200 });
            let particles = new THREE.Points(geometry, particlebasicmaterial);

            scene.add(particles);

            renderer = new THREE.WebGLRenderer();
            renderer.setSize(container.offsetWidth, container.offsetHeight);
            renderer.setClearColor("#111e31", 1.0); //
            container.appendChild(renderer.domElement);

            render();
            function render() {
                requestAnimationFrame(render);
                camera.position.z -= 150;
                uniforms.time.value = frame;
                frame += 0.04;
                //  dateVerts();
                renderer.render(scene, camera);
                if (camera.position.z < 15000) {
                    camera.position.z = 550000;
                    uniforms.time.value = 0.0;
                }
            }
        }
    }
};
</script>
<style rel="stylesheet/scss" lang="scss">
.copyright-text {
    a {
        text-decoration: underline;
        color: #4162ff;
    }
}
</style>
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/login/login.scss";
</style>
