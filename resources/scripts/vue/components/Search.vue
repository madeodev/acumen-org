<template>
  <div class="">
    <label
      for="search"
      class="lg:sr-only h6 block"
      v-html="labels.label"
    />

    <div class="flex items-center relative">
      <input
        type="search"
        name="search"
        class="pr-14 py-3 text-base border-black placeholder:text-black/60"
        :placeholder="labels.placeholder"
        :value="initValue"
        @keyup="handleSearch"
      >

      <button
        type="submit"
        class="flex items-center justify-center"
        @click="handleSearch"
      >
        <span
          class="sr-only"
          v-html="labels.submit"
        />
        <inline-svg
          aria-hidden="true"
          :src="'/wp-content/themes/sage/public/images/search.a86847.svg'"
          class="absolute right-6 h-full top-0"
        />
      </button>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import InlineSvg from 'vue-inline-svg';

const emit = defineEmits(['load', 'submit']);

defineProps({
  labels: {
    type: Object,
    default: () => ({}),
  },
});

const initValue = computed(() => {
  if (window.location.search) {
    return getSearchValue();
  }

  return '';
});

if (window.location.search) {
  const search = getSearchValue();

  if (search) {
    emit('load', search);
  }
}

function getSearchValue() {
  const urlParams = new URLSearchParams(window.location.search);

  if (urlParams.get('search') !== '') {
    return urlParams.get('search');
  }
}

function handleSearch(event) {
  event.preventDefault();
  emit('submit', event.currentTarget.value);
}
</script>
