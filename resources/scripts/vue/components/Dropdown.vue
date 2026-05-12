<template>
  <label
    ref="target"
    class="relative cursor-pointer font-semibold flex flex-col h-full"
  >
    <p class="h6">
      <span
        class="sr-only"
        v-html="`${labels.filter_by} ${options.singular}`"
      />
      <span
        aria-hidden="true"
        class="block lowercase first-letter:capitalize"
        v-html="options.singular"
      />
    </p>
    <button
      :id="`label-${options.slug}`"
      type="button"
      class="h-full px-6 py-4 flex justify-between"
      :class="classes.button"
      :aria-expanded="isOpen ? true : false"
      :aria-label="isOpen ? labels.dropdowns.close : labels.dropdowns.open"
      @click.prevent="toggle"
    >
      <span
        v-if="Object.keys(selected).length <= 0"
        class="whitespace-nowrap text-ellipsis overflow-hidden text-base"
        v-html="labels.all_posts"
      />
      <span
        v-else
        class="whitespace-nowrap text-ellipsis overflow-hidden text-base"
        v-html="selected.label"
      />
      <inline-svg
        aria-hidden="true"
        :src="'/wp-content/themes/sage/public/images/chevron-down.d65226.svg'"
        class="text-current flex-shrink-0"
      />
    </button>

    <ul
      class="w-full h-52 max-h-52 overflow-hidden rounded-card border border-black p-0 absolute top-0 left-0 transition-all ease-in-out duration-200 opacity-0 z-30 mt-2"
      role="listbox"
      :class="[
        isOpen ? 'top-full opacity-100 visible' : 'invisible top-3/4',
        classes.dropdown,
      ]"
      :aria-labelledby="`label-${options.slug}`"
      :aria-activedescendant="selected.taxonomy
        ? `${selected.taxonomy}-${selected.ID}`
        : `${options.slug}-all`"
    >
      <scrollbar>
        <li
          :id="`${options.slug}-all`"
          role="option"
          class="w-full relative z-20 inline-flex items-center leading-none"
          @click.prevent="() => {
            clear();
            close();
          }"
        >
          <button
            type="button"
            class="whitespace-nowrap w-full text-left py-4 px-6 text-ellipsis overflow-hidden hover:bg-black hover:text-white focus-visible:bg-black focus-visible:text-white"
            v-html="labels.all_posts"
          />
        </li>
        <li
          v-for="option in options.terms"
          :id="`${option.taxonomy}-${option.ID}`"
          :key="option.ID"
          class="w-full text-base font-medium relative z-20 inline-flex items-center leading-none"
          @click.prevent="() => {
            select(option);
            close();
          }"
        >
          <button
            type="button"
            class="whitespace-nowrap w-full text-left py-4 px-6 text-ellipsis overflow-hidden hover:bg-black hover:text-white focus-visible:bg-black focus-visible:text-white"
            :class="option.ID === selected.ID && 'bg-gray text-white'"
            :aria-selected="option.ID === selected.ID"
            v-html="option.label"
          />
        </li>
      </scrollbar>
    </ul>
  </label>
</template>

<script>
import { ref, watch } from 'vue';
import { onClickOutside } from '@vueuse/core';
import InlineSvg from 'vue-inline-svg';
import Scrollbar from "vue3-smooth-scrollbar";

export default {
  components: {
    InlineSvg,
    Scrollbar,
  },
  props: {
    selected: {
      default: () => ({}),
      required: true,
      type: Object,
    },
    options: {
      default: () => ({}),
      type: Object,
      required: true,
    },
    labels: {
      default: () => ({}),
      type: Object,
      required: true,
    },
    classes: {
      default: () => ({}),
      type: Object,
    },
  },
  emits: ['close', 'open', 'select', 'clear'],
  setup(props, { emit }) {
    const isOpen = ref(false);
    const target = ref(null);
    const isSelected = ref(false);

    isSelected.value = Object.values(props.selected).length > 0;

    onClickOutside(target, () => close());

    watch(
      () => props.selected,
      (newValue) => {
        isSelected.value = Object.values(newValue).length > 0;
      },
    );

    function close() {
      isOpen.value = false;
    }

    function toggle() {
      isOpen.value = !isOpen.value;
    }

    function select(option) {
      isSelected.value = true;
      emit('select', option);
    }

    function clear(option) {
      isSelected.value = false;
      emit('clear', option);
    }

    return { isOpen, isSelected, close, toggle, select, target, clear };
  },
};
</script>
