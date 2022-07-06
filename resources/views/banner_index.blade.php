<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>轮播图配置</title>
    <link rel="stylesheet" href="{{ asset('/vendor/admin_banner/css/element.css')  }} ">
{{--    <link rel="stylesheet" href="../assets/swiperConfig.css">--}}
 <link href="{{ asset('/vendor/admin_banner/css/swiperConfig.css')  }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app-a328">
    <div class="wrapper">
        <div class="title">页面布局</div>
        <div class="content">
            <div class="phone-modal">
                <div class="status-bar">
                    <div class="time">13:14</div>

                    <img src="{{ asset('/vendor/admin_banner/images/status-bar.png')  }}" class="status-bar-img">
                </div>

                <img src="{{ asset('/vendor/admin_banner/images/mini-icon.png')  }}" class="mini-icon">
                <el-carousel trigger="click" class="swiper" height="550px" :autoplay="radio == 2" loop indicator-position="none" ref="swiperRef">
                    <el-carousel-item v-for="(item,index) in configList" :key="index">

                        <img src="{{ asset('/vendor/admin_banner/images/person-info.png')  }}" class="img" alt="">
                    </el-carousel-item>
                </el-carousel>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="title">配置内容</div>
        <div class="content scroll">
            <div class="config">
                <div class="title-wrapper">
                    <div class="left">组件类型：</div>Banner
                </div>
                <div class="title-wrapper">
                    <div class="left">交互设置：</div>
                    <div>
                        <div><el-radio v-model="radio" :label="1">手动滑动</el-radio></div>
                        <div><el-radio v-model="radio" :label="2">自动轮播,轮播间隔时间为
                                <el-input v-model="input" size="mini" maxlength='4' style="width: 60px;"></el-input> 秒
                            </el-radio></div>
                    </div>
                </div>
                <div class="title-wrapper">素材配置：</div>
                <div class="config-wrapper">
                    <div class="config-list">
                        <vuedraggable v-model="configList">
                            <div class="list-item" v-for="(item,index) in configList" :key="index">
                                <el-popconfirm
                                    title="确定删除？"
                                    @confirm="handleDelete(index)"
                                    class="delete-icon"
                                >
                                    <i slot="reference" class="el-icon-delete icon"></i>
                                </el-popconfirm>

                                <div class="title-wrapper">
                                    <div class="left"><span class="required">素材：</span></div>
                                    <el-upload
                                        action="https://jsonplaceholder.typicode.com/posts/"
                                        list-type="picture-card"
                                        :limit="1"
                                        :on-success="(args)=>handleUpLoadSuccess(index,...args)"
                                        :show-file-list="false"
                                    >
                                        <img v-if="item.url" :src="item.url" class="avatar">
                                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                                    </el-upload>
                                </div>
                                <div class="title-wrapper">
                                    <div class="left">素材标题：</div>
                                    <el-input v-model="item.title" size="mini" placeholder="请输入素材标题"></el-input>
                                </div>
                                <div class="title-wrapper">
                                    <div class="left"><span class="required">交互类型：</span></div>
                                    <el-select v-model="item.type" placeholder="请选择" size="mini" style="flex:1;">
                                        <el-option
                                            v-for="item in options"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div class="title-wrapper" v-if="item.type === 'outside_mini'">
                                    <div class="left"><span class="required">appId：</span></div>
                                    <el-input v-model="input" size="mini" placeholder="请输入小程序appId"></el-input>
                                </div>
                                <div class="title-wrapper"v-if="item.type=== 'official' || item.type=== 'outside_mini' " >
                                    <div class="left"><span class="required">页面URL：</span></div>
                                    <el-input v-model="input" size="mini" placeholder="请输入页面URL"></el-input>
                                </div>
                                <div class="title-wrapper"  v-if="item.type === 'inside_mini'">
                                    <div class="left"><span class="required">选择页面：</span></div>
                                    <el-input v-model="input" size="mini" placeholder="请输入页面"></el-input>
                                </div>
                            </div>
                        </vuedraggable>
                    </div>
                    <el-button size="small" type="primary" icon="el-icon-plus" style="width: 100%;margin-bottom: 10px;" @click="addConfig">添加一个轮播位</el-button>
                    <div class="btn-group">
                        <el-button size="small" @click="handleCancel">取消</el-button>
                        <el-button size="small" type="primary" @click="saveConfig">保存</el-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('/vendor/admin_banner/js/vue.js')}}"></script>
    <script src="{{asset('/vendor/admin_banner/js/element.js')}}"></script>
    <script src="{{asset('/vendor/admin_banner/js/Sortable.min.js')}}"></script>
    <script src="{{asset('/vendor/admin_banner/js/vuedraggable.umd.min.js')}}"></script>
    <script src="{{asset('/vendor/admin_banner/js/axios.min.js')}}"></script>


    <script>
        Vue.component('vuedraggable', vuedraggable)
        // console.log(axios);
        new Vue({
            el: '#app-a328',
            data(){
                return {
                    autoplay:false,
                    interval:3000,
                    radio:1,
                    input:'',
                    configList:[
                        {
                            type:'none',
                        }
                    ],
                    options: [{
                        value: 'none',
                        label: '无'
                    }, {
                        value: 'official',
                        label: '公众号文章'
                    }, {
                        value: 'outside_mini',
                        label: '其他小程序'
                    }, {
                        value: 'inside_mini',
                        label: '跳转内部页面'
                    }]
                }
            },
            mounted() {
                // setTimeout(()=>{
                //   this.$refs.swiperRef.prev()
                // },1000)

            },
            methods: {

                addConfig(){
                    this.configList.push({type:'none'})
                },
                handleDelete(index){
                    // console.log(index);
                    this.configList.splice(index,1)
                },
                handleCancel(){},
                saveConfig(){
                    console.log(this.configList,this.list);
                },
                handleUpLoadSuccess(index,res, file){
                    console.log(index,res,file);
                }
            },
        })

    </script>
</body>
</html>
