<template>
  <div>
    <nav class="navbar navbar-light navbar-expand bg-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link :to="{name: 'home'}" class="nav-link">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{name: 'about'}" class="nav-link">About</router-link>
        </li>
      </ul>
    </nav>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>
