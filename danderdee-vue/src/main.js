import Vue from "vue";
import router from "./router";
import App from "./App.vue";

import axios from "axios";

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
  faMapMarkerAlt,
  faChevronCircleUp,
  faHome
} from "@fortawesome/free-solid-svg-icons";

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

import VueTyperPlugin from "vue-typer";

library.add(
  faLeaf,
  faGlobeAmericas,
  faChartBar,
  faBriefcase,
  faUser,
  faBuilding,
  faEnvelope,
  faMapMarkerAlt,
  faChevronCircleUp,
  faHome
);

Vue.component("font-awesome-icon", FontAwesomeIcon);

Vue.config.productionTip = false;

Vue.use(BootstrapVue);

Vue.use(VueTyperPlugin);

Vue.prototype.$http = axios;

new Vue({
  render: h => h(App),
  router
}).$mount("#app");
