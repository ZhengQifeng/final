<template>
    <div>
        <div id="searchBox">
            <div class="main-div">
                <form class="searchForm">
                    <ul>
                        <li v-for="(item,$index) in searchClass" v-bind:class="{active: item.active}" v-on:click="selectStyle(item, $index)">{{item.title}}</li>
                    </ul>
                    <div>
                        <input class="searchIpt" v-model="searchData.data" type="text" name="search" v-bind:placeholder="placeholder">
                        <div class="searchBtn" @click="search()">
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
    name: 'searchBox',
    data() {
        return {
            searchClass: [
            { 'title': '类型', 'value': 'fitting_name', 'active': true, 'placeholder': '请输入配件类型' },
            { 'title': '品牌', 'value': 'brand_name', 'active': false, 'placeholder': '请输入配件品牌' },
            { 'title': '名称', 'value': 'name', 'active': false, 'placeholder': '请输入配件名称' },
            { 'title': '商家', 'value': 'business_name', 'active': false, 'placeholder': '请输入配件商家' }
            ],
            placeholder: '请输入配件类型',
            searchData: {
                'type': 'fitting_name',
                'data': ''
            },
        }
    },
    methods: {
        selectStyle(item, index) {　　　　　　
            this.$nextTick(function() {　　　　　　　　
                this.searchClass.forEach(function(item) {　　　　　　　　　　
                    item.active = false;　　　　　　　　
                });　　　　　　　　
                item.active = true;　
                this.placeholder = item.placeholder;　
                this.searchData.type = item.value;
            });　　　　
        },
        search() {
            window.location.href=`/final/searchProduct?${this.searchData.type}=${this.searchData.data}`;
        }
    }
}
</script>
<style scoped>
#searchBox {
    width: 100%;
}

#searchBox>div {
    height: 100px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}

ul {
    display: flex;
    list-style: none;
}

.searchForm {
    display: flex;
    flex-direction: column;
}

.searchForm li {
    padding: 7px 10px;
    font-size: 0.7rem;
    font-weight: 500;
    text-align: center;
    cursor: pointer;
}

.searchForm li.active {
    background-color: #1E8AE8;
    color: white;
}

.searchForm>div {
    display: flex;
    flex-direction: row;
}

.searchIpt {
    width: 400px;
    height: 40px;
    border: 2px solid #1E8AE8;
    border-right-width: 0px;
    padding: 5px;
    outline: none;
    color: #333;
    font-size: 0.8rem;
}

.searchBtn {
    display: flex;
    width: 70px;
    height: 40px;
    font-size: 1.4rem;
    font-weight: 700;
    color: white;
    background-color: #1E8AE8;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}
</style>