import Vue from "vue";
import App from "./App.vue";

import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

import BootstrapVue from "bootstrap-vue";

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

import { library } from "@fortawesome/fontawesome-svg-core";
import {
  faLeaf,
  faGlobeAmericas,
  faChartBar,
  faBriefcase,
  faUser,
  faBuilding,
  faEnvelope,
  faMapMarkerAlt
} from "@fortawesome/free-solid-svg-icons";

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(
  faLeaf,
  faGlobeAmericas,
  faChartBar,
  faBriefcase,
  faUser,
  faBuilding,
  faEnvelope,
  faMapMarkerAlt
);

Vue.component("font-awesome-icon", FontAwesomeIcon);

Vue.config.productionTip = false;
Vue.use(BootstrapVue);

new Vue({
  render: h => h(App)
}).$mount("#app");
