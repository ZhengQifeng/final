<template>
    <div style="height: 100%">
        <div class="adminBox" id="adminagerManUser">
            <div class="breadcrumb">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>管理员信息</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
            <div class="main">
                <div class="search-form">
                    <el-form ref="form" :model="managerUser" label-width="80px">
                        <el-form-item label="管理名称">
                            <el-input v-model="managerUser.name"></el-input>
                        </el-form-item>
                        <el-form-item label="手机号">
                            <el-input v-model="managerUser.phone"></el-input>
                        </el-form-item>
                        <el-form-item label="密码">
                            <el-input v-model="managerUser.password"></el-input>
                        </el-form-item>
                        <el-form-item label="头像">
                            <el-upload class="avatar-uploader" action="/final/admin/imgUpload" :show-file-list="true" :on-change="changeFile" :before-upload="beforeAvatarUpload">
                                <img v-if="managerUser.pic_src" :src="managerUser.pic_src" class="avatar">
                                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                            </el-upload>
                            <el-input v-model="managerUser.pic_src"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="managerUpdata()">立即修改</el-button>
                            <el-button>取消</el-button>
                        </el-form-item>
                    </el-form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import { mapGetters } from 'vuex';
export default {
    name: 'adminagerManUser',
    computed: { ...mapState(['managerUser']) },
    methods: {
        changeFile(file, fileList) {
            var This = this;
            //this.imageUrl = URL.createObjectURL(file.raw);
            var reader = new FileReader();
            reader.readAsDataURL(file.raw);
            reader.onload = function(e) {
                this.result // 这个就是base64编码了
                This.managerUser.pic_src = this.result;
            }
        },
        beforeAvatarUpload(file) {
            const isJPG = file.type === 'image/jpeg';
            const isPNG = file.type === 'image/png';
            const isLt2M = file.size / 1024 / 1024 < 2;
            if (!isLt2M) {
                this.$message.error('上传头像图片大小不能超过 2MB!');
            }
            return isLt2M;
        },
        managerUpdata() {
            var data = {};
            data.data = this.managerUser;
            var that = this;
            this.$http.post('/final/admin/managerUser/Updata', data, { emulateJSON: true }).then((response) => {
                that.$store.dispatch("updateManagerUserHead", that.managerUser.pic_src);
                // that.$http.post('/final/admin/managerUser', { emulateJSON: true }).then((response) => {
                //     that.manager = response.body.data[0];
                // });
                that.$message({
                    message: response.body.message,
                    type: 'success'
                });
            });
        }
    }
}
</script>
<style>
.adminBox .main {
    background-color: #fff;
}

.el-form {
    width: 50%;
}

.adminBox .search-form .el-form-item {
    margin-bottom: 22px;
}
</style>