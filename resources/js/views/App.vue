<template>
  <v-app>
    <v-toolbar app>
      <v-toolbar-title class="headline text-uppercase">
        <router-link to="/">
          <span>GITHUB</span>
          <span class="font-weight-light">USER SEARCH</span>
        </router-link>
      </v-toolbar-title>
    </v-toolbar>

    <v-content>
      <router-view></router-view>
    </v-content>
  </v-app>
</template>

<script>
// import Home from './Home'

export default {
  name: 'App',
}
</script>