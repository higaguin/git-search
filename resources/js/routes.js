import Vue from "vue";
import Router from "vue-router";
import Home from "@/js/views/Home.vue";
import User from "@/js/views/User.vue";

Vue.use(Router);

export default new Router({
  mode: "history",
  routes: [
    {
      path: "/",
      name: "home",
      component: Home
    },
    {
      path: "/user/:id",
      name: "user",
      component: User
    }
  ]
});
