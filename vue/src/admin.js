import Vue from 'vue'
import Admin from './Admin.vue'
import 'element-ui/lib/theme-default/index.css'
import './assets/font_613424_xah3rmjh1r553ik9/iconfont.css'
import VueResource from 'vue-resource'
import ElementUi from 'element-ui'

Vue.use(ElementUi);
Vue.use(VueResource);

Vue.config.productionTip = false;

new Vue({
  el: '#admin',
  render: h => h(Admin)
});
