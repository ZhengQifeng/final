import Vue from 'vue'
import App from './App.vue'
import 'element-ui/lib/theme-default/index.css'
import VueResource from 'vue-resource'
import ElementUi from 'element-ui'

Vue.use(ElementUi);
Vue.use(VueResource);

Vue.config.productionTip = false;

new Vue({
  el: '#app',
  render: h => h(App)
})
