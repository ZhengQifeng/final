<template>
    <div>
        <div id="register">
            <form>
                <div class="form-child">
                    <input class="form-inp-all" type="text" name="username" placeholder="手机号或邮箱号" v-model="val.username">
                </div>
                <div class="form-child">
                    <input class="form-inp-all" type="password" name="userpass" placeholder="密码" v-model="val.password">
                </div>
                <div class="vfc-inp form-child">
                    <input class="form-inp" type="number" name="verificationCode" placeholder="请输入验证码" v-model="val.vfc">
                    <div class="vfc-btn" @click="vfc()">{{vfcTime}}</div>
                </div>
            </form>
        </div>
        <div class="btn" @click="register()">注册</div>
    </div>
</template>
<script>
import { Message } from 'element-ui';
import {mapState} from 'vuex';
import {mapGetters} from 'vuex';
export default ({
    name: 'register',
    computed: {...mapState(['val','vfcTime'])},
    methods: {
        ...mapGetters(["vfc"]),
        register() {
            if (this.val.username == '' || !(this.val.username.match(/^((1)+\d{10})$/) || this.val.username.match(/^((1)+\d{10})$/) || this.val.username.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/))) {
                Message.error('请输入有效的账号');
            }else if(this.val.password == ''){
            	Message.error('请输入有效的密码');
            }else if (this.val.vfc == '' || this.val.vfc.length != 4) {
                Message.error('请输入4位有效的验证码');
            }else {
                var that = this;
                this.$http.post(
                    'login/addUsers', 
                    { 'phone': that.val.username, 
                      'password': that.val.password
                    },
                    {emulateJSON: true}
                ).then(function(response) {
                    if(response.body.code == 0) {
                        Message.error(response.body.message);
                    }
                    if(response.body.code == 1) {
                        Message.success(response.body.message);
                        setTimeout(
                            function(){ 
                                window.location.href="home"; 
                        },1000);
                    }
                });
            }
        }
    }
})
</script>
<style scoped>
div:first:child {
    background-color: #fff;
}

#register {
    width: 100%;
    border: 1px solid #999;
    border-radius: 5px;
    background-color: #fff;
    margin-bottom: 20px;
}
</style>