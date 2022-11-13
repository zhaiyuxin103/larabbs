<template>
  <div class="reply-list">
    <template v-for="(reply, index) in replies">
      <div class="flex items-start" :class="{'mb-6': index < replies.length }" :name="`reply-${reply.id}`"
           :id="`reply-${reply.id}`">
        <img class="block w-12 h-12 mr-4 my-0 flex-none overflow-hidden rounded-full"
             :src="reply.user.avatar_link" alt="">
        <div class="flex-auto">
          <div class="flex items-center">
            <div class="font-semibold">
              {{ reply.user.name }}
            </div>
            <tippy>
              <div class="text-[12px] text-[#999999] leading-[22px] ml-[20px]">
                {{ formatDistance(new Date(reply.created_at), new Date(), {locale: zhCN}) }}
              </div>
              <template #content>
                发布于 {{ reply.created_at }}
              </template>
            </tippy>
          </div>
          <div class="reply-content text-secondary mb-[10px]" v-html="reply.content"></div>
          <div class="flex justify-end meta text-[#999999]">
            <JetButton class="justify-center whitespace-nowrap" @click="replyIds.value = _.indexOf(replyIds, reply.id) ? replyIds.push(reply.id) : _.pull(replyIds, reply.id)">
              <font-awesome-icon icon="fa-solid fa-reply-all" class="md:mr-2"/>
              <span class="hidden md:block">回复</span>
            </JetButton>
            <Link :href="route('replies.edit', reply.id)" class="block text-gray-500 ml-4"
                  v-if="$page.props.user.id === reply.user_id || $page.props.user.id === topic.user_id">
              <JetSecondaryButton>
                <PencilSquareIcon class="inline w-4 h-4 md:mr-2"></PencilSquareIcon>
                <span class="hidden md:block">编辑</span>
              </JetSecondaryButton>
            </Link>
            <JetDangerButton @click="confirm('reply', reply.id)" class="ml-4"
                             v-if="$page.props.user.id === reply.user_id || $page.props.user.id === topic.user_id">
              <TrashIcon class="inline w-4 h-4 md:mr-2"></TrashIcon>
              <span class="hidden md:block">删除</span>
            </JetDangerButton>
          </div>
          <div class="replies mt-4 block" v-if="_.indexOf(replyIds, reply.id) !== -1">
            <ReplyBox :child="true" :parent-id="reply.id" :topic="topic"
                      @update-reply-ids="updateReplyIds"></ReplyBox>
          </div>
        </div>
      </div>
      <div class="inner-replies ml-12">
        <ReplyList :topic="topic" :replies="reply.children"></ReplyList>
      </div>
    </template>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { formatDistance } from 'date-fns'
import { zhCN } from 'date-fns/locale';
import ReplyBox from "@/Components/ReplyBox.vue";
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetButton from "@/Jetstream/Button.vue";
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/inertia-vue3';
import ReplyList from "@/Components/ReplyList.vue";
import _ from "lodash";

defineProps({
  topic: Object,
  replies: Object,
});
const emit = defineEmits(['confirmDeletion'])

const replyIds = ref([]);

const updateReplyIds = (reply_id) => {
  _.pull(replyIds.value, reply_id);
}

const confirm = (slug, id) => {
  emit('confirmDeletion', slug, id);
}
</script>

<style scoped>

</style>
