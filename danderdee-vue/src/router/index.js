import Vue from "vue";
import VueRouter from "vue-router";

import PrivacyPolicy from "../views/PrivacyPolicy";
import Home from "../views/Home";
import NotFound from "../views/NotFound";
import Terms from "../views/Terms";

Vue.use(VueRouter);

export default new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/",
      name: "Home",
      component: Home
    },
    {
      path: "/privacy-policy",
      name: "PrivacyPolicy",
      component: PrivacyPolicy
    },
    {
      path: "/terms",
      name: "Terms",
      component: Terms
    },
    {
      path: "*",
      name: "NotFound",
      component: NotFound
    }
  ]
});
