export default{
    updateUser({commit}, value){
        commit('UPDATEUSER', value)
    },
    updateLoginState({commit}, value){
        commit('UPDATELOGINSTATE', value)
    }
}