<template>
    <div>
        <div class="row message-line mt-3" v-for="message in messages" style="display: flex; justify-content: flex-end" v-if="user == message.sender">
            <div class="col-6" style="text-align: right;">
                <p class="m-0 bg-secondary message-line-content">{{ message.text }} {{ message.sender }}</p>
            </div>
            <div class="col-2" style="width: 4.5rem;">
                <div class="small-profile-photo" ></div>
            </div>
        </div>

        <div class="row g-3 message-line mt-3" v-else>
            <div class="col-2" style="width: 4.5rem;">
                <div class="small-profile-photo" ></div>
            </div>
            <div class="col-6">
                <p class="m-0 bg-secondary message-line-content">{{ message.text }} {{ message.sender }}</p>
            </div>
        </div>
    </div>
</template>



<script>
  export default {
    props: ['messages', 'user'],
  };
</script>
