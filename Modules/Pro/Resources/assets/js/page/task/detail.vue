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
    <div class="cont-box">
        <div class="flex-column" style="height:100%;overflow:hidden;">
            <div class="content-wrap flex-column details__box" style="height:auto;">
                <div class="nav-wrap flex-wrap flex-center flex-between">
                    <div class="nav-title flex-wrap left-box"><span>{{$t('weibaoLang.maintenance_detail')}}</span></div>
                    <div class="right-box flex-wrap">
                        <div class="mix-icon-button" @click="refresh"><i class="mix-refresh-icon"></i></div>
                        <div @click="openEditModel" class="mix-icon-txt-button">{{$t('weibaoLang.change_cycle')}}</div>
                    </div>
                </div>
                <div class="body-wrap">
                        <div class="table-wrap">
                            <table class="block-body-table">
                                <tr>
                                    <td>{{$t('weibaoLang.maintenance_id')}}</td>
                                    <td>{{maintenance_id}}</td>
                                    <td>{{$t('weibaoLang.equipment_name')}}</td>
                                    <td>{{equipment_name}}</td>
                                    <td>{{$t('weibaoLang.maintenance_point')}}</td>
                                    <td>{{rule_name}}</td>
                                </tr>
                                <tr>
                                    <td>{{$t('weibaoLang.last_maintenance_time')}}</td>
                                    <td>{{last_maintenance_time}}</td>
                                    <td>{{$t('weibaoLang.created')}}</td>
                                    <td>{{created}}</td>
                                    <td>{{$t('weibaoLang.maintenance_cycle')}}</td>
                                    <td>{{period}}{{unit}}</td>
                                </tr>
                                <tr>
                                    <td>{{$t('weibaoLang.maintenance_countdown')}}</td>
                                    <td><font color="#FF0000">{{remaining}}</font></td>
                                    <td>{{$t('weibaoLang.maintenance_time_type')}}</td>
                                    <td>{{time_type === 1 ? $t('weibaoLang.natural_time') : $t('weibaoLang.equipment_running_time')}}</td>
                                    <td>{{$t('weibaoLang.action')}}</td>
                                    <td>{{description}}</td>
                                </tr>
                            </table>
                        </div>
                </div>
            </div>

            <div class="content-wrap flex-column" style="flex:1;">
                <div class="nav-wrap flex-wrap flex-center flex-between">
                    <div class="nav-title flex-wrap left-box"><span>{{$t('weibaoLang.maintenance_record')}}</span></div>
                    <div class="right-box flex-wrap">
                        <div class="mix-icon-button" @click="refresh"><i class="mix-refresh-icon"></i></div>
                        <div @click="openAddModel" class="mix-icon-txt-button"><i class="mix-add-gray-icon"></i><span>{{$t('weibaoLang.maintenance_record')}}</span></div>
                    </div>
                </div>
                <div class="body-wrap">
                    <!--表格-->
                    <div class="table-wrap">
                        <div class="list-table flex-column">
                            <el-table style="width: 100%"
                                    :data="listData"
                                    height="100%"
                                    ref="table"

                                    highlight-current-row
                                    row-key="service_id"
                                    :expand-row-keys="expands"
                                    @row-click="toogleExpand">
                                <!--table点击每一行展示的内容-->
                                <el-table-column type="expand" fixed width="1" class-name="expand-table">
                                    <template slot-scope="props">
                                        <table class="block-body-table">
                                            <tr>
                                                <td>{{$t('weibaoLang.maintenance_id')}}</td>
                                                <td>{{ props.row.service_id }}</td>
                                                <td>{{$t('weibaoLang.attachment')}}</td>
                                                <td>{{ props.row.template }}</td>
                                                <td>{{$t('weibaoLang.maintenance_staff')}}</td>
                                                <td>{{ props.row.staff }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{$t('weibaoLang.maintenance_date')}}</td>
                                                <td>{{ props.row.date }}</td>
                                                <td>{{$t('weibaoLang.description')}}</td>
                                                <td>{{ props.row.description }}</td>
                                            </tr>
                                        </table>
                                    </template>
                                </el-table-column>

                                <!--table-->
                                <el-table-column :label="$t('weibaoLang.number')" width="100">
                                    <template slot-scope="props">{{ props.row.service_id }}</template>
                                </el-table-column>
                                <el-table-column  :label="$t('weibaoLang.description')">
                                    <template slot-scope="props">{{ props.row.description }}</template>
                                </el-table-column>
                                <el-table-column  :label="$t('weibaoLang.attachment')">
                                    <template   slot-scope="props">{{ props.row.template }}</template>
                                </el-table-column>
                                <el-table-column :label="$t('weibaoLang.maintenance_staff')">
                                    <template slot-scope="props">{{ props.row.staff }}</template>
                                </el-table-column>
                                <el-table-column :label="$t('weibaoLang.maintenance_date')">
                                    <template slot-scope="props">{{ props.row.date }}</template>
                                </el-table-column>
                                <el-table-column :label="$t('weibaoLang.operating')">
                                <!--   <td v-if="props.row.time_type ==1">自然时间
                                            </td>
                                            <td v-else>设备运行时间</td> -->
                                    <template slot-scope="props" v-if="props.row.attachment">
                                        <div  @click.stop="download(props.row.attachment)" class="mix-download-gray-icon"></div>
                                    </template>
                                </el-table-column>
                            </el-table>
                        </div>

                        <!--分页-->
                        <div class="list-pagination flex-wrap">
                            <el-pagination
                                background
                                @size-change="handleSizeChange"
                                @current-change="handleCurrentChange"
                                :current-page="currentPage"
                                :page-size="currentPageSize"
                                :page-sizes="[10,15,20,25,30]"
                                layout="prev, pager, next, sizes, jumper"
                                :total="listTotalRecord">
                            </el-pagination>
                        </div>
                    </div>
                </div>

            <!--添加维保记录弹窗-->
            <mix-modal v-show="isAddModal" :title="$t('weibaoLang.add_maintenance_record')" width="785px" height="700px" @close="isAddModal=false" @cancel="isAddModal=false" @confirm="add">
                <div class="mix-win-modal-flex-table" slot="body">
                    <div class="row">
                        <div class="col">
                            <div class="label">{{$t('weibaoLang.maintenance_staff')}}</div>
                            <div class="input">
                                <el-input v-model="addSheetObj.staff" :placeholder="$t('weibaoLang.please_input')"></el-input>
                            </div>
                        </div>
                    </div>
                <!--  <div class="row">
                        <div class="col">
                            <div class="label">维保时间</div>
                            <div class="input">
                                <el-input v-model="addSheetObj.date" placeholder="格式：2015-12-12"></el-input>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col">
                            <div class="label">{{$t('weibaoLang.maintenance_date')}}</div>
                            <div class="input">
                        <el-date-picker
                        v-model="addSheetObj.date"
                        type="datetime"
                        format="yyyy-MM-dd HH:mm:ss"
                        value-format="yyyy-MM-dd HH:mm:ss"
                        :default-value="today_date"
                        >
                        </el-date-picker>
                    <!-- </el-time-picker> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="label">{{$t('weibaoLang.customer_name')}}</div>
                            <div class="input">
                                <el-input v-model="addSheetObj.customer_name" :placeholder="$t('weibaoLang.please_input')" readonly></el-input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="label">{{$t('weibaoLang.equipment_name')}}</div>
                            <div class="input">
                                <el-input v-model="addSheetObj.equipment_name" :placeholder="$t('weibaoLang.please_input')" readonly></el-input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="label">{{$t('weibaoLang.description')}}</div>
                            <div class="input">
                                <el-input type="textarea" :rows="1" v-model="addSheetObj.description" :placeholder="$t('weibaoLang.please_input')"></el-input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                                    <div class="label">{{$t('weibaoLang.updating_files')}}
                                    </div>
                                    <div class="Add_boder_file">
                            <div class="Add__list_fileBtn">
                            <input type="file" v-on:change="uploadChange">
                            </div>
                            <div class="add_list_file">
                                <img src="" alt="" id="portrait" style="width: 80px;height: 80px;"/>
                            </div>
                            <div class="Add__list_fileName" v-text="file_name1">
                            </div>
                                <i class="el-icon-close" @click="uploadFail"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </mix-modal>

            <!--变更周期-->
            <mix-modal v-show="isEditModal" :title="$t('weibaoLang.change_cycle')" width="300px" height="220px" @close="isEditModal=false" @cancel="isEditModal=false" @confirm="edit">
                <div class="mix-win-modal-flex-table" slot="body">
                    <div class="row">
                        <div class="col">
                            <div class="label">{{$t('weibaoLang.exec_cycle')}}</div>
                            <div class="input flex-wrap addModal__schedule_input">
                                <el-input style="width:120px" v-model="editSheetObj.period" :placeholder="$t('weibaoLang.exec_cycle_tip')"></el-input>
                                <el-select style="width:80px" v-model="editSheetObj.unit">
                                    <el-option
                                        v-for="item in scheduleDate"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                    </el-option>
                                </el-select>
                            </div>
                        </div>
                    </div>
                </div>
            </mix-modal>
            </div>
        </div>
    </div>
</template>

<script>
import messengerApi from '@/assets/js/fetch/task-detail.js'
// import config from '@/assets/js/config/api.conf.js';
import mixModal from '@/assets/js/components/mix-modal'

    export default {
        name: "taskDetail",
        components:{
            mixModal
        },
        data() {
            return {
                message: 'Hello world!',
                expands:[],
                currentPageSize: 10,
                isEdit: false,
                isAddModal: false,
                isEditModal: false,
                searchString: '',
                listData: [],
                listTotalRecord: 0,
                currentPage: 1,
                activeItem: 0,
                infoData: null,
                test:'111',
                input3: '',
                input4: '',
                input5: '',
                device_select:'',
                search_select: '',
                get_maintenance_id:'',
                maintenance_id:'',
                rule_name:'',
                last_maintenance_time:'',
                created:'',
                equipment_name:'',
                period:'',
                equipment_id:'',
                today_date:'',
                remaining:'',
                unit:'',
                time_type:'',
                description:'',

                dynamicTags: [],
                inputVisible: false,
                inputValue: '',
                agentRule:{
                    type: '',
                    addition: '',
                    callback: '',
                    cycle:''
                },
                scheduleDate:[
                    {label:this.$t('weibaoLang.hour'),value:'hour'},
                    {label:this.$t('weibaoLang.day'),value:'day'},
                    {label:this.$t('weibaoLang.month'),value:'month'},
                    {label:this.$t('weibaoLang.year'),value:'year'}
                ],
                editSheetObj:{
                    period:'',
                    unit:'',
                    maintenance_id:''
                },
                addSheetObj: {
                    service_name: '',
                    description: '',
                    date: '',
                    customer_id: '',
                    equipment_id: '',
                    template: '',
                    staff:'',
                    attachment:'',
                    customer_name:'',
                    equipment_name:''
                },
                isUseAgent: 0,
                routeIdList: [],
                tplTypeList: [],
                agentTypeList: [],
                scheduleType: [
                    {label:'倒计时',value:'1'},
                    {label:'倒计时2',value:'2'},
                    {label:'倒计时3',value:'3'}
                ],
                timeType:[
                    {label:'自然时间',value:'1'},
                    {label:'工作日',value:'2'}
                ],
                remindChannel:[
                    {label:'提醒渠道1',value:'1'},
                    {label:'提醒渠道2',value:'2'}
                ],
                detail:[],
                listData: [],
                customer:[],
                dialogImageUrl: '',
                dialogVisible: false,
                file_name:'',
                file_name1:'',
                formData:''
            }
        },
        mounted() {
         this.getMaintenanceId();
        this.getList();
        this.getDetail();
        // this.spiltFunciton();
    },
        methods: {
            toogleExpand(row) {
                let $table = this.$refs.table;
                this.listData.map((item) => {
                    if (row.service_id != item.service_id)
                {
                    $table.toggleRowExpansion(item, false)
                }
            })
                $table.layout.scrollY = true;
                $table.toggleRowExpansion(row)
            },
            uploadFail(){
                this.file_name = '';
                this.file_name1 = '';
                document.getElementById('portrait').src='';
            },
            uploadChange(e){
                  this.file_name = e.currentTarget.files[0];
                  this.file_name1 =e.currentTarget.files[0].name;
                    var fr = new FileReader();
                fr.onload = function () {
                    document.getElementById('portrait').src = fr.result;
                };
                fr.readAsDataURL(this.file_name);
            },
            getMaintenanceId(){
                var url=window.location.href;
                var ok = url.split("=");
                this.get_maintenance_id = '';
                this.get_maintenance_id = ok[1];
                // this.get_maintenance_id = 1;
            },
            download(url){
            //    window.open('/api/app/download'+'?attach='+url);
               window.open('/pro/task/download_file'+'?attach='+url);
               // window.location.href = '/api/app/download'+'?attach='+url
            },
            getDetail(){
                 const loading = this.$loading({
                    lock: true,
                    text: 'Loading'
                });
                let self = this;
                  messengerApi.detail((data)=>{
                    if (data.code == 200) {
                          var detail = data.result;
                          self.maintenance_id = detail.maintenance_id;
                          self.rule_name = detail.rule_name;
                          self.last_maintenance_time = detail.last_maintenance_time;
                          self.created = detail.created;
                          if(detail.time_type==1){
                                var closing_date = Date.parse(new Date(detail.closing_date))/1000;

                                var timestamp = Date.parse(new Date());

                                //获取当前时间
                                var time = timestamp/1000;

                                //获得剩余时间
                                var remaining =(closing_date-time)/3600;

                                var remaining = remaining.toFixed(1);
                            }else{
                                var remaining = detail.remaining
                            }
                          self.remaining = remaining?remaining+this.$t('weibaoLang.hour'):remaining;
                          self.period = detail.period;
                          self.unit = this.getShowTime(detail);
                          self.time_type = detail.time_type;
                          self.description = detail.description;
                          self.equipment_id = detail.equipment_id;
                            if(detail.equipment_id){
                                messengerApi.getName((data)=>{
                            self.equipment_name = data.result[0].equipment_name;
                                },{equipment_id: detail.equipment_id})
                            }
                        }

                    setTimeout(()=>{
                        loading.close();
                         // this.getLists();
                    },1000)
            },{'page_index':this.currentPage,'page_size':this.currentPageSize,'maintenance_id': this.get_maintenance_id})
            },
            getEquipmentName(equipment_id){
                 messengerApi.getName((data)=>{
                    self.equipment_name = data.result[0].equipment_name;
                           // return data.result[0].equipment_name;
                        },{equipment_id: equipment_id})
            },
             getShowTime(item){
                 if(item.unit == 'hour'){
                            return this.$t('weibaoLang.hour');
                        }else if(item.unit == 'day'){
                            return this.$t('weibaoLang.day');
                        }else if(item.unit == 'month'){
                            return  this.$t('weibaoLang.month');
                        }else if(item.unit== 'year'){
                            return this.$t('weibaoLang.year');
                        }

            },
              add(){
                  // this.editSheetObj.maintenance_id = this.maintenance_id;
                this.addSheetObj.equipment_id = this.equipment_id;
                this.addSheetObj.customer_id = this.customer.customer_id;
                this.addSheetObj.maintenance_id = this.maintenance_id;
                // console.log(this.addSheetObj.unit);
                //  const date = new Date(this.addSheetObj.unit);
                //  console.log(date);
              // this.addSheetObj.date = date.setTime(date.getTime());
                // value-format="yyyy-MM-dd HH:mm:ss"
                if (this.addSheetObj.staff == '') {
                    this.$message({
                        message: this.$t('weibaoLang.maintenance_record_name_not_null'),
                        type: 'warning'
                    });
                    return
                }
                if (this.addSheetObj.description == '') {
                    this.$message({
                        message: this.$t('weibaoLang.description_not_null'),
                        type: 'warning'
                    });
                    return
                }
                if (this.addSheetObj.date=='') {
                    this.$message({
                        message: this.$t('weibaoLang.maintenance_time_not_null'),
                        type: 'warning'
                    });
                    return
                }
                if (this.addSheetObj.staff == '') {
                    this.$message({
                        message: this.$t('weibaoLang.maintenance_staff_not_null'),
                        type: 'warning'
                    });
                    return
                }
                this.formData = new FormData();
                this.formData.append("maintenance_id", this.maintenance_id);
                this.formData.append("attachment", this.file_name);
                this.formData.append("equipment_id",this.equipment_id);
                this.formData.append("customer_id", this.customer.customer_id);

                this.formData.append("staff",this.addSheetObj.staff);
                this.formData.append("description",this.addSheetObj.description);
                this.formData.append("date", this.addSheetObj.date);

                let self = this;

               messengerApi.add( (data) => {
                   let msgType = 'error';
               if (data.code == 200) {
                   self.getList();
                   self.isAddModal = false;
                   msgType = 'success';
               }else{

               }
               self.$message({
                   message: data.msg,
                   type: msgType
               });
           }, this.formData)
            },

            openAddModel(){
                this.clearInfo();
                 this.getCustomerName();
                this.addSheetObj.equipment_name = this.equipment_name;
                 const date = new Date();
               this.addSheetObj.date = this.getNowDate();
                 this.isAddModal = true;
             },
             getNowDate() {
                 var date = new Date();
                 var sign1 = "-";
                 var sign2 = ":";
                 var year = date.getFullYear() // 年
                 var month = date.getMonth() + 1; // 月
                 var day  = date.getDate(); // 日
                 var hour = date.getHours(); // 时
                 var minutes = date.getMinutes(); // 分
                 var seconds = date.getSeconds() //秒
                 var weekArr = [this.$t('weibaoLang.Monday'), this.$t('weibaoLang.Tuesday'), this.$t('weibaoLang.Wednesday'), this.$t('weibaoLang.Thursday'), this.$t('weibaoLang.Friday'), this.$t('weibaoLang.Saturday'), this.$t('weibaoLang.Sunday')];
                 var week = weekArr[date.getDay()];
                 // 给一位数数据前面加 “0”
                 if (month >= 1 && month <= 9) {
                  month = "0" + month;
                 }
                 if (day >= 0 && day <= 9) {
                  day = "0" + day;
                 }
                 if (hour >= 0 && hour <= 9) {
                  hour = "0" + hour;
                 }
                 if (minutes >= 0 && minutes <= 9) {
                  minutes = "0" + minutes;
                 }
                 if (seconds >= 0 && seconds <= 9) {
                  seconds = "0" + seconds;
                 }
                 var currentdate = year + sign1 + month + sign1 + day + " " + hour + sign2 + minutes + sign2 + seconds ;
                 return currentdate;
                },
             openEditModel(){
                 this.editSheetObj.period = this.period;
               this.editSheetObj.unit = this.unit;
                // this.
                 this.isEditModal = true;
             },
             edit(){
                this.editSheetObj.maintenance_id = this.maintenance_id;
                if (this.editSheetObj.unit == '') {
                    this.$message({
                    message: this.$t('weibaoLang.time_unit_error'),
                                    type: 'warning'
                                });
                                return
                }
                if (this.editSheetObj.period == '') {
                    this.$message({
                    message: this.$t('weibaoLang.time_error'),
                            type: 'warning'
                        });
                        return
                }
                if (!/^[0-9]+$/.test(this.editSheetObj.period)) {
                    this.$message({
                    message: this.$t('weibaoLang.exec_cycle_must_int'),
                            type: 'warning'
                        });
                        return
                }
                if(this.editSheetObj.unit==this.$t('weibaoLang.hour')){
                    this.editSheetObj.unit='hour';
                }
                let self = this;
                 messengerApi.edit( (data) => {
                   let msgType = 'error';
               if (data.code == 200) {
                   self.getList();
                   self.getDetail();
                   self.isAddModal = false;
                   msgType = 'success';
               }
               self.$message({
                   message: data.msg,
                   type: msgType
               });
            }, this.editSheetObj)
                this.isEditModal = false;
             },
             clearInfo(){
                 this.addSheetObj={
                    service_name: '',
                    description: '',
                    date: '',
                    customer_id: '',
                    equipment_id: '',
                    template: '',
                    staff:'',
                    attachment:'',
                    customer_name:'',
                    // equipment_name:''
                };
                 this.file_name='';
                this.file_name1='';
                // document.getElementById('portrait').src='';
             },
            getList(){
                const loading = this.$loading({
                    lock: true,
                    text: 'Loading'
                });

                var searchList = JSON.stringify([["maintenance_id",this.get_maintenance_id]]);
                let self = this;
                  messengerApi.list((data)=>{
                    if (data.code == 200) {
                          self.listData = data.result.data;
                          self.listTotalRecord = data.result.total_records;
                          //设备名
                          for (var i = self.listData.length - 1; i >= 0; i--) {
                            //    if(self.listData[i].equipment_id){
                            //     // console.log(self.listData[i].equipment_id);
                            //     // self.listData[i].equipment_id = 'ok';

                            // }
                            //文件名截取
                            if(self.listData[i].attachment){
                                var index = self.listData[i].attachment.lastIndexOf("\/");

                                var str  = self.listData[i].attachment.substring(index + 1, self.listData[i].attachment.length);
                                //把不需要的template赋值为文件名
                                self.listData[i].template = str;
                            }
                          }
                        }

                    setTimeout(()=>{
                        loading.close();
                         // this.getLists();
                    },1000)
            },{'page_index':this.currentPage,'page_size':this.currentPageSize,'search': searchList})
            },
            getCustomerName(){
                  const loading = this.$loading({
                    lock: true,
                    text: 'Loading'
                });
                let self = this;
                 messengerApi.getCliName((data)=>{
                    if (data.code == 200) {
                         self.customer = data.result;
                   this.addSheetObj.customer_name = this.customer.customer_name;
                           setTimeout(()=>{
                        loading.close();
                         // this.getLists();
                    },1000)
                    }

                        },{'equipment_id': this.equipment_id,})
            },
            spiltFunciton(address){
                var index = address.lastIndexOf("\/");
                str  = address.substring(index + 1, str .length);
                return str;
            },
            getLists(){
                 let self = this;
                 for (var i = this.listData.length - 1; i >= 0; i--) {
                            if (this.listData[i].equipment_id) {
                            messengerApi.getName((data)=>{
                            this.listData[i].equipment_id = data.result[0].equipment_name;
                        },{equipment_id: this.listData[i].equipment_id})
                        }
                       }
            },

            handleEdit(index, row) {
                console.log(index, row);
            },
            handleDelete(index, row) {
                console.log(index, row);
            },


            handleCurrentChange(value){
                this.currentPage = value;
                this.getList();
            },
            handleSizeChange(val){
                this.currentPageSize = val;
                this.getList();
            },
            refresh(){
                this.searchString = '';
                this.currentPage = 1;
                this.currentPageSize = 10;
                this.getList();
                this.getDetail();
            },

            showInput() {
                this.inputVisible = true;
                this.$nextTick(_ => {
                    this.$refs.saveTagInput.$refs.input.focus();
            });
            },
        }
    }
// background: url(assets/img/add_file.png) no-repeat center;
</script>
<style rel="stylesheet/scss" lang="scss" scoped>
    @import '../../../sass/mix-base-layout.scss';
@import '../../../sass/style.scss';
	.cont-box{
		flex: 1;
		padding: 16px;
		overflow: hidden;
    }
    .Add__list_fileBtn {
        background:url( $path + "/modules/pro/static/images/public/add-gray-icon.png") no-repeat center;
        width: 80px;
        height: 80px;
        margin-top:10px;
        text-align: center;

        display: inline-block;
        overflow: hidden;
        position: relative;
        border: 1px solid #ccc;
        line-height: 80px;
    }
</style>
<style rel="stylesheet">
.main .right-box .container{
        overflow-y: auto!important;
    }
.downloadImg{
    background-image:url(/public/images/public/dowload.png);
}
.detail-add-icon{
    display: inline-block;
    width: 16px;
    height: 16px;
    background: url('/images/public/add-gray-icon.png') no-repeat center center;
}
.avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .avatar {
    width: 178px;
    height: 178px;
    display: block;
  }
.add_list_file{
     width: 80px;
    height: 80px;
    margin-top:10px;
    text-align: center;

    display: inline-block;
    overflow: hidden;
    position: relative;
    border: 1px solid #ccc;
    line-height: 80px;
}
.Add__list_fileBtn input {
  opacity: 0;
}
.Add__list_fileBtn img{
    display: inline-block;
}
.Add__list_file{
  display: flex;
  align-items: center;
  padding-bottom: .75rem;
}

.Add__list_fileName{
  display: inline-block;
  font-size: .7rem;
  padding-left: .5rem;
}
    .search__selectBox .el-select .el-input {
        width: 130px!important;
        color: #333;
    }
    .input-with-select .el-input-group__prepend {
        background-color: #fff!important;
    }
    .left-box .el-select .el-input .el-select__caret{
        color: #333!important;
        font-weight: 600;
    }

</style>
