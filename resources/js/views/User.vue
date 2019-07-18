<template>
    <v-container>
        <v-layout v-for="(user, key) in history_details" text-xs-center wrap v-bind:key="key">
            <v-flex xs10>
                <UserCard :username="$route.params.id" :send_data="{user}"></UserCard>
            </v-flex>
        </v-layout>
    </v-container>
</template>
<script>
import UserCard from '../components/UserCard';
import axios from 'axios';

export default {
    components: {
        UserCard
    },
    data: () => ({
        history_details: []
    }),
    created() {
        axios.get('/api/get_history/' + this.$route.params.id).then((res) => {
            this.history_details = res.data.response;
        });
    }
}
</script>
