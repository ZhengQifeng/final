<template>
    <div>
        <ul id="searchItems">
            <template v-if="totalSize > 0">
                <div class="items">
                    <li v-for="item in carItems" v-bind:dataid="item._id">
                        <a v-bind:href="partHref(item._id)">
                        <img v-bind:src="item.pic_src">
                        <div class="word">
                            <div class="name">{{item.name}}</div>
                            <div class="price">{{item.price}}</div>
                            <div class="seller">
                                <span>{{item.business_name}}</span>
                                <span class="number">{{item.sale}}人</span>
                            </div>
                        </div>
                    </a>
                    </li>
                </div>
                <div class="block" v-if="totalSize > 16">
                    <el-pagination @current-change="handleCurrentChange" :page-size="16" layout="prev, pager, next" :total="totalSize">
                    </el-pagination>
                </div>
            </template>
            <template v-else>
                <div class="items">
                    无查询结果，请重新查询
                </div>
            </template>
        </ul>
    </div>
</template>
<script>
export default {
    name: 'searchItems',
    data() {
        return {
            carItems: partsResult,
            totalSize: count,
            queryUrl: urlQuery,
            sort: sort
        }
    },
    methods: {
        partHref: function(val) {
            return `./fittingDetails?_id=${val}`;
        },
        handleCurrentChange(val) {
            var limitUrl = '';
            var data = { 'limit': val };
            if (this.sort == '') {
                limitUrl = `./searchProduct?${this.queryUrl}`;
            } else {
                limitUrl = `./searchProduct?${this.queryUrl}&sortType&${this.sort}=-1`;
            }
            this.$http.post(limitUrl, data, { emulateJSON: true }).then((response) => {
                this.carItems = response.body.data;
            });
        }
    }
}
</script>
<style scoped>
#searchItems {
    padding-top: 10px;
}

#searchItems>.items {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    padding-right: 3%;
}

#searchItems>.items>li {
    width: 22%;
    padding: 5px;
    margin-bottom: 20px;
    margin-left: 3%;
    border-radius: 3px;
    border: 2px solid white;
    cursor: pointer;
}

#searchItems>.items>li img {
    width: 100%;
}

#searchItems>.items>li .word {
    font-size: 14px;
}

#searchItems>.items>li .word>* {
    margin: 5px;
}

#searchItems>.items>li .name {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

#searchItems>.items>li .price {
    color: #1E8AE8;
    font-size: 16px;
}

#searchItems>.items>li .seller {
    display: flex;
    justify-content: space-between;
    color: #888;
}

#searchItems>.items>li:hover {
    border: 2px solid #1E8AE8;
}
</style>