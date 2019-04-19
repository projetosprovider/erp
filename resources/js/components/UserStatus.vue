<template>
    <span v-if="user.status == 'online'">
        <i class="mdi mdi-star-circle member-star text-success" title="Ativo"></i> Online
    </span>

    <span v-else>
        <i class="mdi mdi-alert-circle-outline member-star text-danger" title="Inativo"></i> Offline
    </span>

</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {

            }
        },
        mounted() {
            this.listen();
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
            }
        }
    }
</script>
