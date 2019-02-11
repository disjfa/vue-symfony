import Vue from 'vue';
import Router from 'vue-router';
import {
  About,
  CreateMovie,
  EditMovie,
  Home,
  NotFound,
} from './views';

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      title: 'Home',
      icon: 'fas fa-fw fa-home',
      component: Home,
    },
    {
      path: '/about',
      name: 'about',
      icon: 'fas fa-fw fa-info-circle',
      component: About,
    },
    {
      path: '/movie/create',
      name: 'movie-create',
      component: CreateMovie,
    },
    {
      path: '/movie/:id',
      name: 'movie-edit',
      component: EditMovie,
    },
    {
      path: '*',
      name: 'notfound',
      component: NotFound
    },
  ],
});
