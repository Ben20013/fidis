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
  <!-- 设备历程 start -->
  <div class="equipmentHistory flex-column">
    <div class="equipmentHistoryContent flex-column">
      <div class="buttonTool">
        <div class="collectDate">
          <span>时间段</span>
          <div class="block">
            <el-date-picker
              v-model="startDateValue"
              type="datetime"
              value-format="yyyy-MM-dd HH:mm:ss"
              placeholder="开始日期">
            </el-date-picker>
          </div>
          <div class="block">
            <el-date-picker
              v-model="endDateValue"
              type="datetime"
              value-format="yyyy-MM-dd HH:mm:ss"
              placeholder="结束日期">
            </el-date-picker>
          </div>
          <span class="searchBtn" @click="getEquipmentHistoryList">搜索</span>
        </div>
        <div class="ic_refresh" @click="resetEquipmentHistoryList"></div>
      </div>
      <div class="historyList">
        <table>
          <colgroup><col width="170"><col width="100"><col width="150"><col width="*"><col width="120"></colgroup>
          <tr>
            <th>时间</th>
            <th>类型</th>
            <th>名称</th>
            <th>描述</th>
            <th>操作</th>
          </tr>
          <tr v-if="equipmentHistoryListData!=null" v-for="(item,index) in equipmentHistoryListData" :class="{'active':index==equipmentHistoryListItemCode}" @click="equipmentHistoryChangeSelect(index)">
            <td>{{item.created}}</td>
            <td v-if="item.type==1">服务</td>
            <td v-if="item.type==2">故障</td>
            <td v-if="item.type==3">报警</td>
            <td v-if="item.type==4">事件</td>
            <td v-if="item.type==5">作业</td>
            <td>{{item.name}}</td>
            <td>{{item.description}}</td>
            <td>
              <div class="ic_show" @click="equipmentHistoryInfo(item.id,item.type)"></div>
            </td>
          </tr>
          <tr v-if="equipmentHistoryListData==null">
            <td colspan="5"><div class="nodata">暂无数据</div></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="pageBtn flex-column">
      <div class="block" v-show="equipmentHistoryListData!=null">
        <el-pagination background @size-change="equipmentHistoryHandleSizeChange" @current-change="getEquipmentHistoryList" :current-page.sync="equipmentHistoryCurrentPage" :page-sizes="[15,20,30,40,50]" :page-size="100" layout="prev, pager, next, sizes, jumper" :total="equipmentHistoryListTotal">
        </el-pagination>
      </div>
    </div>
    <div class="md-mask" :class="{ 'active': md.mask}"></div>
    <div class="md-loading" :class="{ 'active': md.loading}"><i class="el-icon-loading md-loading-icon"></i></div>
    <!-- 设备历程查看 start -->
    <div class="md-modal-container">
      <div class="md-modal md-effect-1 viewEquipmentHistory" :class="{ 'md-show': md.view}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">查看设备历程</div>
            <div class="iconWrap" @click="closeMd('view')"><i class="close"></i></div>
          </div>
          <!--内容-->
          <div class="contBox" v-if="equipmentHistoryInfoData!=null">
            <div class="viewInfoWrap" v-if="equipmentHistoryInfoData.alert_id">
              <div class="rowWrap flex-wrap">
                <div class="colWrap">
                  <div class="title">设备ID</div>
                  <div class="value">{{equipmentHistoryInfoData.equipment_id}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">报警编号</div>
                  <div class="value">{{equipmentHistoryInfoData.alert_id}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">报警名称</div>
                  <div class="value">{{equipmentHistoryInfoData.alert_name}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">产生时间</div>
                  <div class="value">{{equipmentHistoryInfoData.created}}</div>
                </div>
              </div>
              <div class="rowWrap flex-wrap">
                <div class="colAll">
                  <div class="title">
                    报警描述
                  </div>
                  <div class="value">{{equipmentHistoryInfoData.description}}</div>
                </div>
              </div>
            </div>
            <div class="viewInfoWrap" v-if="equipmentHistoryInfoData.event_id">
              <div class="rowWrap flex-wrap">
                <div class="colWrap">
                  <div class="title">设备ID</div>
                  <div class="value">{{equipmentHistoryInfoData.equipment_id}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">事件编号</div>
                  <div class="value">{{equipmentHistoryInfoData.event_id}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">事件名称</div>
                  <div class="value">{{equipmentHistoryInfoData.event_name}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">产生时间</div>
                  <div class="value">{{equipmentHistoryInfoData.created}}</div>
                </div>
              </div>
              <div class="rowWrap flex-wrap">
                <div class="colAll">
                  <div class="title">
                    事件描述
                  </div>
                  <div class="value">{{equipmentHistoryInfoData.description}}</div>
                </div>
              </div>
            </div>
            <div class="viewInfoWrap" v-if="equipmentHistoryInfoData.fault_id">
              <div class="rowWrap flex-wrap">
                <div class="colWrap">
                  <div class="title">设备ID</div>
                  <div class="value">{{equipmentHistoryInfoData.equipment_id}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">故障编号</div>
                  <div class="value">{{equipmentHistoryInfoData.fault_id}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">故障名称</div>
                  <div class="value">{{equipmentHistoryInfoData.fault_name}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">产生时间</div>
                  <div class="value">{{equipmentHistoryInfoData.created}}</div>
                </div>
              </div>
              <div class="rowWrap flex-wrap">
                <div class="colAll">
                  <div class="title">
                    故障描述
                  </div>
                  <div class="value">{{equipmentHistoryInfoData.description}}</div>
                </div>
              </div>
            </div>
            <div class="viewInfoWrap" v-if="equipmentHistoryInfoData.activity_id">
              <div class="rowWrap flex-wrap">
                <div class="colWrap">
                  <div class="title">设备ID</div>
                  <div class="value">{{equipmentHistoryInfoData.equipment_id}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">作业编号</div>
                  <div class="value">{{equipmentHistoryInfoData.activity_id}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">客户编号</div>
                  <div class="value">{{equipmentHistoryInfoData.customer_id}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">作业名称</div>
                  <div class="value">{{equipmentHistoryInfoData.activity_name}}</div>
                </div>
              </div>
              <div class="rowWrap flex-wrap">
                <div class="colWrap">
                  <div class="title">作业类型</div>
                  <div class="value">{{equipmentHistoryInfoData.category}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">作业人员</div>
                  <div class="value">{{equipmentHistoryInfoData.staff}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">作业时间</div>
                  <div class="value">{{equipmentHistoryInfoData.date}}</div>
                </div>
              </div>
              <div class="rowWrap flex-wrap">
                <div class="colAll">
                  <div class="title">
                    作业描述
                  </div>
                  <div class="value">{{equipmentHistoryInfoData.description}}</div>
                </div>
              </div>
              <div class="rowWrap flex-wrap">
                <div class="colAll">
                  <div class="title">
                    作业附件
                  </div>
                  <div class="fileList">
                    <span class="ic_download download" v-if="equipmentHistoryInfoData.attachment" @click="downloadFile(equipmentHistoryInfoData.attachment)">立即下载</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="viewInfoWrap" v-if="equipmentHistoryInfoData.service_id">
              <div class="rowWrap flex-wrap">
                <div class="colWrap">
                  <div class="title">设备ID</div>
                  <div class="value">{{equipmentHistoryInfoData.equipment_id}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">服务名称</div>
                  <div class="value">{{equipmentHistoryInfoData.service_name}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">服务时间</div>
                  <div class="value">{{equipmentHistoryInfoData.date}}</div>
                </div>
                <div class="colWrap">
                  <div class="title">服务类型</div>
                  <div class="value">{{equipmentHistoryInfoData.category}}</div>
                </div>
              </div>
              <div class="rowWrap flex-wrap">
                <div class="colWrap">
                  <div class="title">服务人员</div>
                  <div class="value">{{equipmentHistoryInfoData.staff}}</div>
                </div>
                <div class="colWrap">
                  <div class="title"></div>
                  <div class="value"></div>
                </div>
                <div class="colWrap">
                  <div class="title"></div>
                  <div class="value"></div>
                </div>
              </div>
              <div class="rowWrap flex-wrap">
                <div class="colAll">
                  <div class="title">服务描述</div>
                  <div class="value">{{equipmentHistoryInfoData.description}}</div>
                </div>
              </div>
              <div class="rowWrap flex-wrap">
                <div class="colAll">
                  <div class="title">
                    服务附件
                  </div>
                  <div class="fileList">
                    <span class="ic_download download" v-if="equipmentHistoryInfoData.attachment" @click="downloadFile(equipmentHistoryInfoData.attachment)">立即下载</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- 按钮 -->
          <div class="buttomBox flex-wrap flex-center">
            <!-- <input type="button"  class="btn_cancel" value="取消"/> -->
            <input type="button"  class="btn_determine" value="关闭"  @click="closeMd('view')"/>
          </div>
        </div>
      </div>
    </div>
    <!-- 设备历程查看 end -->
  </div>
  <!-- 设备历程 end -->
</template>

<script>
import deviceApi from '@/assets/js/fetch/device';

export default {
  name: 'status',
  props:{
    equipmentId:Number,
    token:String
  },
  data () {
    return {
      msg: 'Welcome to Your Vue.js App',
      // 设备历程
      startDateValue:'',
      endDateValue:'',
      equipmentHistoryInfoData:null,
      equipmentHistoryListData:null,
      equipmentHistoryListItemCode:0,
      equipmentHistoryListTotal:0,
      equipmentHistoryCurrentPage:1,
      equipmentHistoryCurrentPageSize:15,
      // 弹窗控制
      md:{
      	mask:false,
      	view:false,
      },
    }
  },
  mounted(){
    // console.log(this);
    this.setEquipmentHistoryTime();
    this.getEquipmentHistoryList(this.equipmentId);
  },
  methods:{
    // 设备历程 start
    equipmentHistoryInfo(id,type){
      if (!id || !this.token) {
        return;
      }
      let self = this;
      deviceApi.get_equipment_history_info(function(data){
        if (data.code == 200) {
          // console.log(data);
          self.showMd('view');
          self.equipmentHistoryInfoData=data.result;
        }
      },{"id":id,"type":type},this.token)
    },
    resetEquipmentHistoryList(){
      this.setEquipmentHistoryTime();
      this.equipmentHistoryCurrentPage=1;
      this.equipmentHistoryCurrentPageSize=15;
      this.getEquipmentHistoryList();
    },
    getEquipmentHistoryList(id){
      if (!id || !this.token) {
        return;
      }
      let self = this;
      deviceApi.get_equipment_history_list(function(data){
        if (data.code == 200) {
          // console.log(data);
          if (data.result.data.length == 0) {
            return;
          }
          self.equipmentHistoryListTotal = data.result.total_records;
          self.equipmentHistoryListData = data.result.data;
        }
      },{"equipment_id":id,"start_time":this.startDateValue,"end_time":this.endDateValue,"page":this.equipmentHistoryCurrentPage,"item":this.equipmentHistoryCurrentPageSize},this.token)
    },
    equipmentHistoryHandleSizeChange(val){
      // console.log(val);
      this.equipmentHistoryCurrentPageSize = val;
      this.getEquipmentHistoryList();
    },
    equipmentHistoryChangeSelect(index){
      this.equipmentHistoryListItemCode = index;
    },
    setEquipmentHistoryTime(){
      let date = new Date();
      let year = date.getFullYear();
      let month = date.getMonth()+1;
      let day = date.getDate();
      let h = date.getHours();
      let m = date.getMinutes();
      let s = date.getSeconds();
      this.endDateValue = year+'-'+formatStr(month)+'-'+formatStr(day)+' '+formatStr(h)+':'+formatStr(m)+':'+formatStr(s);
      date= +date - 1000*60*60*24*6;
      date = new Date(date);
      year = date.getFullYear();
      month = date.getMonth()+1;
      day = date.getDate();
      this.startDateValue = year+'-'+formatStr(month)+'-'+formatStr(day)+' 00:00:00';
      function formatStr(str){
        str = str<10?'0'+str:str;
        return str;
      }
    },
    downloadFile(path){
      if(path=='' || path==null){return}
      deviceApi.download(path);
    },
    // 设备历程 end
    // 弹框事件开关
    showMd(md) {
      this.md[md] = true;
      this.md.mask = true;
    },
    closeMd(md) {
      this.md[md] = false
      this.md.mask = false
    },
  },
  watch:{
    equipmentId:['getEquipmentHistoryList']
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
  @import '../../../../sass/singleEquipment/tab/course.scss';
</style>
