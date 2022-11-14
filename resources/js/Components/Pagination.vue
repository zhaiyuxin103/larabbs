<template>
  <div v-if="links.length > 3" class="w-full mt-6">
    <nav role="navigation" class="flex items-center justify-between">
      <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    <span v-if="page === 1"
                          class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                        上一页
                    </span>
                    <Link
                      class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                      v-else :href="prevPageUrl">上一页
                    </Link>
                </span>

        <span
          class="py-2">{{ from }} ～ {{ to }} 条 / {{ total }} 条</span>

        <span>
            <Link
              class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
              v-if="currentPage < lastPage" :href="`${nextPageUrl}&${params.key}=${params.value}`">
              下一页
            </Link>
            <span
              class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md"
              v-else>
              下一页
            </span>
        </span>
      </div>

      <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
          <p class="text-sm text-gray-700 leading-5">
            {{ from }} ～ {{ to }} 条 / {{ total }} 条
          </p>
        </div>

        <div>
          <span class="relative z-0 inline-flex rounded-md shadow-sm">
              <span>
                  <span v-if="page === 1">
                      <span
                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                        aria-hidden="true">
                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"/>
                          </svg>
                      </span>
                  </span>
                  <Link rel="prev" v-else
                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                        :href="_.head(links).url">
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"/>
                      </svg>
                  </Link>
              </span>

              <template v-for="(link, key) in _.slice(links, 1, links.length - 1)">
                  <span aria-current="page" v-if="link.label == currentPage">
                      <span
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">{{
                          link.label
                        }}</span>
                  </span>
                  <Link v-else
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                        :href="`${link.url}&${params.key}=${params.value}`">
                      {{ link.label }}
                  </Link>
              </template>

              <span>
                  <Link rel="next"
                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                        v-if="currentPage < lastPage" :href="_.last(links).url">
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"/>
                      </svg>
                  </Link>
                  <span v-else>
                      <span
                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5"
                        aria-hidden="true">
                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"/>
                          </svg>
                      </span>
                  </span>
              </span>
          </span>
        </div>
      </div>
    </nav>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import _ from "lodash";

const props = defineProps({
  links: Array,
  page: Number,
  from: Number,
  to: Number,
  total: Number,
  currentPage: Number,
  lastPage: Number,
  prevPageUrl: String,
  nextPageUrl: String,
  params: Object,
});
</script>
