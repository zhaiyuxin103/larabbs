<template>
  <div class="flex space-x-3">
    <img class="h-12 w-12 rounded-full" :src="notification.data.user_avatar" alt=""/>
    <div class="flex-1 space-y-1">
      <div class="flex items-center justify-between">
        <h3 class="text-sm font-medium">
          <Link href="#">{{ notification.data.user_name }}</Link>
          <span class="text-gray-400"> 评论了 </span>
          <Link :href="notification.data.topic_link">{{ notification.data.topic_title }}</Link>
        </h3>
        <p class="text-sm text-gray-500">
          <font-awesome-icon icon="fa-regular fa-clock"/>
          <tippy>
            <span class="ml-1">{{
                formatDistance(new Date(notification.created_at), new Date(), {locale: zhCN})
              }}</span>
            <template #content>
              {{ notification.created_at }}
            </template>
          </tippy>
        </p>
      </div>
      <p class="text-sm text-gray-500" v-html="notification.data.reply_content"></p>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { formatDistance } from 'date-fns'
import { zhCN } from 'date-fns/locale';

defineProps({
  notification: Object,
});
</script>

<style scoped>

</style>
