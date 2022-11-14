<template>
  <ul>
    <li v-for="topic in topics" class="flex items-center p-2 border-b border-slate-200 hover:bg-gray-500/5">
      <div class="grow">
        <div class="flex justify-between flex-auto my-1.5">
          <Link :href="route('topics.show', [topic.id, topic.slug])" class="line-clamp-1">{{ topic.title }}</Link>
          <small class="flex items-center text-gray-500">
            <Link>
              <span class="ml-1">{{ topic.reply_count }}</span> &nbsp;回复
            </Link>
            <span class="mx-1"> ⋅ </span>
            <tippy>
              <span class="ml-1">{{ formatDistance(new Date(topic.updated_at), new Date(), {locale: zhCN}) }}</span>
              <template #content>
                发布于 {{ topic.created_at }}
              </template>
            </tippy>
          </small>
        </div>
      </div>
    </li>
  </ul>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { formatDistance } from 'date-fns'
import { zhCN } from 'date-fns/locale';

defineProps({
  topics: Array,
});
</script>

<style scoped>

</style>
