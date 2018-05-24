<template>
    <div>
        <div id="screenBox">
            <div class="screen-number"><span>共查询{{numbers}}结果</span></div>
            <div class="screen-brand">
                <div class="title">品牌：</div>
                <ul class="word">
                    <li v-for="item in brands">
                        <a v-bind:href="identUrl(item.ident)">
                            <img v-bind:src="item.src">
                            <div class="word"><span>{{item.name}}</span></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="screen-bar">
                <li v-bind:class="sort == '' ? 'active' : ''">
                    <a v-bind:href="getUrl('')">
                        <span>相关度</span>
                        <span class="iconfont icon-msnui-arrow-down"></span>
                    </a>
                </li>
                <li v-bind:class="sort == 'sale' ? 'active' : ''">
                    <a v-bind:href="getUrl('sale=-1')">
                        <span>销量</span>
                        <span class="iconfont icon-msnui-arrow-down"></span>
                    </a>
                </li>
                <li v-bind:class="sort == 'price' ? 'active' : ''">
                    <a v-bind:href="getUrl('price=-1')">
                        <span>价格</span>
                        <span class="iconfont icon-msnui-arrow-down"></span>
                    </a>
                </li>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'screenBox',
    data() {
        return {
            brands: brandData,
            numbers: count,
            queryUrl: urlQuery,
            sort: sort
        }
    },
    methods: {
        getUrl: function(val) {
            if (val == '') {
                return `./searchProduct?${this.queryUrl}`;
            } else {
                return `./searchProduct?${this.queryUrl}&sortType&${val}`
            }
        },
        identUrl: function(val) {
            return `./searchProduct?${this.queryUrl}&brand_ident=${val}`;
        }
    }
}
</script>
<style scoped>
#screenBox>* {
    padding: 10px 0;
    border-bottom: 1px solid #e5e5e5;
}

.screen-number {
    display: flex;
    justify-content: flex-end;
    color: #888;
}

.screen-brand {
    display: flex;
}

.screen-brand>.title {
    flex-shrink: 0;
    width: 60px;
    text-align: center;
}

.screen-brand>.word {
    display: flex;
    flex-shrink: 1;
    width: 100%;
    padding: 0 20px;
}

.screen-brand>.word>li {
    margin: 0 10px 10px 0;
}

.screen-brand>.word>li {
    position: relative;
    width: 100px;
    height: 80px;
    padding: 10px 20px;
    border: 1px solid #e5e5e5;
    margin: -1px -1px 0 0;
}

.screen-brand>.word>li img {
    width: 60px;
    height: 60px;
}

.screen-brand>.word>li .word {
    display: none;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 1000;
    top: -74px;
    left: -21px;
    width: 100px;
    height: 80px;
    border: 2px solid #1E8AE8;
    color: #1E8AE8;
    font-weight: 600;
    background-color: #F7F5F5;
    cursor: pointer;
}

.screen-brand>.word>li:hover .word {
    display: flex;
}

#screenBox>.screen-bar {
    display: flex;
    padding-left: 80px;
}

.screen-bar>li:not(:last-child) {
    border-right: 1px solid #e5e5e5;
}

.screen-bar>li>a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 80px;
    height: 40px;
    padding: 0 10px;
    background-color: #F7F5F5;
}

.screen-bar>li.active,
.screen-bar>li.active .iconfont {
    color: #1E8AE8;
}

.screen-bar .iconfont {
    color: #888;
    cursor: pointer;
}
</style>