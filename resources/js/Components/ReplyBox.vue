<template>
  <div>
    <JetValidationErrors class="mb-4"/>

    <form @submit.prevent="submit">
      <TabGroup v-slot="{ selectedIndex }">
        <TabList class="flex items-center">
          <Tab as="template" v-slot="{ selected }">
            <button
              :class="[selected ? 'text-gray-900 bg-gray-100 hover:bg-gray-200' : 'text-gray-500 hover:text-gray-900 bg-white hover:bg-gray-100', 'rounded-md border border-transparent px-3 py-1.5 text-sm font-medium']">
              Write
            </button>
          </Tab>
          <Tab as="template" v-slot="{ selected }">
            <button
              :class="[selected ? 'text-gray-900 bg-gray-100 hover:bg-gray-200' : 'text-gray-500 hover:text-gray-900 bg-white hover:bg-gray-100', 'ml-2 rounded-md border border-transparent px-3 py-1.5 text-sm font-medium']">
              Preview
            </button>
          </Tab>

          <!-- These buttons are here simply as examples and don't actually do anything. -->
          <div v-if="selectedIndex === 0" class="ml-auto flex items-center space-x-5">
            <div class="flex items-center">
              <button type="button"
                      class="-m-2.5 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500">
                <span class="sr-only">Insert link</span>
                <LinkIcon class="h-5 w-5" aria-hidden="true"/>
              </button>
            </div>
            <div class="flex items-center">
              <button type="button"
                      class="-m-2.5 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500">
                <span class="sr-only">Insert code</span>
                <CodeBracketIcon class="h-5 w-5" aria-hidden="true"/>
              </button>
            </div>
            <div class="flex items-center">
              <button type="button"
                      class="-m-2.5 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500">
                <span class="sr-only">Mention someone</span>
                <AtSymbolIcon class="h-5 w-5" aria-hidden="true"/>
              </button>
            </div>
          </div>
        </TabList>
        <TabPanels class="mt-2">
          <TabPanel class="-m-0.5 rounded-lg p-0.5">
            <label for="comment" class="sr-only">Comment</label>
            <div>
              <textarea rows="5" id="content" v-model="form.content"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm sm:text-sm"
                        placeholder="分享你的见解～"/>
            </div>
          </TabPanel>
          <TabPanel class="-m-0.5 rounded-lg p-0.5">
            <div class="border-b">
              <div class="mx-px mt-px px-3 pt-2 pb-12 text-sm leading-5 text-gray-800">Preview content will render
                here.
              </div>
            </div>
          </TabPanel>
        </TabPanels>
      </TabGroup>
      <div class="mt-2 flex justify-end">
        <JetSecondaryButton class="mr-4" v-if="child" @click="$emit('updateReplyIds', parentId)">
          <XMarkIcon class="inline w-4 h-4 md:mr-2"></XMarkIcon>
          <span class="hidden md:block">取消</span>
        </JetSecondaryButton>
        <JetButton class="justify-center whitespace-nowrap" :class="{ 'opacity-25': form.processing }"
                   :disabled="form.processing">
          <font-awesome-icon icon="fa-solid fa-reply-all" class="md:mr-2"/>
          <span class="hidden md:block">回复</span>
        </JetButton>
      </div>
    </form>
  </div>
</template>

<script setup>
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from '@headlessui/vue'
import { AtSymbolIcon, CodeBracketIcon, LinkIcon } from '@heroicons/vue/20/solid'
import { XMarkIcon } from '@heroicons/vue/24/outline';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import JetButton from "@/Jetstream/Button.vue";
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
  topic: Object,
  child: {
    type: Boolean,
    default: false,
    required: false,
  },
  parentId: {
    type: Number,
    default: null,
    required: false,
  }
});
const emit = defineEmits(['updateReplyIds'])
const form = useForm({
  content: '',
});

const submit = () => {
  form.transform(data => ({
    ...data,
    topic_id: props.topic.id,
    parent_id: props.parentId,
  })).post(route('replies.store'), {
    onFinish: () => {
      form.reset('content')
      emit('updateReplyIds', props.parentId)
    },
  });
};
</script>

<style scoped>

</style>
