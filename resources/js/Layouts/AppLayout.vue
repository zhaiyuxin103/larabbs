<script setup>
import { computed, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { getLocale, setLocale } from "matice";
import { ChevronDownIcon, CheckIcon } from '@heroicons/vue/20/solid'
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
import JetNavLink from '@/Jetstream/NavLink.vue';
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';
import _ from "lodash";

defineProps({
  title: String,
  description: String,
  categoryParentId: {
    type: Number,
    required: false,
  },
  categoryId: {
    type: Number,
    required: false,
  },
});

const categoryTree = computed(() => usePage().props.value.categoryTree)
const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
  Inertia.put(route('current-team.update'), {
    team_id: team.id,
  }, {
    preserveState: false,
  });
};

const logout = () => {
  Inertia.post(route('logout'));
};

const translate = (translate) => {
  setLocale(translate);
  Inertia.patch(route('translates.update', translate));
}
</script>

<template>
  <div>
    <Head>
      <title>{{ title }}</title>
      <meta name="description" :content="description ?? 'LaraBBS 爱好者社区'">
    </Head>

    <JetBanner/>

    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex items-center">
              <!-- Logo -->
              <div class="shrink-0 flex items-center">
                <Link :href="route('dashboard')">
                  <JetApplicationMark class="block h-9 w-auto"/>
                </Link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <JetNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                  Dashboard
                </JetNavLink>
                <JetNavLink :href="route('topics.index')" :active="route().current('topics.index')">
                  Topics
                </JetNavLink>
                <JetDropdown align="left" width="60">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                            Categories
                            <svg
                              class="ml-2 -mr-0.5 h-4 w-4"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                            >
                                <path fill-rule="evenodd"
                                      d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </span>
                  </template>

                  <template #content>
                    <div class="w-40">
                      <template v-for="category in categoryTree">
                        <div class="dropdown relative">
                          <JetDropdownLink
                            :class="{ 'bg-gray-100': categoryParentId === category.id }">
                            {{ category.name }}
                            <svg aria-hidden="true" class="w-5 h-5 inline float-right"
                                 fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                          </JetDropdownLink>
                          <ul
                            class="dropdown-content absolute hidden left-40 top-0 rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white w-40"
                            v-if="category.children">
                            <li v-for="child in category.children">
                              <JetDropdownLink :href="route('categories.show', child.hash_id)"
                                               :class="{ 'bg-gray-100': categoryId === child.id }">
                                {{ child.name }}
                              </JetDropdownLink>
                            </li>
                          </ul>
                        </div>
                      </template>
                    </div>
                  </template>
                </JetDropdown>
              </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
              <JetNavLink :href="route('topics.create')" :active="route().current('topics.create')">
                <font-awesome-icon icon="fa-solid fa-plus" class="text-gray-500"/>
              </JetNavLink>
              <div class="ml-3 relative" v-if="$page.props.user">
                <!-- Teams Dropdown -->
                <JetDropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button type="button"
                              class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                          {{ $page.props.user?.current_team.name }}

                        <svg
                          class="ml-2 -mr-0.5 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path fill-rule="evenodd"
                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd"/>
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <div class="w-60">
                      <!-- Team Management -->
                      <template v-if="$page.props.jetstream.hasTeamFeatures">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                          Manage Team
                        </div>

                        <!-- Team Settings -->
                        <JetDropdownLink
                          :href="route('teams.show', $page.props.user?.current_team)"
                          v-if="$page.props.user">
                          <font-awesome-icon icon="fa-solid fa-gears" class="mr-2"/>
                          Team Settings
                        </JetDropdownLink>

                        <JetDropdownLink v-if="$page.props.jetstream.canCreateTeams"
                                         :href="route('teams.create')">
                          <font-awesome-icon icon="fa-solid fa-user-plus" class="mr-2"/>
                          Create New Team
                        </JetDropdownLink>

                        <div class="border-t border-gray-100"/>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                          Switch Teams
                        </div>

                        <template v-for="team in $page.props.user?.all_teams" :key="team.id">
                          <form @submit.prevent="switchToTeam(team)">
                            <JetDropdownLink as="button">
                              <div class="flex items-center">
                                <svg
                                  v-if="team.id == $page.props.user?.current_team_id"
                                  class="mr-2 h-5 w-5 text-green-400"
                                  fill="none"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  stroke="currentColor"
                                  viewBox="0 0 24 24"
                                >
                                  <path
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>{{ team.name }}</div>
                              </div>
                            </JetDropdownLink>
                          </form>
                        </template>
                      </template>
                    </div>
                  </template>
                </JetDropdown>
              </div>
              <div class="ml-3 relative" v-if="$page.props.user">
                <Link class="inline-flex items-center rounded-full px-3 py-0.5 text-sm font-bold text-white"
                      :class="[ $page.props.user?.notification_count ? 'bg-[#d15b47]' : 'bg-[#EBE8E8]' ]"
                      :href="route('notifications.index')">{{ $page.props.user?.notification_count ?? 0 }}
                </Link>
              </div>
              <div class="ml-3 relative">
                <Menu as="div" class="relative inline-block text-left">
                  <div>
                    <MenuButton
                      class="flex w-full justify-center items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm border-2 border-transparent rounded-full transition">
                      <font-awesome-icon icon="fa-solid fa-language"/>
                      <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true"/>
                    </MenuButton>
                  </div>

                  <transition enter-active-class="transition ease-out duration-100"
                              enter-from-class="transform opacity-0 scale-95"
                              enter-to-class="transform opacity-100 scale-100"
                              leave-active-class="transition ease-in duration-75"
                              leave-from-class="transform opacity-100 scale-100"
                              leave-to-class="transform opacity-0 scale-95">
                    <MenuItems
                      class="absolute right-0 z-10 mt-2 w-48 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                      <div class="py-1" v-for="locale in $page.props.locales">
                        <MenuItem v-slot="{ active }">
                          <a href="#"
                             @click="translate(locale.matice)"
                             class="flex justify-between"
                             :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex items-center px-4 py-2 text-sm']">
                            <div>
                            <span
                              class="w-6 h-6 mr-2 -ml-1 flex-shrink-0 rtl:ml-2 rtl:-mr-1 hover:bg-white hover:text-primary-600 hover:border hover:border-primary-500/10 focus:text-white  bg-primary-500/10 font-semibold rounded-full p-1 text-xs text-indigo-500"
                              :class="[active ? 'bg-white' : 'bg-indigo-200']">{{ _.toUpper(locale.key) }}</span>
                              {{ locale.name }}
                            </div>
                            <CheckIcon class="w-4 h-4 text-indigo-400" v-if="getLocale() === locale.matice"></CheckIcon>
                          </a>
                        </MenuItem>
                      </div>
                    </MenuItems>
                  </transition>
                </Menu>
              </div>
              <div v-if="!$page.props.user" class="hidden pr-6 py-4 sm:block">
                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                  Log in
                </Link>

                <Link :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                  Register
                </Link>
              </div>
              <!-- Settings Dropdown -->
              <div class="ml-3 relative" v-if="$page.props.user">
                <JetDropdown align="right" width="48">
                  <template #trigger>
                    <button v-if="$page.props.jetstream.managesProfilePhotos"
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                      <img class="h-8 w-8 rounded-full object-cover"
                           :src="$page.props.user?.avatar_link" :alt="$page.props.user?.name">
                    </button>

                    <span v-else class="inline-flex rounded-md">
                      <button type="button"
                              class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                          {{ $page.props.user?.name }}

                        <svg
                          class="ml-2 -mr-0.5 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"/>
                        </svg>
                      </button>
                  </span>
                  </template>

                  <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                      Manage Account
                    </div>
                    <JetDropdownLink :href="route('users.show', $page.props.user?.hash_id)">
                      <font-awesome-icon icon="fa-solid fa-user" class="mr-2"/>
                      个人中心
                    </JetDropdownLink>
                    <JetDropdownLink :href="route('profile.show')">
                      <font-awesome-icon icon="fa-solid fa-user-pen" class="mr-2"/>
                      Profile
                    </JetDropdownLink>
                    <JetDropdownLink v-if="$page.props.jetstream.hasApiFeatures"
                                     :href="route('api-tokens.index')">
                      <font-awesome-icon icon="fa-solid fa-key" class="mr-2"/>
                      API Tokens
                    </JetDropdownLink>
                    <div class="border-t border-gray-100"/>
                    <div class="block px-4 py-2 text-xs text-gray-400">
                      Topics & Replies
                    </div>
                    <JetDropdownLink :href="`/users/${$page.props.user?.hash_id}/topics`">
                      <font-awesome-icon icon="fa-solid fa-cubes-stacked" class="mr-2"/>
                      Topics
                    </JetDropdownLink>
                    <JetDropdownLink :href="`/users/${$page.props.user?.hash_id}/replies`">
                      <font-awesome-icon icon="fa-regular fa-comment-dots" class="mr-2"/>
                      Replies
                    </JetDropdownLink>
                    <div class="border-t border-gray-100"/>
                    <div class="block px-4 py-2 text-xs text-gray-400" v-if="$page.props.can.dashboard">
                      Admin
                    </div>
                    <JetDropdownLink href="/admin" as="a" v-if="$page.props.can.dashboard">
                      <font-awesome-icon icon="fa-solid fa-gauge-high" class="mr-2"/>
                      Dashboard
                    </JetDropdownLink>
                    <div class="border-t border-gray-100"/>
                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <JetDropdownLink as="button">
                        <font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" class="mr-2"/>
                        Log Out
                      </JetDropdownLink>
                    </form>
                  </template>
                </JetDropdown>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
              <button
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                @click="showingNavigationDropdown = ! showingNavigationDropdown">
                <svg
                  class="h-6 w-6"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
             class="sm:hidden">
          <div class="pt-2 pb-3 space-y-1">
            <JetResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')" v-if="$page.props.user">
              <font-awesome-icon icon="fa-solid fa-gauge-high" class="mr-2"/>
              Dashboard
            </JetResponsiveNavLink>
            <JetResponsiveNavLink :href="route('topics.index')" :active="route().current('topics.index')">
              <font-awesome-icon icon="fa-solid fa-cubes-stacked" class="mr-2"/>
              Topics
            </JetResponsiveNavLink>
          </div>

          <!-- Responsive Settings Options -->
          <div class="pb-1 border-t border-gray-200" :class="{ 'pt-4': $page.props.user}">
            <div class="flex items-center justify-around px-4" v-if="$page.props.user">
              <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">
                <img class="h-10 w-10 rounded-full object-cover"
                     :src="$page.props.user?.avatar_link" :alt="$page.props.user?.name">
              </div>

              <div>
                <div class="font-medium text-base text-gray-800">
                  {{ $page.props.user?.name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                  {{ $page.props.user?.email }}
                </div>
              </div>
              <JetResponsiveNavLink :href="route('topics.create')"
                                    :active="route().current('topics.create')">
                <font-awesome-icon icon="fa-solid fa-plus" class="text-gray-500"/>
              </JetResponsiveNavLink>
            </div>

            <div class="mt-3 space-y-1">
              <div class="border-t border-gray-200" v-if="$page.props.user"/>

              <div class="block px-4 py-2 text-xs text-gray-400" v-if="$page.props.user">
                Manage Account
              </div>
              <JetResponsiveNavLink :href="route('users.show', $page.props.user?.hash_id)"
                                    :active="route().current('users.show')"
                                    v-if="$page.props.user">
                <font-awesome-icon icon="fa-solid fa-user" class="mr-2"/>
                个人中心
              </JetResponsiveNavLink>
              <JetResponsiveNavLink :href="route('profile.show')"
                                    :active="route().current('profile.show')"
                                    v-if="$page.props.user">
                <font-awesome-icon icon="fa-solid fa-user-pen" class="mr-2"/>
                Profile
              </JetResponsiveNavLink>

              <JetResponsiveNavLink v-if="$page.props.user && $page.props.jetstream.hasApiFeatures"
                                    :href="route('api-tokens.index')"
                                    :active="route().current('api-tokens.index')">
                <font-awesome-icon icon="fa-solid fa-key" class="mr-2"/>
                API Tokens
              </JetResponsiveNavLink>

              <div class="border-t border-gray-200" v-if="$page.props.user"/>

              <div class="block px-4 py-2 text-xs text-gray-400" v-if="$page.props.user">
                Topics & Replies
              </div>
              <JetResponsiveNavLink :href="`/users/${$page.props.user?.hash_id}/topics`"
                                    :active="route().current('users.topics.index')"
                                    v-if="$page.props.user?.hash_id">
                <font-awesome-icon icon="fa-solid fa-cubes-stacked" class="mr-2"/>
                Topics
              </JetResponsiveNavLink>
              <JetResponsiveNavLink :href="`/users/${$page.props.user?.hash_id}/replies`"
                                    :active="route().current('users.replies.index')"
                                    v-if="$page.props.user?.hash_id">
                <font-awesome-icon icon="fa-regular fa-comment-dots" class="mr-2"/>
                Replies
              </JetResponsiveNavLink>

              <div class="border-t border-gray-200" v-if="$page.props.user"/>

              <div class="block px-4 py-2 text-xs text-gray-400" v-if="$page.props.user">
                Admin
              </div>
              <JetResponsiveNavLink href="/admin" v-if="$page.props.user">
                <font-awesome-icon icon="fa-solid fa-gauge-high" class="mr-2"/>
                Dashboard
              </JetResponsiveNavLink>

              <div class="border-t border-gray-200" v-if="$page.props.user"/>

              <!-- Authentication -->
              <form method="POST" @submit.prevent="logout" v-if="$page.props.user">
                <JetResponsiveNavLink as="button">
                  <font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" class="mr-2"/>
                  Log Out
                </JetResponsiveNavLink>
              </form>

              <JetResponsiveNavLink :href="route('login')">
                Login
              </JetResponsiveNavLink>
              <JetResponsiveNavLink :href="route('register')">
                Register
              </JetResponsiveNavLink>

              <!-- Team Management -->
              <template v-if="$page.props.user && $page.props.jetstream.hasTeamFeatures">
                <div class="border-t border-gray-200"/>

                <div class="block px-4 py-2 text-xs text-gray-400">
                  Manage Team
                </div>

                <!-- Team Settings -->
                <JetResponsiveNavLink :href="route('teams.show', $page.props.user?.current_team)"
                                      :active="route().current('teams.show')"
                                      v-if="$page.props.user">
                  <font-awesome-icon icon="fa-solid fa-gears" class="mr-2"/>
                  Team Settings
                </JetResponsiveNavLink>

                <JetResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams"
                                      :href="route('teams.create')"
                                      :active="route().current('teams.create')">
                  <font-awesome-icon icon="fa-solid fa-user-plus" class="mr-2"/>
                  Create New Team
                </JetResponsiveNavLink>

                <div class="border-t border-gray-200"/>

                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                  Switch Teams
                </div>

                <template v-for="team in $page.props.user?.all_teams" :key="team.id">
                  <form @submit.prevent="switchToTeam(team)">
                    <JetResponsiveNavLink as="button">
                      <div class="flex items-center">
                        <svg
                          v-if="team.id == $page.props.user?.current_team_id"
                          class="mr-2 h-5 w-5 text-green-400"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>{{ team.name }}</div>
                      </div>
                    </JetResponsiveNavLink>
                  </form>
                </template>
              </template>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header v-if="$slots.header" class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header"/>
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot/>
      </main>
    </div>
  </div>
</template>

<style scoped>
.dropdown:hover > .dropdown-content {
  display: block;
}
</style>

