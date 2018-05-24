<template>
    <div>
        <div id="adminHeader">
            <div class="logo">
                <img src="/final/src/image/logo.png" alt="">
            </div>
            <el-dropdown>
                <img class="el-dropdown-link" :src="managerUserHead"/>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item><a href="/final/login">退出</a></el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import { mapGetters } from 'vuex';
export default {
    name: 'adminHeader',
    computed: { ...mapState(['managerUserHead']) }
}
</script>
<style scoped>
#adminHeader {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-right: 40px;
    width: 100%;
    height: 100%;
    background-color: #434A4F;
}
.logo{
    width: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.logo>img{
    width: 120px;
}
#adminHeader>.el-dropdown img{
	width: 40px;
	height: 40px;
	background-color: #fff;
	border-radius: 50%;
	box-shadow: 2px 2px 2px rgba(0,0,0,.7);
	border: 2px solid rgba(0,0,0,.4);
	cursor: pointer;
}
</style>