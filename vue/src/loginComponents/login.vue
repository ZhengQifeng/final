<template>
    <div>
        <div id="login">
            <form>
                <div class="form-child">
                    <input class="form-inp-all" type="text" name="username" placeholder="手机号或邮箱号" v-model="val.username">
                </div>
                <div :class="{'form-child':true, 'hidden': isHidden}" id="password">
                    <input class="form-inp-all" type="password" name="userpass" placeholder="密码" v-model="val.password" @keyup.13="login()">
                    <div class="vfc-inp">
                        <input class="form-inp" type="number" name="verificationCode" placeholder="请输入验证码" v-model="val.vfc">
                        <div class="vfc-btn" @click="vfc()">{{vfcTime}}</div>
                    </div>
                </div>
            </form>
        </div>
        <div class="btn" @click="login()">登录</div>
        <div class="login-aux">
            <span id="login-phone" @click="phoneShow()">{{btnWord}}</span>
            <span>无法登录？</span>
        </div>
    </div>
</template>
<script>
import { Message } from 'element-ui';
import { mapState } from 'vuex';
import { mapGetters } from 'vuex';
export default ({
    name: 'login',
    data() {
        return {
            isHidden: false,
            btnWord: '手机验证码登录'
        }
    },
    computed: { ...mapState(['val', 'vfcTime']) },
    methods: {
        phoneShow() {
            this.isHidden = !this.isHidden;
            this.btnWord == '手机验证码登录' ? this.btnWord = '密码登录' : this.btnWord = '手机验证码登录';
        },
        ...mapGetters(["vfc"]),
        login() {
            if (this.isHidden) {
                if (this.val.username == '' || !(this.val.username.match(/^((1)+\d{10})$/) || this.val.username.match(/^((1)+\d{10})$/) || this.val.username.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/))) {
                    Message.error('请输入有效的账号');
                } else if (this.val.vfc == '' || this.val.vfc.length != 4) {
                    Message.error('请输入4位有效的验证码');
                }
            } else {
                if (this.val.username == '' || !(this.val.username.match(/^((1)+\d{10})$/) || this.val.username.match(/^((1)+\d{10})$/) || this.val.username.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/))) {
                    Message.error('请输入有效的账号');
                } else if (this.val.password == '') {
                    Message.error('请输入有效的密码');
                } else {
                    var that = this;
                    this.$http.post(
                        'login/findUsers', {
                            'phone': that.val.username,
                            'password': that.val.password
                        }, { emulateJSON: true }
                    ).then(function(response) {
                        if (response.body.code == 1) {
                            Message.success(response.body.message);
                            setTimeout(function(){
                                window.location.href="home"; 
                            }, 1000)
                        } else if (response.body.code == 2) {
                            Message.success(response.body.message);
                            setTimeout(function(){
                                window.location.href="admin"; 
                            }, 1000)
                        } else if (response.body.code == 0) {
                            Message.error(response.body.message);
                        }
                    });
                }
            }
        }
    }
})
</script>
<style type="text/css" scoped>
/*使用scoped父元素(div)不能存在id class名字*/

div:first:child {
    background-color: #fff;
}

#login {
    width: 100%;
    border: 1px solid #999;
    border-radius: 5px;
    background-color: #fff;
    margin-bottom: 20px;
}

#password {
    position: relative;
    overflow: hidden;
}

#password>input {
    position: relative;
    left: 0px;
    top: 0px;
    transition: .5s linear;
}

#password.hidden>input {
    left: -100%;
}


#login-phone {
    color: #1E8AE8;
}

.vfc-inp {
    position: absolute;
    left: 100%;
    top: 12px;
    transition: .5s linear;
}

.vfc-inp>input {
    width: 55%;
}

.vfc-btn {
    padding: 3px 0;
}

.hidden>.vfc-inp {
    left: 10px;
}
</style>