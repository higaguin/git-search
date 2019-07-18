<template>
  <v-container>
    <v-layout text-xs-center wrap>
      <v-flex xs10>
        <v-text-field
          v-model="input_search"
          placeholder="Buscar usuario de Github"
          solo
          clearable
        ></v-text-field>
      </v-flex>
      <v-flex xs2>
        <v-btn large @click="onSearch">Buscar</v-btn>
      </v-flex>
      <v-flex offset-xs1 xs10>
        <UserCard :username="search" :send_data="{user}" :showHistory="true"></UserCard>
      </v-flex>
    </v-layout>
    <v-snackbar
      v-model="snackbar"
      :timeout="6000">
      {{ text_snackbar }}
      <v-btn dark flat @click="snackbar = false">
        Close
      </v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
import gql from 'graphql-tag';
import UserCard from '../components/UserCard';
import axios from 'axios';

export default {
  data: () => ({
    input_search: '',
    search: '',
    user: null,
    snackbar: false,
    text_snackbar: ''
  }),
  methods: {
    onSearch() {
      this.search = this.input_search;
      this.triggerMyQuery();
    },
    triggerMyQuery () {
      this.$apollo.queries.user.skip = false
      this.$apollo.queries.user.refetch().then(() => {
      this.saveUser();
      });
    },
    saveUser () {
      let send_item = this.user;
      axios.post('/api/save_git_user', { name: send_item.login, 
                                          bio: send_item.bio, 
                                          company: send_item.company,
                                          email: send_item.email,
                                          location: send_item.location,
                                          isHireable: send_item.isHireable,
                                          isEmployee: send_item.isEmployee,
                                          createdAt: send_item.createdAt,
                                          avatarUrl: send_item.avatarUrl }).then(res => {
        this.text_snackbar = res.data.response;
        this.snackbar = true;
      });
    }
  },
  apollo: {
    user: {
      query() {
        return gql` query getUser($search: String!) {
          user(login:$search) {
            login
            avatarUrl
            bio
            company
            email
            websiteUrl
            location
            isHireable
            isEmployee
            createdAt
          }
        }
        `
      },
      variables () {
        return {
            search: this.search,
        }
      },
      skip() {
        return true
      },
    }
  },
  components: {
    UserCard
  }
};
</script>

<style></style>
