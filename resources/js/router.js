import Vue from 'vue';
import VueRouter from 'vue-router';
import Accueil from './components/Accueil';
import Home from './components/Home';

Vue.use(VueRouter)

const router = new VueRouter({
  mode: "history",
  routes: [
      {
          path: "/accueil",
          component: Accueil
      },
      {
          path: "/home",
          component: Home
      },
   
  ]
});

export default router