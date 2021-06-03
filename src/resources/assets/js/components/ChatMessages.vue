<template>
    <div id="message-chat">
        <div class="row message-line mt-3" v-for="message in messages" style="display: flex; justify-content: flex-end" v-if="user == message.sender.id">
            <div class="col-6" style="text-align: right;">
                <p class="m-0 bg-secondary message-line-content">{{ message.text }}</p>
            </div>
            <div class="col-2" style="width: 4.5rem;" >
                <a v-bind:href="'/user/' + message.sender.username">
                    <div class="small-profile-photo" v-bind:style="{ backgroundImage: 'url(\'' + storagepath + '/people/' + message.sender.id + '.jpeg\'), url(\'' + storagepath + '/people/' + 'no_image.png\')' }"></div>
                </a>
            </div>
        </div>

        <div class="row g-3 message-line mt-3" v-else>
            <div class="col-2" style="width: 4.5rem;">
                <a v-bind:href="'/user/' + message.sender.username">
                    <div class="small-profile-photo" v-bind:style="{ backgroundImage: 'url(\'' + storagepath + '/people/' + message.sender.id + '.jpeg\'), url(\'' + storagepath + '/people/' + 'no_image.png\')' }"></div>
                </a>
            </div>
            <div class="col-6" >
                <p class="m-0 bg-secondary message-line-content">{{ message.text }}</p>
            </div>
        </div>
    </div>
</template>



<script>
    export default {
        props: ['messages', 'user', 'storagepath'],

        updated() {
            if(document.getElementById('message-chat').childElementCount > 0)
                document.getElementById('message-chat').lastElementChild.scrollIntoView()
        }
    };
</script>
