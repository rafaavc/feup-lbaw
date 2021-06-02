<template>
    <div class="form-floating" id="messageTextarea">
        <textarea class="form-control" placeholder="Write your message..." id="floatingTextarea2" v-model="newMessage" @keyup.enter="sendMessage"></textarea>
        <label for="floatingTextarea2">Message</label>
        <button type="button" class="btn btn-primary position-absolute py-1 send" @click="sendMessage">
            <small><i class="fas fa-paper-plane me-2"></i>
            Send</small>
        </button>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    sender: {id: this.user.id, username: this.user.username },
                    text: this.newMessage
                });

                this.newMessage = ''
            }
        }
    }
</script>
