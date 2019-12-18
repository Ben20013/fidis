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
		<router-view v-on:nav-title="onNavTitle" :eventId="Number(eventId)"></router-view>
	</div>
</template>

<script>
export default {
  name: 'customer',
  data () {
    return {
			eventId:'',
    }
  },

  created(){},
  mounted(){
		// console.log(this.eventId);
	},
  methods:{
		onNavTitle(data){
      this.$emit('nav-title',data.name);
			this.eventId = data.id;
    },
	},
	watch:{},
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
.cont-view{
	flex: 1;
	overflow: hidden;
}
</style>
