<template>
  <div>
    <div class="flex min-h-full items-end justify-center pt-4 text-center sm:items-center sm:p-0">
      <div
        class="rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl w-full sm:max-w-sm sm:p-6">
        <Link :href="route('topics.create')">
          <JetButton class="w-full justify-center whitespace-nowrap">
            <PencilIcon class="w-4 h-4 mr-4"></PencilIcon>
            新建帖子
          </JetButton>
        </Link>
      </div>
    </div>
    <div class="flex min-h-full items-end justify-center text-center sm:items-center sm:p-0 mt-4 sm:mt-6 lg:mt-8">
      <div
        class="rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl w-full sm:max-w-sm sm:p-6">
        <div class="border-b border-gray-200 bg-white pb-4">
          <h3 class="text-lg font-medium text-center leading-6 text-gray-900">活跃用户</h3>
        </div>
        <ul role="list" class="divide-y divide-gray-200">
          <li v-for="(active_user, index) in $page.props.active_users" :key="active_user.id" class="py-2" :class="{ 'pb-0': index === ($page.props.active_users.length - 1) }">
            <div class="flex items-center space-x-3">
              <img class="h-8 w-8 rounded-md" :src="active_user.profile_photo_url" alt=""/>
              <div class="flex-1 space-y-1">
                <div class="flex items-center justify-between">
                  <h3 class="font-medium">{{ active_user.name }}</h3>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import { PencilIcon } from '@heroicons/vue/24/outline';
</script>

<style scoped>

</style>
