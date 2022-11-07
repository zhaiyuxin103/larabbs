<template>
  <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
    <div
      class="rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl sm:w-full sm:max-w-sm sm:p-6">
      <Link :href="route('topics.create')">
        <JetButton class="w-full justify-center whitespace-nowrap">
          <PencilIcon class="w-4 h-4 mr-4"></PencilIcon>
          新建帖子
        </JetButton>
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import { PencilIcon } from '@heroicons/vue/24/outline'
</script>

<style scoped>

</style>
