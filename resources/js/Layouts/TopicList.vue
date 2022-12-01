<template>
    <ul>
        <li v-for="topic in topics" class="flex items-center p-2 border-b border-slate-200 hover:bg-gray-500/5">
            <div class="border border-gray-200 rounded-md mr-4">
                <Link :href="route('users.show', topic.user.hash_id)">
                    <img :src="topic.user.avatar_link" :alt="topic.user.name" class="w-[50px] p-1">
                </Link>
            </div>
            <div class="grow">
                <div class="flex justify-between flex-auto">
                    <Link :href="route('topics.show', [topic.hash_id, topic.slug])" class="line-clamp-1">{{ topic.title }}</Link>
                    <Link :href="route('topics.show', [topic.hash_id, topic.slug])">
                        <span class="bg-gray-300 rounded-full px-3 py-0.5 font-bold text-white text-sm">{{ topic.reply_count }}</span>
                    </Link>
                </div>
                <small class="flex items-center text-gray-500">
                    <Link :href="route('categories.show', topic.category.hash_id)">
                        <font-awesome-icon icon="fa-regular fa-folder-closed"/>
                        <span class="ml-1">{{ topic.category.name }}</span>
                    </Link>
                    <span class="mx-1"> • </span>
                    <Link :href="route('users.show', topic.user.hash_id)">
                        <font-awesome-icon icon="fa-regular fa-user"/>
                        <span class="ml-1">{{ topic.user.name }}</span>
                    </Link>
                    <span class="mx-1"> • </span>
                    <font-awesome-icon icon="fa-regular fa-clock"/>
                    <tippy>
                        <span class="ml-1">{{ formatDistance(new Date(topic.updated_at), new Date(), {locale: zhCN}) }}</span>
                         <template #content>
                            发布于 {{ topic.created_at }}
                        </template>
                    </tippy>
                </small>
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
