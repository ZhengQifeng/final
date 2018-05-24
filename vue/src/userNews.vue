<template>
    <div id="userNews">
        <siteNav></siteNav>
        <newsMain></newsMain>
    </div>
</template>
<script>
import siteNav from './homeComponents/siteNav.vue'
import newsMain from './newComponents/newsMain.vue'
import store from './homeStores/index.js'
import { mapState } from 'vuex';
import { mapActions } from "vuex";
export default {
    name: 'userNews',
    data() {
        return {}
    },
    components: {
        siteNav,
        newsMain
    },
    store,
    mounted() {
        if (result == 0) {
            this.$store.dispatch("updateLoginState", false);
        } else {
            this.$store.dispatch("updateLoginState", true);
            this.$store.dispatch("updateUser", phone);
        }
    },
    computed: { ...mapState(['loginState']) }
}
</script>
<style>
html {
    width: 100%;
    font-size: 20px;
}

body {
    width: 100%;
    min-width: 1080px;
    font-size: 0.7rem;
    font-family: "Microsoft YaHei", tahoma, arial, 'Hiragino Sans GB', sans-serif;
}

* {
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
}

ul,
li {
    padding: 0;
    list-style: none;
}

a,
a:link,
a:visited,
a:hover,
a:active {
    text-decoration: none;
    color: inherit;
}

::-webkit-input-placeholder {
    /* WebKit browsers */
    color: #999;
    font-size: 0.7rem;
}

:-moz-placeholder {
    /* Mozilla Firefox 4 to 18 */
    color: #999;
    font-size: 0.7rem;
}

::-moz-placeholder {
    /* Mozilla Firefox 19+ */
    color: #999;
    font-size: 0.7rem;
}

:-ms-input-placeholder {
    /* Internet Explorer 10+ */
    color: #999;
    font-size: 0.7rem;
}

#userNews{
    padding-bottom: 40px;
}

.main-div {
    width: 1080px;
    padding: 0 5px;
    margin: 0 auto;
}

.avatar-uploader .el-upload {
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.avatar-uploader .el-upload:hover {
    border-color: #409EFF;
}

.avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 120px;
    height: 120px;
    line-height: 120px;
    text-align: center;
}

.avatar {
    width: 178px;
    height: 178px;
    display: block;
}
</style>