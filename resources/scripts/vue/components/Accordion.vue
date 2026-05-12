<template>
  <div class="border-b border-black">
    <h2 class="h4">
      <button
        :id="id('title')"
        type="button"
        :aria-controls="id('section')"
        :aria-expanded="open"
        class="py-2.5 flex justify-between gap-7.5 items-center w-full text-left mt-4 group"
        @click="toggle"
      >
        <span
          v-html="title"
        />

        <span
          class="inline-flex items-center justify-center text-center transition-all duration-300 text-md link-no-underline disabled:opacity-50 disabled:pointer-events-none rounded-full border w-8 h-8 flex-shrink-0 border-current text-black bg-transparent p-1 group-hover:text-white group-hover:bg-black group-hover:border-black active:text-white active:bg-black active:border-black"
        >
          <inline-svg
            aria-hidden="true"
            class="transition-all h-1.5"
            :class="open ? 'rotate-180' : ''"
            :src="'/wp-content/themes/sage/public/images/chevron-down.d65226.svg'"
          />
        </span>
      </button>
    </h2>

    <transition-collapse v-show="open">
      <div
        :id="id('section')"
        :aria-labelledby="id('section')"
        role="region"
      >
        <div class="pt-3 pb-4 flex flex-col gap-7.5">
          <slot />
        </div>
      </div>
    </transition-collapse>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import InlineSvg from 'vue-inline-svg';
import TransitionCollapse from './TransitionCollapse.vue';

const emit = defineEmits(['toggleAccordion']);

const props = defineProps({
  title: {
    type: String,
    require: true,
    default: '',
  },
  open: {
    type: Boolean,
    default: false,
  },
  uid: {
    type: String,
    require: true,
    default: '',
  },
});

const open = ref(props.open);

watch(
  () => props.open,
  () => {
    open.value = props.open
  }
);

function toggle(){
  open.value = !open.value
  emit('toggleAccordion', open.value, props.uid)
}

function id(label){
  return `${label}-${props.uid}`
}

</script>
