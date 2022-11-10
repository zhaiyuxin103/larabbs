<template>
  <AppLayout title="话题列表">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        我的话题列表
      </h2>
    </template>

    <div class="pt-4 sm:pt-6 lg:pt-8 pb-10">
      <div class="md:flex justify-between items-start max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full md:w-3/4 bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 md:mr-8">
          <div>
            <Link class="mr-4" :href="_.head(_.split($page.url, '?')) + '?order=default'">
              <span v-if="$page.url.endsWith('recent')">最后回复</span>
              <JetButton v-else>最后回复</JetButton>
            </Link>
            <Link :href="_.head(_.split($page.url, '?')) + '?order=recent'">
              <JetButton v-if="$page.url.endsWith('recent')">最新发布</JetButton>
              <span v-else>最新发布</span>
            </Link>
          </div>
          <hr class="mt-4">
          <TopicList :topics="topics.data"></TopicList>
          <pagination :links="topics.links" :page="page" :from="topics.from" :to="topics.to" :total="topics.total"
                      :current-page="topics.current_page" :last-page="topics.last_page"
                      :prev-page-url="topics.prev_page_url" :next-page-url="topics.next_page_url"/>
        </div>
        <Sidebar class="grow"></Sidebar>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Jetstream/Button.vue';
import TopicList from '@/Layouts/TopicList.vue';
import Pagination from '@/Components/Pagination.vue';
import Sidebar from "@/Components/Sidebar.vue";
import _ from "lodash";

defineProps({
  topics: Object,
  page: Number,
});
</script>

<style scoped>

</style>
