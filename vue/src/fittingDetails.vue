<template>
    <div id="fittingDetails">
        <siteNav></siteNav>
        <searchBox></searchBox>
        <detailsMain></detailsMain>
    </div>
</template>
<script>
import siteNav from './homeComponents/siteNav.vue'
import searchBox from './homeComponents/searchBox.vue'
import detailsMain from './fittingDetailsComponents/detailsMain.vue'
import store from './homeStores/index.js'
import { mapState } from 'vuex';
import { mapActions } from "vuex";
export default {
    name: 'fittingDetails',
    components: {
        siteNav,
        searchBox,
        detailsMain
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

ul,li{
    padding: 0;
    list-style: none;
}

a, a:link, a:visited, a:hover, a:active{
    text-decoration:none;
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

#fittingDetails {
    padding-bottom: 40px;
}

.main-div {
    width: 1080px;
    padding: 0 5px;
    margin: 0 auto;
}

.hoverChange {
    position: relative;
    top: 0;
    cursor: pointer;
    transition: .1s;
}

.hoverChange:hover {
    background-color: #DCDCDC;
    top: -5px;
}
</style>