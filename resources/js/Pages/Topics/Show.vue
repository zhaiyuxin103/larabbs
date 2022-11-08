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

    <div class="pt-4 sm:pt-6 lg:pt-8 pb-12">
      <div class="md:flex justify-between items-start max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full md:w-2/3 mr-8 md:px-0">
          <div
            class="transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:w-full sm:p-6 prose-base prose-slate">
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
            <div v-if="$page.props.user.id === topic.user_id">
              <hr class="my-4">
              <div class="flex items-center">
                <Link :href="route('topics.edit', topic.id)" class="text-gray-500 mr-4">
                  <JetSecondaryButton>
                    <PencilSquareIcon class="inline w-4 h-4 mr-2"></PencilSquareIcon>
                    编辑
                  </JetSecondaryButton>
                </Link>
                <JetDangerButton @click="confirmingTopicDeletion = true">
                  <TrashIcon class="inline w-4 h-4 mr-2"></TrashIcon>
                  删除
                </JetDangerButton>
              </div>
            </div>
          </div>
          <div
            class="mt-4 sm:mt-6 lg:mt-8 transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:w-full sm:p-6 prose-base prose-slate">
            <ReplyBox :topic="topic"></ReplyBox>
            <ReplyList :replies="topic.replies"></ReplyList>
          </div>
        </div>

        <div
          class="md:flex w-full md:w-1/3 items-end justify-center pt-4 text-center sm:items-center sm:p-0">
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

    <!-- Delete Account Confirmation Modal -->
    <JetDialogModal :show="confirmingTopicDeletion" @close="confirmingTopicDeletion = false">
      <template #title>
        删除话题
      </template>

      <template #content>
        您确定要删除吗？
      </template>

      <template #footer>
        <JetSecondaryButton @click="confirmingTopicDeletion = false">
          Cancel
        </JetSecondaryButton>

        <JetDangerButton
          class="ml-3"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="deleteTopic"
        >
          Delete Topic
        </JetDangerButton>
      </template>
    </JetDialogModal>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, Head, useForm } from '@inertiajs/inertia-vue3';
import { formatDistance } from 'date-fns'
import { zhCN } from 'date-fns/locale';
import { ChatBubbleLeftRightIcon, PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import { ref } from "vue";
import JetDialogModal from '@/Jetstream/DialogModal.vue';
import ReplyBox from "@/Components/ReplyBox.vue";
import ReplyList from "@/Components/ReplyList.vue";

const props = defineProps({
  topic: Object,
});

const confirmingTopicDeletion = ref(false);

const form = useForm({});

const deleteTopic = () => {
  form.delete(route('topics.destroy', props.topic.id), {
    preserveScroll: true,
    onSuccess: () => confirmingTopicDeletion.value = false,
    onFinish: () => form.reset(),
  });
};
</script>

<style scoped>

</style>
