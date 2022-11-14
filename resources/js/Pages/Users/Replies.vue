<template>
  <AppLayout title="评论列表">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        我的评论列表
      </h2>
    </template>

    <div class="pt-4 sm:pt-6 lg:pt-8 pb-10">
      <div class="md:flex justify-between items-start max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full w-3/4 bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 md:mr-8">
          <Replies :replies="replies"></Replies>
          <pagination :links="replies.links" :page="page" :from="replies.from" :to="replies.to"
                      :total="replies.total"
                      :current-page="replies.current_page" :last-page="replies.last_page"
                      :prev-page-url="replies.prev_page_url" :next-page-url="replies.next_page_url"/>
        </div>
        <Sidebar class="grow"></Sidebar>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Replies from "@/Components/Replies.vue";
import Pagination from '@/Components/Pagination.vue';
import Sidebar from "@/Components/Sidebar.vue";

defineProps({
  replies: Object,
  page: Number,
});
</script>

<style scoped>

</style>
