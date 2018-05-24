<template>
    <div>
        <div id="siteNav">
            <div class="main-div">
                <ul>
                    <li v-for="item in loginNews">
                        <a v-bind:href="item.a">
                            {{item.title}}
                        </a>
                    </li>
                </ul>
                <ul class="userNews">
                    <a href="/final/userNews">
                        <li>我的车配</li>
                    </a>
                    <li class="shoppingCart">
                        <i class="iconfont icon-el-icon-gouwuche"></i>购物车<span>{{shoppingCart.count}}</span>件
                    </li>
                    <li>收藏夹</li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';
export default {
    name: 'siteNav',
    data() {
        return {
            loginNews: [{ 'title': '欢迎来到车配网','a': '/final/home' }, { 'title': '请登录','a': '/final/login#/login' }, { 'title': '免费注册', 'a': '/final/login#/register' }],
            shoppingCart: { 'count': '0' }
        }
    },
    computed: {
        ...mapState(['loginState','user'])
    },
    watch: {
        loginState: function(val) {
            this.loginNews = val ? [{ 'title': '欢迎来到车配网','a': '/final/home' }, { 'title': '您好,'+this.user.phone,'a': '/final/login#/login' }, { 'title': '退出', 'a': '/final/login#/login' }] : this.loginNews;
        }
    }
}
</script>
<style scoped>
#siteNav {
    display: flex;
    align-items: center;
    width: 100%;
    height: 38px;
    background-color: #F2F2F2;
    color: #999;
}

#siteNav>.main-div {
    font-size: 0.6rem;
    font-style: normal;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

ul {
    list-style: none;
    display: flex;
    align-items: center;
}

li {
    cursor: pointer;
    padding: 0 10px;
}

.shoppingCart>i {
    display: inline-block;
    color: #1E8AE8;
    font-size: 0.5rem;
    margin-right: 5px;
}

.shoppingCart>span {
    display: inline-block;
    color: #666;
    padding: 0 2px;
    font-weight: 700;
}
</style>