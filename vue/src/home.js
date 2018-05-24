import Vue from 'vue'
import Home from './Home.vue'
import 'element-ui/lib/theme-default/index.css'
import './assets/font_480092_zy6y3fk4eqw1m7vi/iconfont.css'
import VueResource from 'vue-resource'
import ElementUi from 'element-ui'

Vue.use(ElementUi);
Vue.use(VueResource);

Vue.config.productionTip = false;

new Vue({
  el: '#home',
  render: h => h(Home)
});
