<template>
  <div
    v-if="tax.label"
    class="inline-flex gap-2 items-center justify-center w-fit text-md"
  >
    <p
      class="sr-only"
      v-html="`${taxonomyName}: ${tax.label}`"
    />
    <inline-svg
      v-if="path"
      aria-hidden="true"
      :src="path"
    />
    <span
      class="capitalize"
      aria-hidden="true"
      v-html="tax.label"
    />
  </div>
</template>

<script setup>
import { computed } from 'vue';
import InlineSvg from 'vue-inline-svg';

const props = defineProps({
  tax: {
    type: Object,
    require: true,
    default: () => ({}),
  },
  iconPath: {
    type: String,
    default: '',
  },
});

const taxonomyName = computed(() => {
  return props.tax.taxonomy?.replace('-tax', '');
})

const path = computed(() => {
  if (props.iconPath) {
    return props.iconPath;
  }

  if (props.tax.icon_path) {
    return props.tax.icon_path;
  }

  return '';
});
</script>
