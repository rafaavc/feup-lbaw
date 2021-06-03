// require('./bootstrap');
// require('../../../vendor/laravel/ui/src/Presets/bootstrap-stubs/bootstrap');
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "24c23112625a463631a3",
    cluster: "eu",
    forceTLS: true
});

window.Vue = require('vue').default;

Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);

const app = new Vue({
    el: '#app',

    data: {
        messages: []
    },

    created() {
        this.fetchMessages();
        window.Echo.private('TasteBuds')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    text: e.message.text,
                    sender: { id: e.message.sender, username: e.message.username },
                });
            });
    },

    methods: {
        fetchMessages() {
            axios.get('/message').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);
            console.log(message)
            axios.post('/message', message).then(response => {
              console.log(response.data);
            });
        },
    }
});
