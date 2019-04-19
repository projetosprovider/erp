<template>

    <div class="type_msg">
      <div class="input_msg_write">
        <textarea autofocus class="write_msg form-control" name="message" required placeholder="Digite sua Mensagem..." v-model="newMessage" @keyup.enter="sendMessage"></textarea>
        <button class="msg_send_btn" type="button" @click="sendMessage"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
      </div>

    </div>

</template>

<script>
    export default {
        props: ['user', 'receiver'],

        data() {
            return {
                newMessage: '',
            }
        },

        methods: {
            sendMessage() {

                if(this.newMessage.length > 0) {
                  this.$emit('messagesent', {
                      user: this.user,
                      receiver: this.receiver,
                      message: this.newMessage
                  });
                  this.newMessage = ''
                }


            }
        }
    }
</script>
