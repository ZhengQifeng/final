<template>
    <div>
        <div id="displayBar">
            <div class="main-div">
                <nav>
                    <ul>
                        <li class="navTitle">配件类型</li>
                        <li v-for="item in nav">
                            <a v-bind:href="fittingHref(item.fitting_ident)"><span>{{item.title}}</span><i class="iconfont" v-bind:class="item.i"></i></a>
                        </li>
                    </ul>
                </nav>
                <div class="block">
                    <el-carousel trigger="click">
                        <el-carousel-item style="height: 100%" v-for="item in showImg" :key="item.src">
                            <img v-bind:src="item.src" alt="item.alt">
                        </el-carousel-item>
                    </el-carousel>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'displayBar',
    data() {
        return {
            nav: fitting,
            showImg: [{'alt':'汽车图片1','src':'https://images.pexels.com/photos/170811/pexels-photo-170811.jpeg?h=350&auto=compress&cs=tinysrgb 1x, https://images.pexels.com/photos/170811/pexels-photo-170811.jpeg?h=350&dpr=2&auto=compress&cs=tinysrgb 2x'},{'alt':'汽车图片2','src':'https://images.pexels.com/photos/120049/pexels-photo-120049.jpeg?h=350&auto=compress&cs=tinysrgb 1x, https://images.pexels.com/photos/120049/pexels-photo-120049.jpeg?h=350&dpr=2&auto=compress&cs=tinysrgb 2x'},{'alt':'汽车图片3','src':'https://images.pexels.com/photos/210019/pexels-photo-210019.jpeg?h=350&auto=compress&cs=tinysrgb 1x, https://images.pexels.com/photos/210019/pexels-photo-210019.jpeg?h=350&dpr=2&auto=compress&cs=tinysrgb 2x'},{'alt':'汽车图片4','src':'https://images.pexels.com/photos/50704/car-race-ferrari-racing-car-pirelli-50704.jpeg?h=350&auto=compress&cs=tinysrgb 1x, https://images.pexels.com/photos/50704/car-race-ferrari-racing-car-pirelli-50704.jpeg?h=350&dpr=2&auto=compress&cs=tinysrgb 2x'}]
        }
    },
    methods:{
        fittingHref: function(val){
            return `./searchProduct?fitting_ident=${val}`;
        }
    }
}
</script>
<style scoped>
#displayBar {
    margin-top: 20px;
}

.main-div {
    display: flex;
}

nav {
    border: 1px solid #ccc;
    flex-shrink: 0;
}

nav ul {
    position: relative;
    width: 160px;
    display: flex;
    flex-direction: column;
    list-style: none;
}

.navTitle {
    position: absolute;
    width: 162px;
    height: 40px;
    padding-left: 20px;
    text-align: left;
    top: -40px;
    left: -1px;
    background-color: #1E8AE8;
    color: white;
    font-size: 0.9rem;
    font-weight: 500;
}

nav li {
    padding: 0 20px;
    width: 100%;
    height: 40px;
    display: flex;
    cursor: pointer;
    flex-direction: row;
    align-items: center;
}

nav li:not(:first-child):hover{
    background-color: #ecf5ff;
    color: #409eff;
}

nav li span {
    display: inline-block;
    width: 80px;
}

.block{
	width: 100%;
	flex-shrink: 1;
	padding: 0px 0px 0px 20px;
}

.el-carousel{
	height: 100%;
}

.el-carousel__item img {
    width: 100%;
    height: 100%;
    margin: 0;
}

.el-carousel__container{
    height: 100%;
}
</style>