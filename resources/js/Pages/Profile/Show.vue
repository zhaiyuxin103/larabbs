<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import JetSectionBorder from '@/Jetstream/SectionBorder.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import { formatDistance } from 'date-fns'
import { zhCN } from 'date-fns/locale';

defineProps({
  confirmsTwoFactorAuthentication: Boolean,
  sessions: Array,
});
</script>

<template>
  <AppLayout title="Profile">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Profile - {{ formatDistance(new Date($page.props.user.last_actived_at), new Date(), {locale: zhCN}) }}
      </h2>
    </template>

    <div>
      <div class="max-w-7xl mx-auto pt-4 sm:pt-6 lg:pt-8 pb-10 sm:px-6 lg:px-8">
        <div v-if="$page.props.jetstream.canUpdateProfileInformation">
          <UpdateProfileInformationForm :user="$page.props.user"/>

          <JetSectionBorder/>
        </div>

        <div v-if="$page.props.jetstream.canUpdatePassword">
          <UpdatePasswordForm class="mt-10 sm:mt-0"/>

          <JetSectionBorder/>
        </div>

        <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
          <TwoFactorAuthenticationForm
            :requires-confirmation="confirmsTwoFactorAuthentication"
            class="mt-10 sm:mt-0"
          />

          <JetSectionBorder/>
        </div>

        <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0"/>

        <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
          <JetSectionBorder/>

          <DeleteUserForm class="mt-10 sm:mt-0"/>
        </template>
      </div>
    </div>
  </AppLayout>
</template>
