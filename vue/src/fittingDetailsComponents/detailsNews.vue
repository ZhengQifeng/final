<template>
    <div>
        <div id="detailsNews">
            <div class="pic">
                <img v-bind:src="news.src">
            </div>
            <div class="word">
                <h2 class="title">{{news.name}}</h2>
                <div class="main">
                	<div>商家：{{news.business_name}}</div>
                    <div>销量：<span>{{news.sale}}</span></div>
                    <div class="price">价格：<span class="word">{{news.price}}</span></div>
                    <div>库存：<span v-if="news.stock > 0">有货，下单后立即发货</span><span v-else>当前无货，请下次购买</span></div>
                    <div>产地：{{news.origin_place}}</div>
                    <div class="number">数量：
                        <el-input-number v-model="sellerNumber" size="small" :min="1" :max="news.stock"></el-input-number>
                        <span class="stock">库存：{{news.stock}}</span>
                    </div>
                </div>
                <div class="buy-group">
                    <el-button-group>
                        <el-button type="primary" icon="el-icon-arrow-left">立即购买</el-button>
                        <el-button @click = "add()">加入购物车<i class="el-icon-arrow-right el-icon--right"></i></el-button>
                    </el-button-group>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'detailsNews',
    data() {
        return {
            news: partResult,
            sellerNumber: 1,
        }
    },
    methods: {
        add(){
            var data = {};
            data.data = this.news;
            data.seller = this.sellerNumber;
            var that = this;
            this.$http.post('/final/fittingDetails/add', data, { emulateJSON: true }).then((response) => {
                if (response.body.code == 0) {
                    that.$message({
                        message: response.body.message,
                        type: 'error'
                    });
                }else if (response.body.code == 1) {
                    that.$message({
                        message: response.body.message,
                        type: 'success'
                    });
                }
            });
        }
    }
}
</script>
<style>
#detailsNews {
    display: flex;
}

#detailsNews>.pic {
    flex-shrink: 0;
    width: 350px;
    height: 350px;
}

#detailsNews>.pic>img {
    width: 350px;
    height: 350px;
}

#detailsNews>.word {
    display: flex;
    flex-direction: column;
    flex-shrink: 1;
    overflow: hidden;
    width: 100%;
    height: 350px;
    margin-left: 20px;
}

#detailsNews>.word>.title,
.buy-group {
    flex-shrink: 0;
}

#detailsNews>.word>.main {
	padding: 5px 0;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    flex-shrink: 1;
    overflow: hidden;
    height: 100%;
}

.price>.word {
    color: #1E8AE8;
    font-size: 22px;
}

#detailsNews .el-input-number {
    width: 120px;
}

.stock {
    display: inline-block;
    margin-left: 5px;
}
</style>