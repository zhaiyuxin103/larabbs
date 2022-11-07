<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { PencilSquareIcon } from '@heroicons/vue/24/outline'
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import { useForm } from "@inertiajs/inertia-vue3";
import _ from "lodash";
import { ref } from "vue";
import Editor from '@tinymce/tinymce-vue';
import axios from 'axios';

const props = defineProps({
  categories: Object,
  topic: Object,
});
const form = useForm(_.merge({
  _method: 'PUT',
  parent_id: props.topic.category.parent.id,
}, props.topic));
const imagePreview = ref(props.topic.image);
const imageInput = ref(null);

const updateImagePreview = () => {
  const image = imageInput.value.files[0];

  if (!image) return;

  const reader = new FileReader();

  reader.onload = (e) => {
    imagePreview.value = e.target.result;
  };

  reader.readAsDataURL(image);
};
const selectNewImage = () => {
  imageInput.value.click();
};
const clearImageInput = () => {
  if (imageInput.value?.value) {
    imageInput.value.value = null;
  }
};
const imageUploadHandler = (blobInfo, progress) => new Promise((resolve, reject) => {
  const formData = new FormData();
  formData.append('upload_file', blobInfo.blob(), blobInfo.filename());
  axios.post(route('topics.upload_image'), formData, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  }).then((response) => {
    resolve(response.data.location);
  }).catch((error) => {
    console.log(error);
  })
});
const submit = () => {
  if (imageInput.value) {
    form.image = imageInput.value.files[0] || props.topic.image;
  }

  form.post(route('topics.update', props.topic.id), {
    preserveScroll: true,
    onSuccess: () => clearImageInput(),
  });
};
</script>

<template>
  <AppLayout title="新建话题">
    <template #header>
      <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight">
        <PencilSquareIcon class="w-8 h-8 mr-2"></PencilSquareIcon>
        编辑话题 - {{ topic.title }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <form class="space-y-8 divide-y divide-gray-200 p-20" @submit.prevent="submit">
            <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
              <div class="space-y-6 sm:space-y-5">
                <div>
                  <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Topic</h3>
                  <p class="mt-1 max-w-2xl text-sm text-gray-500">编辑话题</p>
                </div>
                <div
                  class="sm:grid sm:grid-cols-5 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                  <JetLabel>标题<span class="text-red-500"> * </span></JetLabel>
                  <div class="col-span-4">
                    <JetInput
                      v-model="form.title"
                      type="text"
                      class="mt-1 block w-full"
                      placeholder="请填写标题"
                    />
                    <JetInputError :message="form.errors.title" class="mt-2"/>
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-5 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                  <JetLabel>副标题<span class="text-red-500"> * </span></JetLabel>
                  <div class="col-span-4">
                    <JetInput
                      v-model="form.subtitle"
                      type="text"
                      class="mt-1 block w-full"
                      placeholder="请填写副标题"
                    />
                    <JetInputError :message="form.errors.subtitle" class="mt-2"/>
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-5 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                  <label for="cover-photo"
                         class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">图片</label>
                  <div class="mt-1 col-span-4 sm:mt-0">
                    <div
                      class="flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                      <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400"
                             v-show="!imagePreview" stroke="currentColor"
                             fill="none" viewBox="0 0 48 48" aria-hidden="true">
                          <path
                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                            stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"/>
                        </svg>
                        <div class="flex text-sm text-gray-600" v-show="!imagePreview">
                          <label for="image-uploader"
                                 class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-400 focus-within:outline-none focus-within:ring focus-within:ring-indigo-200 focus-within:ring-opacity-50 focus-within:ring-offset-2 hover:text-indigo-500">
                            <span>Upload a file</span>
                            <input id="image-uploader" name="image-uploader" type="file"
                                   class="sr-only"
                                   ref="imageInput"
                                   @change="updateImagePreview">
                          </label>
                          <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500" v-show="!imagePreview">PNG, JPG, GIF up
                          to
                          10MB</p>

                        <!-- New Profile Photo Preview -->
                        <div v-show="imagePreview" class="mt-2">
                                                    <span
                                                      class="block rounded-xl w-36 h-36 bg-cover bg-no-repeat bg-center"
                                                      :style="'background-image: url(\'' + imagePreview + '\');'"
                                                    />
                        </div>
                      </div>
                    </div>
                    <JetSecondaryButton class="mt-2 mr-2" type="button"
                                        @click.prevent="selectNewImage" v-show="imagePreview">
                      Select A New Photo
                    </JetSecondaryButton>
                    <JetInputError :message="form.errors.image" class="mt-2"/>
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-5 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                  <label for="category"
                         class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    所属类别<span class="text-red-500">*</span>
                  </label>
                  <div class="mt-1 col-span-4 sm:mt-0">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                      <div class="sm:col-span-3">
                        <label class="block text-sm font-medium text-gray-700">
                          主类别<span class="text-red-500"> * </span>
                        </label>
                        <div class="mt-1">
                          <select v-model="form.parent_id"
                                  class="block w-full max-w-lg rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm sm:max-w-xs sm:text-sm">
                            <option v-for="category in _.filter(categories, { level: 0 })"
                                    :value="category.id">{{ category.name }}
                            </option>
                          </select>
                        </div>
                        <JetInputError :message="form.errors.parent_id" class="mt-2"/>
                      </div>
                      <div class="sm:col-span-3">
                        <label for="last-name" class="block text-sm font-medium text-gray-700">
                          子类别<span class="text-red-500"> * </span>
                        </label>
                        <div class="mt-1">
                          <select v-model="form.category_id"
                                  class="block w-full max-w-lg rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm sm:max-w-xs sm:text-sm">
                            <option
                              v-for="category in _.filter(categories, { parent_id: form.parent_id })"
                              :value="category.id">{{ category.name }}
                            </option>
                          </select>
                        </div>
                        <JetInputError :message="form.errors.category_id" class="mt-2"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-5 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                  <label for="about"
                         class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    内容<span class="text-red-500">*</span>
                  </label>
                  <div class="mt-1 sm:mt-0 col-span-4">
                    <Editor
                      api-key="eq51qrnan6h80nwa343xxre3tnbsqkjy1rftzhzh6qoolvt7"
                      :init="{
                                                plugins: 'advlist autolink link image media lists preview code help fullscreen table autoresize codesample wordcount',
                                                toolbar: 'undo redo | preview fullscreen | styleselect | fontsizeselect bold italic underline strikethrough forecolor backcolor | link image media blockquote removeformat codesample | alignleft aligncenter alignright  alignjustify| indent outdent bullist numlist table subscript superscript | code',
                                                min_height: 400,
                                                convert_urls: false,
                                                file_picker_types: 'image',
                                                images_upload_handler: imageUploadHandler,
                                                content_style: 'img { max-width: 100%; }',
                                            }"
                      v-model="form.body"
                      placeholder="请填入至少三个字符的内容"
                    ></Editor>
                    <p class="mt-2 text-sm text-gray-500">话题内容</p>
                    <JetInputError :message="form.errors.body" class="mt-2"/>
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-5 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                  <div>
                    <div
                      class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                      id="label-email">是否需要自动公开
                    </div>
                  </div>
                  <div class="mt-4 col-span-4 sm:mt-0">
                    <div class="max-w-lg space-y-4">
                      <div class="relative flex items-start">
                        <div class="flex h-5 items-center">
                          <input id="is_released" v-model="form.is_released" type="checkbox" checked
                                 class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="is_released"
                                 class="font-medium text-gray-700">Release</label>
                          <p class="text-gray-500">是否要预约自动公开话题</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-5 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                  <JetLabel for="name" value="自动公开日期"/>
                  <div class="col-span-4">
                    <JetInput
                      id="name"
                      v-model="form.released_at"
                      type="datetime-local"
                      class="mt-1 block w-full"
                      autocomplete="name"
                    />
                    <JetInputError :message="form.errors.released_at" class="mt-2"/>
                  </div>
                </div>
              </div>
            </div>

            <div class="pt-5">
              <div class="flex justify-end">
                <Link :href="$page.props.previous">
                  <JetSecondaryButton>
                    Cancel
                  </JetSecondaryButton>
                </Link>
                <JetButton
                  class="ml-3"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Confirm
                </JetButton>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped lang="scss">
</style>
