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
                <el-carousel trigger="click" class="swiper" height="550px" :autoplay="carouselType == 2" loop
                             indicator-position="none" ref="swiperRef">
                    <template v-for="(item,index) in configList">
                        <el-carousel-item :key="index" v-if="item.is_delete === 0">
                            <div class="carousel-item">
                                <template v-if="item.url">
                                    <img :src="item.url" class="img" v-if="item.url_type === 1">
                                    <video muted autoplay loop class="img" v-else>
                                        <source :src="item.url" type="video/mp4">
                                    </video>
                                </template>
                                <div class="name" v-text="item.name"></div>
                            </div>
                        </el-carousel-item>
                    </template>
                </el-carousel>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="title">配置内容</div>
        <div class="content scroll">
            <div class="config">
                <div class="title-wrapper">
                    <div class="left">组件类型：</div>
                    Banner
                </div>
                <div class="title-wrapper">
                    <div class="left">交互设置：</div>
                    <div>
                        <div>
                            <el-radio v-model="carouselType" :label="1">手动滑动</el-radio>
                        </div>
                        <div>
                            <el-radio v-model="carouselType" :label="2">自动轮播,轮播间隔时间为
                                <el-input v-model="interval" :disable="carouselType != 2" size="mini" maxlength='4'
                                          style="width: 60px;"></el-input>
                                秒
                            </el-radio>
                        </div>
                    </div>
                </div>
                <div class="title-wrapper">素材配置：</div>
                <div class="config-wrapper">
                    <div class="config-list">
                        <vuedraggable v-model="configList">
                            <template v-for="(item,index) in configList">
                                <div class="list-item" v-if="item.is_delete === 0" :key="index">

                                    <el-popconfirm
                                            v-if="configList.length > 1"
                                            title="确定删除？"
                                            v-on:confirm="handleDelete(index)"
                                            class="delete-icon">
                                        <i slot="reference" class="el-icon-delete icon"></i>
                                    </el-popconfirm>
                                    <div class="switch">
                                        <el-switch
                                                :active-value="1"
                                                :inactive-value="2"
                                                v-model="item.status">
                                        </el-switch>
                                    </div>
                                    <div class="title-wrapper">
                                        <div class="left"><span class="required">素材：</span></div>
                                        <el-radio-group v-model="item.url_type"
                                                        v-on:change="(...args)=>typeChange(index,...args)">
                                            <el-radio :label="1">图片</el-radio>
                                            <el-radio :label="2">视频</el-radio>
                                        </el-radio-group>
                                    </div>
                                    <div class="upload-wrapper" v-if="item.url_type === 1">
                                        <el-upload
                                                ref="uploadRef"
                                                :action="upLoadUrl"
                                                name="img"
                                                list-type="picture-card"
                                                accept="image/*"
                                                :on-success="(...args)=>handleUpLoadSuccess(index,...args)"
                                                :show-file-list="false"
                                        >
                                            <img v-if="item.url" :src="item.url" class="item-image">
                                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                                        </el-upload>
                                    </div>
                                    <div class="title-wrapper" v-if="item.url_type === 2">
                                        <div class="left">视频封面：</div>
                                        <el-upload
                                                ref="uploadCoverRef"
                                                :action="upLoadUrl"
                                                name="img"
                                                list-type="picture-card"
                                                accept="image/*"
                                                :on-success="(...args)=>handleCoverUpload(index,...args)"
                                                :show-file-list="false"
                                        >
                                            <img v-if="item.image_cover" :src="item.image_cover" class="item-image">
                                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                                        </el-upload>
                                        <div class="left">视频：</div>
                                        <el-upload
                                                ref="uploadRef"
                                                :action="upLoadUrl"
                                                name="img"
                                                list-type="picture-card"
                                                accept="video/*"
                                                :on-success="(...args)=>handleUpLoadSuccess(index,...args)"
                                                :show-file-list="false">
                                            <video muted loop class="item-image" v-if="item.url">
                                                <source :src="item.url">
                                            </video>
                                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                                        </el-upload>
                                    </div>
                                    <div class="title-wrapper">
                                        <div class="left">素材标题：</div>
                                        <el-input v-model="item.name" size="mini" placeholder="请输入素材标题"></el-input>
                                    </div>
                                    <div class="title-wrapper">
                                        <div class="left"><span class="required">交互类型：</span></div>
                                        <el-select v-model="item.slide_type"
                                                   v-on:change="(...args)=>selectChange(index,...args)" placeholder="请选择"
                                                   size="mini" style="flex:1;">
                                            <el-option
                                                    v-for="item in options"
                                                    :key="item.value"
                                                    :label="item.label"
                                                    :value="item.value">
                                            </el-option>
                                        </el-select>
                                    </div>
                                    <div class="title-wrapper" v-if="item.slide_type === 'outside_mini'">
                                        <div class="left"><span class="required">appId：</span></div>
                                        <el-input v-model="item.slide_type_content.appid" size="mini"
                                                  placeholder="请输入小程序appId"></el-input>
                                    </div>
                                    <div class="title-wrapper"
                                         v-if="item.slide_type=== 'official' || item.slide_type=== 'outside_mini' ">
                                        <div class="left"><span class="required">页面URL：</span></div>
                                        <el-input v-model="item.slide_type_content.url" size="mini"
                                                  placeholder="请输入页面URL"></el-input>
                                    </div>
                                    <div class="title-wrapper" v-if="item.slide_type === 'inside_mini'">
                                        <div class="left"><span class="required">选择页面：</span></div>
                                        <el-input v-model="item.slide_type_content.url" size="mini"
                                                  placeholder="请输入页面"></el-input>
                                    </div>
                                </div>
                            </template>
                        </vuedraggable>
                    </div>
                    <el-button size="small" type="primary" icon="el-icon-plus" style="width: 100%;margin-bottom: 10px;"
                               v-on:click="addConfig">添加一个轮播位
                    </el-button>
                    <div class="btn-group">
                        <button size="small" v-on:click="handleCancel">取消</button>
                        <button size="small" type="primary" v-on:click="saveConfig">保存</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 引入组件库 -->
<script src="{{asset('/vendor/admin_banner/js/vue.js')}}"></script>
<script src="{{asset('/vendor/admin_banner/js/element.js')}}"></script>
<script src="{{asset('/vendor/admin_banner/js/Sortable.min.js')}}"></script>
<script src="{{asset('/vendor/admin_banner/js/vuedraggable.umd.min.js')}}"></script>
<script src="{{asset('/vendor/admin_banner/js/axios.min.js')}}"></script>
<script>
    function verifyType(url) {
        let lastIndex = url.lastIndexOf('.')
        let ext = url.substr(lastIndex, 10)
        let reg = new RegExp(/(JPG|PNG|SVG|WEBP|GIF)/i)
        return reg.test(ext) ? 'img' : 'video'
    }

    function initListItem() {
        return {
            slide_type: 'none',
            url: '',
            id: '',
            slide_type_content: {},
            url_type: 1,
            image_cover: '',
            status: 1,
            is_delete: 0
        }
    }

    Vue.component('vuedraggable', vuedraggable)
    new Vue({
        el: '#app-a328',
        data() {
            return {
                that:'',
                //  upLoadUrl:'http://139.196.253.225:25371/operation/upLoadImg',
                upLoadUrl: './banners/upload',
                carouselType: {{$slide->type ?? 1}},


                autoplay: false,
                interval: {{$slide->time ?? 1000}},
                configList: [
                    {
                        ...initListItem()
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
        created() {
            this.initData()
        },
        methods: {
            addConfig() {
                this.configList.push({...initListItem()})
            },
            handleDelete(index) {
                this.configList[index].is_delete = 1
                // this.configList.splice(index,1)
            },
            handleCancel() {
            },
            // 上传提交
            saveConfig() {
                const {configList} = this
                const {carouselType} = this
                const {interval} = this
                if (!this.validData()) {
                    this.$message.warning('请补全配置信息')
                    return
                }
                this.that = this
                axios
                    .post('./banners/save', {'data': configList,'carouselType': carouselType, 'interval': interval})
                    .then(function (response) {
                        alert(response.data.message)
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });


                console.log(this.configList);
            },
            validData() {
                const {configList} = this
                for (const item of configList) {
                    if (item.url_type == 1) {
                        if (!item.url) {
                            return false
                        }
                    } else {
                        if (!item.url || !item.image_cover) {
                            return false
                        }
                    }
                    if (item.slide_type != 'none') {
                        if (!item.slide_type_content.url) {
                            return false
                        }
                        if (item.slide_type == 'outside_mini' && !item.slide_type_content.appid) {
                            return false
                        }
                    }

                }
                return true
            },
            initData() {
                this.configList = {!! $indexSlide !!}
          // this.configList = [
          //   {
          //     id: "",
          //     name: "123",
          //     slide_type: "none",
          //     slide_type_content: {},
          //     status: 1,
          //     url: "http://139.196.253.225:25371/images/blog-thumbnail/thum1816378781419.png",
          //     url_type: 1,
          //   },
          //   {
          //     id: "",
          //     name: "名称",
          //     slide_type: "inside_mini",
          //     slide_type_content: {url:'pages'},
          //     status: 2,
          //     image_cover:'http://139.196.253.225:25371/images/blog-thumbnail/thum1816378781419.png',
          //     url: "http://139.196.253.225:25371/images/blog-thumbnail/thum1847968365088.mp4",
          //     url_type: 2,
          //   }
          // ]
            },
            handleUpLoadSuccess(index, res, file) {
                console.log(index, res, file);
                this.configList[index].url = res.data.imgUrl
            },
            // 视频封面上传
            handleCoverUpload(index, res, file) {
                this.configList[index].image_cover = res.data.imgUrl
            },
            selectChange(index) {
                this.configList[index].slide_type_content = {}
            },
            // 类型切换
            typeChange(index) {
                this.configList[index].url = ''
            }
        },
    })

</script>
