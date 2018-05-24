<template>
    <div id="app">
        <loginlogo></loginlogo>
        <div id="login-title">
            <router-link v-for="(item,$index) in links" :key="item.name" active-class="active" ref="titleA" :to="item.to"><span>{{item.name}}</span></router-link>
        </div>
        <div id="login-main">
            <keep-alive>
                <router-view></router-view>
            </keep-alive>
        </div>
    </div>
</template>
<script>
import login from './loginComponents/login.vue'
import register from './loginComponents/register.vue'
import loginlogo from './loginComponents/loginLogo.vue'
import Vue from 'vue'
import Router from 'vue-router'
import store from './loginStores/index.js'

Vue.use(Router);

const routes = [
    { path: '/login', component: login },
    { path: '/register', component: register },
    { path: '*', redirect: '/login' },
];

const router = new Router({
    routes
})

export default {
    name: 'app',
    data() {
        return {
            links: [
                { 'to': 'login', isActive: true, 'name': '登录' }, 
                { 'to': 'register', 'name': '注册' }
            ]
        }
    },
    store,
    components: {
        loginlogo
    },
    router,
}
</script>
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
}

#app {
    width: 300px;
    height: 420px;
}

#login-title {
    display: flex;
    justify-content: center;
    padding: 0 3rem;
    width: 100%;
    height: 2rem;
    line-height: 2rem;
    margin-bottom: 1rem;
}

#login-title>a {
    padding: 0 20px;
}

#login-title span {
    padding: 0 3px;
}

#login-title a.active {
    color: #1E8AE8;
}

#login-title a.active>span {
    border-bottom: 2px solid #1E8AE8;
}

form {
    width: 100%;
}

.form-child {
    display: flex;
    padding: 15px 10px;
}

.form-child:not(:last-child) {
    border-bottom: 1px solid #999;
}

.form-inp-all {
    width: 100%;
}

.login-aux {
    margin-top: 1rem;
    display: flex;
    justify-content: space-between;
}

.login-aux>span {
    cursor: pointer;
}
.vfc-inp {
    width: 100%;
    display: flex;
}

.vfc-inp>input {
    width: 70%;
}

.vfc-btn {
    color: #1E8AE8;
    border-left: 1px solid #999;
    width: 40%;
    cursor: pointer;
    text-align: center;
}

.btn {
    width: 100%;
    text-align: center;
    padding: 10px;
    background-color: #1E8AE8;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
}
</style>