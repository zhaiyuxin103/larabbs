<template>
  <ul role="list" class="divide-y divide-gray-200">
    <li v-for="(reply, index) in replies.data" :key="reply.id" class="py-3"
        :class="{ 'pt-0': index === 0, 'pb-0': index === (replies.data.length - 1) }">
      <div class="flex space-x-3">
        <div class="flex-1 space-y-1">
          <div class="flex items-center justify-between">
            <h3 class="text-sm font-medium">
              <Link :href="route('topics.show', reply.topic.id)">{{ reply.topic.title }}</Link>
            </h3>
            <p class="text-sm text-gray-500">
              <font-awesome-icon icon="fa-regular fa-clock"/>
              <tippy>
                        <span class="ml-1">回复于 {{
                            formatDistance(new Date(reply.created_at), new Date(), {locale: zhCN})
                          }}</span>
                <template #content>
                  {{ reply.created_at }}
                </template>
              </tippy>
            </p>
          </div>
          <p class="text-sm text-gray-500" v-html="reply.content"></p>
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
  replies: Object,
});
</script>

<style scoped>

</style>
