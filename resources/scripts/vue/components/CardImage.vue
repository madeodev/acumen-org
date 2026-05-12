<template>
  <div
    :class="classes['image-wrapper']"
    class="h-full overflow-hidden relative"
  >
    <div
      v-if="image"
      :class="classes['image']"
      class="h-full w-full relative"
      v-html="image"
    />

    <div
      v-else
      :class="classes['image']"
      class="h-full w-full bg-black/10 flex items-center"
      aria-hidden="true"
    >
      <inline-svg
        :src="'/wp-content/themes/sage/public/images/logo.svg'"
        class="p-10 w-full h-full grayscale opacity-30 object-contain"
      />
    </div>

    <span
      v-if="icon"
      :class="classes['icon']"
      aria-hidden="true"
    >
      <inline-svg
        aria-hidden="true"
        :src="icon"
        class="w-6 h-6 p-0.5"
      />
    </span>
  </div>
</template>

<script setup>
import InlineSvg from 'vue-inline-svg';

defineProps({
  image: {
    type: String,
    default: '',
    require: true,
  },
  icon: {
    type: String,
    default: '',
  },
  classes: {
    type: Object,
    default: () => ({}),
  },
});
</script>
