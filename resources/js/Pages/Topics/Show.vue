<template>
    <AppLayout>
        <Head>
            <title>{{ topic.title }}</title>
        </Head>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ topic.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="flex justify-between items-start max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="w-2/3 mr-8 transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:w-full sm:p-6 prose-base prose-slate">
                    <h1 class="text-center mt-4 mb-4">
                        {{ topic.title }}
                    </h1>
                    <div class="text-center text-gray-500">
                        {{ formatDistance(new Date(topic.created_at), new Date(), {locale: zhCN}) }}
                        ⋅
                        <ChatBubbleLeftRightIcon class="inline w-4 h-4"></ChatBubbleLeftRightIcon>
                        {{ topic.reply_count }}
                    </div>
                    <div v-html="topic.body"></div>
                    <div>
                        <hr class="my-4">
                        <div class="flex items-center justify-between">
                            <Link :href="route('topics.create')" class="text-gray-500">
                                <PencilSquareIcon class="inline w-4 h-4"></PencilSquareIcon>
                                编辑
                            </Link>
                            <Link :href="route('topics.create')" class="text-red-500">
                                <TrashIcon class="inline w-4 h-4"></TrashIcon>
                                删除
                            </Link>
                        </div>
                    </div>
                </div>
                <div
                    class="flex w-1/3 items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:w-full sm:max-w-sm sm:p-6">
                        <img class="block w-4/5 rounded-md mx-auto"
                             :src="topic.user.profile_photo_url"
                             :alt="topic.user.name">
                        <div class="mt-3 text-center sm:mt-5 border-t border-gray-200 pt-4">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                {{ topic.user.name }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">{{ topic.user.email }}</p>
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
import { Link, Head } from '@inertiajs/inertia-vue3';
import { formatDistance } from 'date-fns'
import { zhCN } from 'date-fns/locale';
import { ChatBubbleLeftRightIcon, PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';

defineProps({
    topic: Object,
});
</script>

<style scoped>

</style>
