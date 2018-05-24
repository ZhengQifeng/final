<template>
    <div>
        <div id="newsMain">
            <el-upload class="avatar-uploader" action="/final/admin/imgUpload" :show-file-list="true" :on-change="changeFile" :before-upload="beforeAvatarUpload" style="margin: 0 auto;width: 120px;height: 120px;background-color: #fff;border-radius: 50%;box-shadow: 0px 0px 2px rgba(0,0,0,.7);border: 2px solid rgba(0,0,0,.4);;overflow: hidden;">
                <img v-if="editData.pic_src" :src="editData.pic_src" class="avatar" style="width: 120px; height: 120px;">
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
            </el-upload>
            <el-form ref="form" :model="editData" label-width="120px" style="padding: 20px;">
                <el-form-item label="用户名称">
                    <el-input v-model="editData.name"></el-input>
                </el-form-item>
                <el-form-item label="用户手机号">
                    <el-input v-model="editData.phone" :disabled="true"></el-input>
                </el-form-item>
                <el-form-item label="用户密码">
                    <el-input v-model="editData.password"></el-input>
                </el-form-item>
                <el-form-item label="头像地址">
                    <el-input v-model="editData.pic_src"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="updateSubmit()">提交</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>
<script>
export default {
    name: 'newsMain',
    data() {
        return {
            editData: resultUser[0],
        }
    },
    methods: {
        changeFile(file, fileList) {
            var This = this;
            //this.imageUrl = URL.createObjectURL(file.raw);
            var reader = new FileReader();
            reader.readAsDataURL(file.raw);
            reader.onload = function(e) {
                this.result // 这个就是base64编码了
                This.editData.pic_src = this.result;
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
        updateSubmit() {
            var data = {};
            data.data = this.editData;
            var that = this;
            this.$http.post('/final/userNews/Updata', data, { emulateJSON: true }).then((response) => {
                that.editData = response.body.data[0];
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
#newsMain {
    width: 600px;
    box-shadow: 0px 0px 4px rgba(0, 0, 0, .3);
    border-radius: 5px;
    margin: 40px auto 0;
    padding-top: 20px;
}
</style>