<template>
    <div style="height: 100%">
        <div id="admin">
            <adminHeader class="top"></adminHeader>
            <adminMain class="bottom"></adminMain>
        </div>
    </div>
</template>
<script>
import adminHeader from './adminComponents/adminHeader.vue'
import adminMain from './adminComponents/adminMain.vue'
import store from './adminStores/index.js'
import { mapState } from 'vuex';
import { mapActions } from "vuex";
export default {
    name: 'admin',
    store,
    mounted() {
        this.$http.post('/final/admin/managerUser', { emulateJSON: true }).then((response) => {
            var manager = response.body.data[0];
            this.$store.dispatch("updateManagerUser", manager);
            this.$store.dispatch("updateManagerUserHead", manager.pic_src);
        });
    },
    components: {
        adminHeader,
        adminMain
    }
}
</script>
<style>
html {
    width: 100%;
    height: 100%;
    font-size: 20px;
}

body {
    width: 100%;
    height: 100%;
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

#admin {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.top {
    flex-shrink: 0;
    height: 56px;
}

.bottom {
    flex-shrink: 1;
    overflow: hidden;
    height: 100%;
}

.iconfont {
    font-weight: 600;
}

.adminBox {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
}

.adminBox .breadcrumb {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    width: 100%;
    height: 56px;
}

.adminBox .main {
    display: flex;
    flex-direction: column;
    flex-shrink: 1;
    overflow: hidden;
    width: 100%;
    height: 100%;
}

.adminBox .search-form {
    flex-shrink: 0;
    padding: 15px 15px 5px;
    background-color: #fff;
}

.adminBox .search-form .el-form-item {
    margin-bottom: 0;
}

.adminBox .search-main {
    flex-shrink: 1;
    height: 100%;
    overflow: hidden;
}

.el-table td:first-child .cell,
.el-table th:first-child .cell {
    padding-left: 5px;
}

.el-table__body-wrapper {
    max-height: 100%;
}

.el-table {
    display: flex;
    flex-direction: column;
}

.el-table__header-wrapper {
    flex-shrink: 0;
}

.el-table__body-wrapper.is-scroll-left {
    flex-shrink: 1;
}

.el-dialog__body {
    max-height: 50vh;
    overflow: auto;
}

.avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
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
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
}

.avatar {
    width: 178px;
    height: 178px;
    display: block;
}

.el-upload-list{
    display: none;
}

.el-table td, .el-table th{
    padding-left: 5px;
}
</style>