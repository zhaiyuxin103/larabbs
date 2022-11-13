<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';

const props = defineProps({
  user: Object,
});

const form = useForm({
  _method: 'PUT',
  name: props.user.name,
  email: props.user.email,
  avatar: null,
  gender: props.user.gender,
});

const verificationLinkSent = ref(null);
const imagePreview = ref(null);
const imageInput = ref(null);

const updateProfileInformation = () => {
  if (imageInput.value) {
    form.avatar = imageInput.value.files[0];
  }

  form.post(route('user-profile-information.update'), {
    errorBag: 'updateProfileInformation',
    preserveScroll: true,
    onSuccess: () => clearImageInput(),
  });
};

const sendEmailVerification = () => {
  verificationLinkSent.value = true;
};

const selectNewImage = () => {
  imageInput.value.click();
};

const updateImagePreview = () => {
  const avatar = imageInput.value.files[0];

  if (!avatar) return;

  const reader = new FileReader();

  reader.onload = (e) => {
    imagePreview.value = e.target.result;
  };

  reader.readAsDataURL(avatar);
};

const deleteImage = () => {
  Inertia.delete(route('current-user-photo.destroy'), {
    preserveScroll: true,
    onSuccess: () => {
      imagePreview.value = null;
      clearImageInput();
    },
  });
};

const clearImageInput = () => {
  if (imageInput.value?.value) {
    imageInput.value.value = null;
  }
};
</script>

<template>
  <JetFormSection @submitted="updateProfileInformation">
    <template #title>
      Profile Information
    </template>

    <template #description>
      Update your account's profile information and email address.
    </template>

    <template #form>
      <!-- Profile Photo -->
      <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
        <!-- Profile Photo File Input -->
        <input
          ref="imageInput"
          type="file"
          class="hidden"
          @change="updateImagePreview"
        >

        <JetLabel for="avatar" value="Phote"/>

        <!-- Current Profile Photo -->
        <div v-show="! imagePreview" class="mt-2">
          <img :src="user.avatar_link" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
        </div>

        <!-- New Profile Photo Preview -->
        <div v-show="imagePreview" class="mt-2">
                    <span
                      class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                      :style="'background-image: url(\'' + imagePreview + '\');'"
                    />
        </div>

        <JetSecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewImage">
          Select A New Image
        </JetSecondaryButton>

        <JetSecondaryButton
          v-if="user.avatar"
          type="button"
          class="mt-2"
          @click.prevent="deleteImage"
        >
          Remove Image
        </JetSecondaryButton>

        <JetInputError :message="form.errors.avatar" class="mt-2"/>
      </div>

      <!-- Name -->
      <div class="col-span-6 sm:col-span-4">
        <JetLabel for="name" value="Name"/>
        <JetInput
          id="name"
          v-model="form.name"
          type="text"
          class="mt-1 block w-full"
          autocomplete="name"
        />
        <JetInputError :message="form.errors.name" class="mt-2"/>
      </div>

      <!-- Email -->
      <div class="col-span-6 sm:col-span-4">
        <JetLabel for="email" value="Email"/>
        <JetInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
        />
        <JetInputError :message="form.errors.email" class="mt-2"/>

        <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
          <p class="text-sm mt-2">
            Your email address is unverified.

            <Link
              :href="route('verification.send')"
              method="post"
              as="button"
              class="underline text-gray-600 hover:text-gray-900"
              @click.prevent="sendEmailVerification"
            >
              Click here to re-send the verification email.
            </Link>
          </p>

          <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
            A new verification link has been sent to your email address.
          </div>
        </div>
      </div>
    </template>

    <template #actions>
      <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
        Saved.
      </JetActionMessage>

      <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Save
      </JetButton>
    </template>
  </JetFormSection>
</template>
