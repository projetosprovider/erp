<template>

  <div class="messages-container">
  <div class="mesgs message" v-chat-scroll="{always: false, smooth: true}">
    <div class="msg-box" v-for="message in messages">

      <div class="outgoing_msg" v-if="message.user_id == user.id">
        <div class="sent_msg">
          <p>{{ message.message }}</p>
          <span class="time_date">{{ message.created_at }}</span> </div>
      </div>

      <div class="incoming_msg" v-else>
        <div class="received_msg">
          <div class="received_withd_msg">
            <p>{{ message.message }}</p>
            <span class="time_date">{{ message.created_at }}</span></div>
        </div>
      </div>

    </div>
  </div>
  </div>

</template>

<script>
  export default {
    props: ['messages', 'user', 'receiver'],
  };
</script>
