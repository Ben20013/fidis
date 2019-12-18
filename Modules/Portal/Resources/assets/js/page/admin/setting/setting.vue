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
	<div class="cont-view flex-column">
		<div class="cont-box">
			<div class="container flex-column">
				<!-- <div class="title-wrap">
					<span class="title">设置</span>
				</div> -->
				<div class="content-wrap flex-column">
					<div class="config">
						<div class="title">基本配置</div>
						<div class="config-content">
							<div class="row flex-wrap">
								<div class="name">平台名称：</div>
								<div class="value">
									<el-input placeholder="请输入" v-model="productName"></el-input>
								</div>
							</div>
							<div class="row flex-wrap">
								<div class="name">网站标题：</div>
								<div class="value">
									<el-input placeholder="请输入" v-model="websiteTitle"></el-input>
								</div>
							</div>
							<div class="row flex-wrap">
								<div class="name">广告标题：</div>
								<div class="value">
									<el-input placeholder="请输入0-14个字符" v-model="adTitle" maxlength="14"></el-input>
								</div>
							</div>
							<div class="row flex-wrap">
								<div class="name">广告语：</div>
								<div class="value">
									<el-input placeholder="请输入0-120个字符" v-model="adSlogan" maxlength="120"></el-input>
								</div>
							</div>
							<div class="row flex-wrap">
								<div class="name">版权信息：</div>
								<div class="value">
									<el-input placeholder="请输入0-100个字符" v-model="copyright" maxlength="100"></el-input>
								</div>
							</div>
							<div class="row flex-wrap">
								<div class="name">网站LOGO：</div>
								<div class="value">
									<div class="image-wrap">
										<img v-if="logoPath != ''" :src="logoPath" class="image__logo" alt="">
									</div>
								</div>
							</div>
							<div class="row flex-wrap tip">
								<div class="name"></div>
								<div class="value tip-txt">提示：图片尺寸：180 X 50</div>
							</div>
							<div class="row flex-wrap upload">
								<div class="name"></div>
								<div class="value">
									<div class="upload-btn">
										<span>上传图片</span>
										<input type="file" accept="image/*" name="" value="" @change="uploadLogo($event)">
									</div>
								</div>
							</div>
							<div class="row flex-wrap">
								<div class="name">主题：</div>
								<div class="value flex-wrap">
									<div class="radio-btn" @click="changeTheme(0)" :class="{'checked': theme===0}"><span>亮白色</span></div>
									<div class="radio-btn" @click="changeTheme(1)" :class="{'checked': theme===1}"><span>科技蓝</span></div>
								</div>
							</div>
							<div class="row flex-wrap">
								<div class="name">背景图：</div>
								<div class="value">
									<div class="image-wrap">
										<img v-if="backgroundImagePath != ''" :src="backgroundImagePath" alt="">
									</div>
								</div>
							</div>
							<div class="row flex-wrap tip">
								<div class="name"></div>
								<div class="value tip-txt">提示：图片尺寸：1920*1080 PNG格式图片</div>
							</div>
							<div class="row flex-wrap upload">
								<div class="name"></div>
								<div class="value flex-wrap">
									<div class="upload-btn">
										<span>上传图片</span>
										<input type="file" accept="image/png" name="" value="" @change="uploadImages($event, 'bg')">
									</div>
									<div class="recover-btn" @click="recoverImage('bg')">
										<span>恢复默认</span>
									</div>
								</div>
							</div>
							<div class="row flex-wrap">
								<div class="name">广告图：</div>
								<div class="value">
									<div class="image-wrap">
										<img v-if="bannerImagePath != ''" :src="bannerImagePath" alt="">
									</div>
								</div>
							</div>
							<div class="row flex-wrap tip">
								<div class="name"></div>
								<div class="value tip-txt">提示：图片尺寸：813*674 PNG格式图片</div>
							</div>
							<div class="row flex-wrap upload">
								<div class="name"></div>
								<div class="value flex-wrap">
									<div class="upload-btn">
										<span>上传图片</span>
										<input type="file" accept="image/png" name="" value="" @change="uploadImages($event, 'ad')">
									</div>
									<div class="recover-btn" @click="recoverImage('ad')">
										<span>恢复默认</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="buttom-wrap flex-wrap">
					<div class="save-btn" @click="setConfig">
						<span>保存</span>
					</div>
					<div class="reset-btn" @click="getConfig">
						<span>重置</span>
					</div>
				</div>
			</div>
		</div>
		<div class="md-loading" :class="{ 'active': md.loading}"><i class="el-icon-loading md-loading-icon"></i></div>
	</div>
</template>

<script>
import settingApi from '@/assets/js/fetch/setting'
import AsyncValidator from 'async-validator';

export default {
  name: 'setting',
  data () {
    return {
			productName: '',
			websiteTitle: '',
			copyright: '',
			logoPath: '',
			adTitle: '',
			adSlogan: '',
			theme: 1,
			backgroundImagePath: '',
			bannerImagePath: '',
			md:{
				loading:false,
			},
		}
  },
  computed: {
	  imgRound(){
		  let t = '?t='+(+new Date())
		  return
	  }
  },
  created(){},
  mounted(){
		this.getConfig();
	},
  methods:{
		recoverImage(type){
			if (type === 'bg') {
				this.backgroundImagePath = this.theme==1 ? '/modules/portal/static/images/mix-theme-dark.png' : '/modules/portal/static/images/mix-theme-bright.jpg'
			}
			if (type === 'ad') {
				this.bannerImagePath = this.theme==1 ? '/modules/portal/static/images/login-banner-dark.png' : '/modules/portal/static/images/login-banner-bright.png'
			}
		},
		setConfig(){
			let common = {
				'product_name': this.productName,
				'website_title': this.websiteTitle,
				'copyright': this.copyright,
				'logo_path': this.logoPath,
				'ad_title': this.adTitle,
				'ad_slogan': this.adSlogan,
				'mix_theme': this.theme,
				'background_image_path': this.backgroundImagePath,
				'banner_image_path': this.bannerImagePath
			};
			let descriptor = {
        'ad_title': {type: "string", required: false, pattern: /^.{0,14}$/, message: '广告标题不能超过14个字符'},
        'ad_slogan': {type: "string", required: false, pattern: /^.{0,120}$/, message: '广告语不能超过120个字符'},
        'copyright': {type: "string", required: false, pattern: /^.{0,100}$/, message: '版权信息不能超过100个字符'}
			}
			let self = this;
			let validator = new AsyncValidator(descriptor)
			validator.validate(common, (errors, fields) => {
				if (errors) {
					this.$message.error(errors[0].message)
					return
				}
				self.md['loading'] = true;
				settingApi.set_config((data) => {
					self.md['loading'] = false;
					if (data.code == 200) {
						self.$alert(data.msg,'设置',{
                            confirmButtonText:'确定',
                            callback: action => {
                                parent.window.location.reload()
                            }
						})
						document.querySelector('title').innerHTML = self.websiteTitle;
						document.querySelector('div#app').className = this.theme == 1 ? 'mix-thmem-dark' : 'mix-thmem-bright'
						sessionStorage.setItem('MIXPORTALTHEME', this.theme)
					} else {
						self.$alert(data.msg,'设置',{
                            confirmButtonText:'确定',
                            callback: action => {
                                parent.window.location.reload()
                            }
						})
					}
				},{'data':JSON.stringify({'common':common})})
			})
		},
		getConfig(){
			let self = this;
			self.productName = '';
			self.websiteTitle = '';
			self.copyright = '';
			self.logoPath = '';
			self.md['loading'] = true;
			settingApi.get_config((data) => {
				self.md['loading'] = false;
				if (data.code == 200) {
					let result = data.result;
					if (result['common']) {
						let common = result['common'];
						this.productName = common['product_name']?common['product_name']:'';
						this.websiteTitle = common['website_title']?common['website_title']:'';
						this.copyright = common['copyright']?common['copyright']:'';
						this.logoPath = common['logo_path']?common['logo_path']:'';
						this.adTitle = common['ad_title'] ? common['ad_title'] : ''
						this.adSlogan = common['ad_slogan'] ? common['ad_slogan'] : ''
						this.theme = common['mix_theme'] ? Number(common['mix_theme']) : 1
						this.backgroundImagePath = common['background_image_path']
						?
						common['background_image_path']
						:
						(this.theme==1 ? '/modules/portal/static/images/mix-theme-dark.png' : '/modules/portal/static/images/mix-theme-bright.jpg');
						this.bannerImagePath = common['banner_image_path']
						?
						common['banner_image_path']
						:
						(this.theme==1 ? '/modules/portal/static/images/login-banner-dark.png' : '/modules/portal/static/images/login-banner-bright.png');
						document.querySelector('title').innerHTML = common['website_title']?common['website_title']:'MixPortal';
						document.querySelector('div#app').className = this.theme == 1 ? 'mix-theme-dark' : 'mix-theme-bright'
						sessionStorage.setItem('MIXPORTALTHEME', this.theme)
					}
				}
			})
		},
		uploadLogo(event){
			let file = event.target.files[0];
			if (file) {
				let formData = new FormData();
				formData.append('file', file);
				let self = this;
				settingApi.upload_logo((data) => {
					if (data.code == 200) {
						self.logoPath = data.result.path + '?t=' + (+new Date());
						let dom = document.querySelector('img.image__logo');
						if (dom) {
							dom.src = self.logoPath + '?t=' + (+new Date())
						}
						// console.log(self.logoPath);
					}
				},formData)
			}
		},
		uploadImages(event, type){
			let file = event.target.files[0];
			if (file) {
				let formData = new FormData();
				formData.append('file', file);
				formData.append('type', type);
				let self = this;
				settingApi.upload_images( data => {
					if (data.code == 200) {
						if (type === 'bg') {
							this.backgroundImagePath = data.result.path + '?t=' + (+new Date());
						}
						if (type === 'ad') {
							this.bannerImagePath = data.result.path + '?t=' + (+new Date());
						}
					}
				},formData)
			}
		},
		changeTheme(theme) {
			this.theme = theme
		}
	},
	watch:{},
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import '@/assets/sass/setting/setting.scss';
</style>
