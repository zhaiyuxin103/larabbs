<template>
  <AppLayout title="个人页面">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        个人页面
      </h2>
    </template>

    <div class="pt-4 sm:pt-6 lg:pt-8 pb-10">
      <div class="md:flex justify-between items-start max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="md:flex w-full md:w-1/4 items-end justify-center pt-4 text-center sm:items-center sm:p-0  md:mr-8">
          <div
            class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:w-full sm:max-w-sm sm:p-6">
            <img class="block w-full rounded-md"
                 :src="user.avatar_link"
                 :alt="user.name">
            <div class="mt-3 text-center border-t border-gray-200 pt-3">
              <h3 class="text-lg font-medium leading-6 text-gray-900">
                个人简介
              </h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500">{{ user.introduction }}</p>
              </div>
            </div>

            <div class="mt-3 text-center border-t border-gray-200 pt-3">
              <h3 class="text-lg font-medium leading-6 text-gray-900">
                注册于
              </h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500">
                  {{ formatDistance(new Date(user.created_at), new Date(), {locale: zhCN}) }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full md:w-3/4 mt-4 sm:mt-6 md:mt-0">
          <div class=" bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <span class="text-2xl font-medium leading-6 text-gray-900">{{ user.name }}</span> &nbsp; {{ user.email }}
          </div>
          <hr class="my-2 sm:my-3 lg:my-4"/>
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="sm:hidden">
              <label for="tabs" class="sr-only">Select a tab</label>
              <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
              <select id="tabs" name="tabs"
                      class="block w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
              </select>
            </div>
            <div class="hidden sm:block">
              <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                  <a v-for="tab in tabs" :key="tab.name" :href="tab.href"
                     :class="[tab.current ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm']"
                     :aria-current="tab.current ? 'page' : undefined">
                    <component :is="tab.icon"
                               :class="[tab.current ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500', '-ml-0.5 mr-2 h-5 w-5']"
                               aria-hidden="true"/>
                    <span>{{ tab.name }}</span>
                    <span v-if="tab.count"
                          :class="[tab.current ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-900', 'hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block']">{{
                        tab.count
                      }}</span>
                  </a>
                </nav>
              </div>
              <div v-if="tab === 'topics'">
                <UserTopics :topics="topics.data" ></UserTopics>
                <Pagination :links="topics.links" :page="page" :from="topics.from" :to="topics.to"
                            :total="topics.total" :current-page="topics.current_page"
                            :last-page="topics.last_page" :prev-page-url="topics.prev_page_url"
                            :next-page-url="topics.next_page_url" :params="{ key: 'tab', value: 'topics' }"/>
              </div>
              <div v-if="tab === 'replies'">
                <Replies :replies="replies" class="pt-3"></Replies>
                <Pagination :links="replies.links" :page="page" :from="replies.from" :to="replies.to"
                            :total="replies.total" :current-page="replies.current_page"
                            :last-page="replies.last_page" :prev-page-url="replies.prev_page_url"
                            :next-page-url="replies.next_page_url" :params="{ key: 'tab', value: 'replies' }"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { CubeTransparentIcon, ChatBubbleOvalLeftEllipsisIcon } from '@heroicons/vue/24/outline'
import { formatDistance } from 'date-fns'
import { zhCN } from 'date-fns/locale';
import UserTopics from '@/Components/UserTopics.vue';
import Replies from "@/Components/Replies.vue";
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
  user: Object,
  tab: {
    required: false,
    type: String,
    default: 'topics',
  },
  topics: Object,
  replies: Object,
  page: Number,
})
const tabs = [
  {
    name: 'Ta 的话题',
    href: route('users.show', {user: props.user.id, tab: 'topics'}),
    count: props.topics.total,
    icon: CubeTransparentIcon,
    current: props.tab === 'topics',
    data: props.user.topics
  },
  {
    name: 'Ta 的回复',
    href: route('users.show', {user: props.user.id, tab: 'replies'}),
    count: props.replies.total,
    icon: ChatBubbleOvalLeftEllipsisIcon,
    current: props.tab === 'replies',
    data: props.user.replies
  },
]
</script>

<style scoped>

</style>
