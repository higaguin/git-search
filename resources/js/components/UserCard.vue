<template>
    <v-card v-if="user!=null">
        <v-card-text>
            <div>
                <div class="pb-2">
                    <v-avatar>
                        <img :src="user.avatarUrl" alt="Image">
                    </v-avatar>
                    <div class="headline">{{ username }}</div>
                </div>
                <b>Biografía: </b>{{ user.bio }}</br>
                <b>Compañia: </b>{{ user.company }}</br>
                <b>Email: </b>{{ user.email }}</br>
                <b>Sitio Web: </b><a :href="user.websiteUrl">{{ user.websiteUrl }}</a></br>
                <b>Locación: </b>{{ user.location }}</br>
                <b>Es contratable: </b>{{ user.isHireable ? 'Si' : 'No' }}</br>
                <b>Es empleado: </b>{{ user.isEmployee ? 'Si' : 'No' }}</br>
                <b>Creado en: </b>{{ user.createdAt }}
            </div>
        </v-card-text>
        <v-card-actions>
            <v-btn v-if="showHistory" :to="'user/' + username" flat>Historial</v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
export default {
    data: () => ({
        user: null
    }),
    props: {
        send_data: {},
        username: '',
        showHistory: false,
    },
    watch: {
        send_data(val) {
            this.user = val.user
        }
    },
    created() {
        if(this.send_data!=null){
            this.user = this.send_data.user
        }
    }
}
</script>
