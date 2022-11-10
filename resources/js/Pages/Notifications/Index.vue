<template>
  <AppLayout title="通知列表">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        我的通知列表
      </h2>
    </template>

    <div class="pt-4 sm:pt-6 lg:pt-8 pb-10">
      <div class="md:flex justify-between items-start max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full md:w-3/4 bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 md:mr-8" v-if="notifications.data.length > 0">
          <ul role="list" class="divide-y divide-gray-200">
            <li v-for="(notification, index) in notifications.data" :key="notification.id" class="py-4" :class="{ 'pt-0': index === 0, 'pb-0': index === (notifications.data.length - 1) }">
              <TopicReplied v-if="_.last(_.split(notification.type, '\\')) === 'TopicReplied'" :notification="notification"></TopicReplied>
            </li>
          </ul>
          <pagination :links="notifications.links" :page="page" :from="notifications.from" :to="notifications.to"
                      :total="notifications.total"
                      :current-page="notifications.current_page" :last-page="notifications.last_page"
                      :prev-page-url="notifications.prev_page_url" :next-page-url="notifications.next_page_url"/>
        </div>
        <Sidebar class="grow"></Sidebar>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import Sidebar from "@/Components/Sidebar.vue";
import TopicReplied from "./Types/TopicReplied.vue";
import _ from "lodash";

defineProps({
  notifications: Object,
  page: Number,
});
</script>

<style scoped>

</style>
