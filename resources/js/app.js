import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify';
import VueApollo from 'vue-apollo';

import Routes from '@/js/routes.js';

import App from '@/js/views/App';

import ApolloClient from 'apollo-boost';

const apolloClient = new ApolloClient({
  uri: 'https://api.github.com/graphql',
  request: operation => {
    operation.setContext({
      headers: {
        authorization: 'Bearer ' + process.env.MIX_GIT_TOKEN
      },
    });
  }
}) 

const apolloProvider = new VueApollo({
    defaultClient: apolloClient,
})

Vue.use(VueApollo)
Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    router: Routes,
    apolloProvider,
    render: h => h(App)
});

export default app;