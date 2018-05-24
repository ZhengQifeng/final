export default {
    vfc(state) {
        if (state.vfcTime == '获取验证码' || state.vfcTime == '重新发送') {
            var time = 59;
            state.vfcTime = 60;
            var interval = setInterval(() => {
                state.vfcTime = time;
                if (state.vfcTime < 0) {
                    state.vfcTime = '重新发送';
                    clearInterval(interval);
                }
                time--;
            }, 1000);
        }
    }
}