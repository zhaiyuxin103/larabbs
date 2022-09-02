<template>
    <AppLayout title="话题列表">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                话题列表
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div>
                        <JetButton class="mr-4">最后回复</JetButton>
                        <Link>最新发布</Link>
                    </div>
                    <hr class="mt-4">
                    <TopicList :topics="topics.data"></TopicList>
                    <pagination :links="topics.links" :page="page" :from="topics.from" :to="topics.to" :total="topics.total" :current-page="topics.current_page" :last-page="topics.last_page" />
                </div>
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

const props = defineProps({
    topics: Object,
    page: Number,
});
</script>

<style scoped>

</style>
