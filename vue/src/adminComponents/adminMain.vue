<template>
    <div>
        <div id="adminMain">
            <div class="left">
                <el-row class="tac">
                    <el-col>
                        <el-menu :default-active="$route.path" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" background-color="#545c64" text-color="#fff">
                            <el-submenu index="1">
                                <template slot="title">
                                    <i class="iconfont icon-fenlei"></i>
                                    <span>配件分类</span>
                                </template>
                                <el-menu-item-group>
                                    <router-link to="/classify/all">
                                        <el-menu-item index="/classify/all">
                                            总分类
                                        </el-menu-item>
                                    </router-link>
                                    <router-link to="/classify/fine">
                                        <el-menu-item index="/classify/fine">
                                            细分类
                                        </el-menu-item>
                                    </router-link>
                                    <router-link to="/classify/brand">
                                        <el-menu-item index="/classify/brand">
                                            品牌分类
                                        </el-menu-item>
                                    </router-link>
                                </el-menu-item-group>
                            </el-submenu>
                            <router-link to="/parts">
                                <el-menu-item index="/parts">
                                    <i class="iconfont icon-xiangqing"></i>
                                    <span>配件详情</span>
                                </el-menu-item>
                            </router-link>
                            <router-link to="/user/ordinary">
                                <el-menu-item index="/user/ordinary">
                                    <i class="iconfont icon-yonghu"></i>
                                    <span slot="title">用户管理</span>
                                </el-menu-item>
                            </router-link>
                            <router-link to="/user/order">
                                <el-menu-item index="/user/order">
                                    <i class="iconfont icon-dingdan"></i>
                                    <span slot="title">订单信息</span>
                                </el-menu-item>
                            </router-link>
                            <router-link to="/user/manager">
                                <el-menu-item index="/user/manager">
                                    <i class="iconfont icon-iconset0178"></i>
                                    <span slot="title">管理员信息</span>
                                </el-menu-item>
                            </router-link>
                        </el-menu>
                    </el-col>
                </el-row>
            </div>
            <div class="right">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
import adminClassifyAll from './adminClassifyAll.vue';
import adminClassifyFine from './adminClassifyFine.vue';
import adminClassifyBrand from './adminClassifyBrand.vue';
import adminPart from './adminPart.vue';
import adminOrdinaryUsers from './adminOrdinaryUser.vue'
import adminManagerUsers from './adminManagerUser.vue'
import adminOrder from './adminOrder.vue'
import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const routes = [
    { path: '/classify/all', component: adminClassifyAll },
    { path: '/classify/fine', component: adminClassifyFine },
    { path: '/classify/brand', component: adminClassifyBrand },
    { path: '/parts', component: adminPart },
    { path: '/user/ordinary', component: adminOrdinaryUsers },
    { path: '/user/manager', component: adminManagerUsers },
    { path: '/user/order', component: adminOrder },
    { path: '*', redirect: '/classify/all' },
];

const router = new Router({
    routes
})
export default {
    name: 'adminMain',
    methods: {
        handleOpen(key, keyPath) {
            console.log(key, keyPath);
        },
        handleClose(key, keyPath) {
            console.log(key, keyPath);
        }
    },
    router
}
</script>
<style>
#adminMain {
    display: flex;
    height: 100%;
}

.left {
    flex-shrink: 0;
    background-color: rgb(84, 92, 100);
    height: 100%;
    box-sizing: content-box;
}

.el-menu-vertical-demo:not(.el-menu--collapse) {
    width: 200px;
    min-height: 400px;
}

.el-menu {
    border-width: 0;
}

.right {
    flex-shrink: 1;
    overflow: hidden;
    width: 100%;
    height: 100%;
    padding: 0 20px 10px;
    background-color: #E5E9F2;
}

.demo-table-expand {
    font-size: 0;
}

.demo-table-expand label {
    width: 90px;
    color: #99a9bf;
}

.demo-table-expand .el-form-item {
    margin-right: 0;
    margin-bottom: 0;
    width: 50%;
}
</style>