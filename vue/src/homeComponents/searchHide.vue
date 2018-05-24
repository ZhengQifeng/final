<template>
    <div>
        <div id="searchHide">
            <div class="main-div">
                <form>
                    <el-select class="for-sel" v-model="value" placeholder="请选择">
                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                        </el-option>
                    </el-select>
                    <div class="form-ipt">
                        <input class="searchIpt" v-model="searchData.data" type="text" name="search" placeholder="搜索配件">
                        <div class="searchBtn">
                            <i class="iconfont icon-el-icon-sousuo"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'searchHide',
    data() {
        return {
            options: [{
                value: '选项1',
                label: '类型'
            }, {
                value: '选项2',
                label: '品牌'
            }, {
                value: '选项3',
                label: '名称'
            }, {
                value: '选项4',
                label: '商家'
            }],
            value: '类型',
            searchData: {
                'type': 'fitting_name',
                'data': ''
            }
        }
    },
    methods:{
        search() {
            window.location.href=`/final/searchProduct?${this.searchData.type}=${this.searchData.data}`;
        }
    }
}
</script>
<style scoped>
#searchHide {
    position: fixed;
    z-index: 1000;
    width: 100%;
    height: 50px;
    top: -50px;
    background-color: #1E8AE8;
    transition: .2s;
}

.active>#searchHide {
    top: 0px;
}

form {
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.for-sel {
    width: 100px;
    height: 32px;
    margin-right: 10px;
}

.form-ipt {
    display: flex;
    background-color: white;
    border-radius: 3px;
    border: 1px solid #e7eaf1;
}

.searchIpt {
    width: 400px;
    height: 30px;
    border-width: 0px;
    border-right-width: 0px;
    padding: 5px;
    outline: none;
    color: #333;
    font-size: 0.8rem;
}

.searchBtn {
    width: 30px;
    height: 30px;
    display: flex;
    text-align: center;
    align-items: center;
    color: #8590a6;
    cursor: pointer;
}
</style>
<style>
#searchHide .el-input__inner {
    height: 32px;
}
.el-popper .popper__arrow{
    border-width: 0px;
}
</style>