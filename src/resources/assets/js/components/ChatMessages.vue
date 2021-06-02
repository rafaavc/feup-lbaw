<template>
    <div>
        <div class="row g-3 message-line mt-3" v-for="message in messages">
            <div class="col-2" style="width: 4.5rem;">
                <div class="small-profile-photo" ></div>
            </div>
            <div class="col-6">
                <p class="m-0 bg-secondary message-line-content">{{ message.text }}  </p>
            </div>

        </div>
    </div>
</template>

<script>
  export default {
    props: ['messages', 'user'],
  };
</script>
