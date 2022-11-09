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
                <JetDangerButton @click="confirmDeletion('topic', topic.id)">
                  <TrashIcon class="inline w-4 h-4 mr-2"></TrashIcon>
                  删除
                </JetDangerButton>
              </div>
            </div>
          </div>
          <div
            class="mt-4 sm:mt-6 lg:mt-8 transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:w-full sm:p-6 prose-base prose-slate">
            <ReplyBox :topic="topic"></ReplyBox>
            <ReplyList :topic="topic" :replies="topic.replies" @confirm-deletion="confirmDeletion"></ReplyList>
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
    <JetDialogModal :show="confirmingDeletion" @close="confirmingDeletion = false">
      <template #title>
        {{ confirming.title }}
      </template>

      <template #content>
        {{ confirming.content }}
      </template>

      <template #footer>
        <JetSecondaryButton @click="confirmingDeletion = false">
          Cancel
        </JetSecondaryButton>

        <JetDangerButton
          class="ml-3"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="confirming.handler"
        >
          {{ confirming.submit }}
        </JetDangerButton>
      </template>
    </JetDialogModal>
  </AppLayout>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, Head, useForm } from '@inertiajs/inertia-vue3';
import { formatDistance } from 'date-fns'
import { zhCN } from 'date-fns/locale';
import { ChatBubbleLeftRightIcon, PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetDialogModal from '@/Jetstream/DialogModal.vue';
import ReplyBox from "@/Components/ReplyBox.vue";
import ReplyList from "@/Components/ReplyList.vue";

const props = defineProps({
  topic: Object,
});
const form = useForm({});
let confirming = ref(null);
const confirmingDeletion = ref(false);
const reply_id = ref(null);

onMounted(() => {
  confirming.value = confirm.topic
})

const confirmDeletion = (slug, id) => {
  if (slug === 'reply') {
    reply_id.value = id;
  }
  confirming.value = confirm[slug]
  confirmingDeletion.value = true;
}
const deleteTopic = () => {
  form.delete(route('topics.destroy', props.topic.id), {
    preserveScroll: true,
    onSuccess: () => confirmingDeletion.value = false,
    onFinish: () => form.reset(),
  });
};
const deleteReply = () => {
  form.delete(route('replies.destroy', reply_id.value), {
    preserveScroll: true,
    onSuccess: () => confirmingDeletion.value = false,
    onFinish: () => form.reset(),
  });
}
const confirm = reactive({
  topic: {
    title: '删除话题',
    content: '您确定要删除吗？',
    handler: deleteTopic,
    submit: 'Delete Topic',
  },
  reply: {
    title: '删除回复',
    content: '您确定要删除吗？',
    handler: deleteReply,
    submit: 'Delete Reply',
  }
});
</script>

<style scoped>

</style>
