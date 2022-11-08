<template>
  <AppLayout title="评论列表">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        我的评论列表
      </h2>
    </template>

    <div class="pt-4 sm:pt-6 lg:pt-8 pb-10">
      <div class="md:flex justify-between items-start max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full w-2/3 bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 md:mr-8">
          <ul v-for="(reply, index) in replies.data">
            <li class="py-4" :class="{ 'pt-0': index === 0, 'pb-0': index === (replies.data.length - 1) }">
              <Link :href="route('topics.show', reply.topic.id)" class="block">所属话题：{{ reply.topic.title }}</Link>
              <p class="mt-1">回复内容：{{ reply.content }}</p>
              <div class="mt-1 text-sm text-gray-500">
                <font-awesome-icon icon="fa-regular fa-clock"/>
                <tippy>
                  <span class="ml-1">回复于{{ formatDistance(new Date(reply.updated_at), new Date(), {locale: zhCN}) }}</span>
                  <template #content>
                    发布于 {{ reply.created_at }}
                  </template>
                </tippy>
              </div>
            </li>
            <hr v-if="index < (replies.data.length - 1)">
          </ul>
          <pagination :links="replies.links" :page="page" :from="replies.from" :to="replies.to" :total="replies.total"
                      :current-page="replies.current_page" :last-page="replies.last_page"
                      :prev-page-url="replies.prev_page_url" :next-page-url="replies.next_page_url"/>
        </div>
        <Sidebar class="grow"></Sidebar>

      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import Sidebar from "@/Components/Sidebar.vue";
import { formatDistance } from 'date-fns'
import { zhCN } from 'date-fns/locale';

defineProps({
  replies: Object,
  page: Number,
});
</script>

<style scoped>

</style>
