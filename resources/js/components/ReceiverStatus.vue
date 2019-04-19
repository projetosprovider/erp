<template>

    <span v-if="friend.status == 'online'">
        <i class="mdi mdi-star-circle member-star text-success" title="Ativo"></i> Online
    </span>

    <span v-else>
        <i class="mdi mdi-alert-circle-outline member-star text-danger" title="Inativo"></i> Offline
    </span>

</template>

<script>
    export default {
        props: ['user', 'receiver'],
        data() {
            return {
                friend: this.receiver
            }
        },
        mounted() {
            this.listen();
            //this.listenForWhisper();
        },
        methods: {
            listen() {
                Echo.join('chat')
                    .joining((user) => {
                        axios.put('/api/user/'+ user.id +'/online?api_token=' + user.api_token, {});
                    })
                    .leaving((user) => {
                        axios.put('/api/user/'+ user.id +'/offline?api_token=' + user.api_token, {});
                    })
                    .listen('UserOnline', (e) => {
                        this.friend = e.user;
                    })
                    .listen('UserOffline', (e) => {
                        this.friend = e.user;
                    });
            }
        }
    }
</script>
