export default{
	UPDATEUSER(state, value) {
        state.user.phone = value;
    },
    UPDATELOGINSTATE(state, value){
    	state.loginState = value;
    }
}