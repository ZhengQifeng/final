<template>
    <div id="home">
        <searchHide v-bind:class="{active:hide}"></searchHide>
        <siteNav></siteNav>
        <searchBox></searchBox>
        <displayBar></displayBar>
        <carBrand></carBrand>
        <carProduct></carProduct>
        <template v-for="(item, index) in classifiedTitle">
            <classifiedProduct v-bind:item='item' v-bind:classIndex='index'></classifiedProduct>
        </template>
    </div>
</template>
<script>
import searchHide from './homeComponents/searchHide.vue'
import siteNav from './homeComponents/siteNav.vue'
import searchBox from './homeComponents/searchBox.vue'
import displayBar from './homeComponents/displayBar.vue'
import carBrand from './homeComponents/carBrand.vue'
import carProduct from './homeComponents/carProduct.vue'
import classifiedProduct from './homeComponents/classifiedProduct.vue'
import store from './homeStores/index.js'
import { mapState } from 'vuex';
import { mapActions } from "vuex";
export default {
    name: 'home',
    data() {
        return {
            scrolled: 0,
            hide: false,
            classifiedTitle: classify
        }
    },
    components: {
        siteNav,
        searchBox,
        displayBar,
        carBrand,
        searchHide,
        carProduct,
        classifiedProduct
    },
    store,
    methods: {
        handleScroll() {
            this.scrolled = window.scrollY;
            if (this.scrolled > 158) {
                this.hide = true;
            } else {
                this.hide = false;
            }
        }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll)
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

#home {
    display: flex;
    flex-direction: column;
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

.el-carousel__container {
    height: 100%;
}
</style>