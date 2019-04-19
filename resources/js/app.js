
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue');

//import * as Vue from 'vue/dist/vue.common.js';

import Vue from 'vue'
import VueChatScroll from 'vue-chat-scroll'
//import Chat from 'vue-beautiful-chat'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 var routeMessages = $("#route-messages").val();
 var routePostMessage = $("#route-post-message").val();

 var currentUser = $("#currentUser").val();
 var receiver = $("#receiver").val();
 var privateChat = currentUser+'.'+receiver;
 var privateChatInverse = receiver+'.'+currentUser;

 Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
 Vue.component('chat-form', require('./components/ChatForm.vue').default);

 Vue.component('receiverstatus', require('./components/ReceiverStatus.vue').default);
 Vue.component('userstatus', require('./components/UserStatus.vue').default);
 //Vue.component('chatwidget', require('./components/ChatWidget.vue').default);

 Vue.use(VueChatScroll)
 //Vue.use(Chat)

 const app = new Vue({
     el: '#app',

     data: {
         messages: [],
     },

     created() {
         if(receiver) {
           this.fetchMessages();
         }
     },

     methods: {
         fetchMessages() {
             axios.get(receiver+'/messages').then(response => {
                 this.messages = response.data;
             });
         },

         addMessage(message) {

              console.log(message.message);

              if(message.message.trim().length > 0) {

                this.messages.push({
                    message: message.message,
                    user_id: message.user.id,
                    created_at: Date(),
                    avatar: message.user.avatar,
                });
                axios.post(receiver+'/messages', message).then(response => {
                  //console.log(response.data);
                });

              }


         }
     }
 });

 Echo.private('chat.'+receiver)
  .listen('MessageSent', (e) => {
    //console.log(e);
    app.messages.push({
      message: e.message.message,
      user: e.user,
      receiver: e.receiver,
      created_at: e.message.created_at,
      avatar: e.user.avatar,
    });
  });

/*
Echo.private('chat.'+privateChatInverse)
 .listen('MessageSent', (e) => {
   this.messages.push({
     message: e.message.message,
     user: e.user,
     receiver: e.receiver,
   });
 });
*/
