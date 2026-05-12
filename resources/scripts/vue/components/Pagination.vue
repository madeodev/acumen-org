<template>
  <div
    ref="pagination"
    class="grid grid-cols-2 md:grid-cols-6 gap-4 justify-center md:justify-between w-full"
  >
    <div>
      <button
        v-if="current !== 1"
        :class="btnClass.init"
        @click="() => changePage(current - 1)"
      >
        <inline-svg
          aria-hidden="true"
          :src="'/wp-content/themes/sage/public/images/arrow-left.2f96d1.svg'"
        />
        <span v-html="labels.prev" />
      </button>
    </div>

    <ul class="hidden md:inline-flex items-center gap-2.5 md:col-span-4 justify-center">
      <li
        v-for="i in chunk"
        :key="i"
      >
        <button
          v-if="i !== current"
          :class="btnClass.init"
          class="w-10 h-10 flex"
          @click="() => changePage(i)"
        >
          {{ i }}
          <span
            class="sr-only"
            v-html="getPageLabel(i)"
          />
        </button>

        <span
          v-else
          :class="btnClass.active"
          class="w-10 h-10 flex"
        >
          {{ i }}
          <span
            class="sr-only"
            v-html="getPageLabel(i)"
          />
        </span>
      </li>
    </ul>

    <div class="text-right">
      <button
        v-if="current !== pages"
        :class="btnClass.init"
        class="flex-row-reverse"
        @click="() => changePage(current + 1)"
      >
        <inline-svg
          aria-hidden="true"
          :src="'/wp-content/themes/sage/public/images/arrow-right.465f57.svg'"
        />
        <span v-html="labels.next" />
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import InlineSvg from 'vue-inline-svg';

const pagination = ref(null);
const emit = defineEmits(['change']);
const props = defineProps({
  current: {
    type: Number,
    default: 1,
  },
  pages: {
    type: Number,
    default: 1,
  },
  labels: {
    type: Object,
    default: () => ({}),
  },
  btnClass: {
    type: Object,
    default: () => ({}),
  },
});

const getPageLabel = (key) => {
  let str = props.labels.page.replace('x', key);
  str = str.replace('y', props.pages);

  return str;
};

const chunk = computed(() => {
  const endSize = 4;
  const midSize = Math.ceil(endSize / 2);

  if (props.pages > endSize) {
    const lastPages = props.pages - endSize;
    let start = [1];
    let mid = [];
    let last = [props.pages];

    if (props.current + midSize >= props.pages) {
      // reset values
      last = ['...'];

      for (let i = lastPages; i <= props.pages; i++) {
        last.push(i);
      }
    } else {
      if (props.current < endSize) {
        // reset values
        start = [];

        for (let i = 1; i <= endSize; i++) {
          start.unshift(i);
        }

        start.sort();
        start.push('...');
      } else {
        if (props.current >= endSize) {
          start.push('...');
        }

        let hasLast = false;

        for (
          let i = props.current - midSize + 1;
          i <= props.current + midSize - 1;
          i++
        ) {
          if (i < props.pages) {
            mid.unshift(i);
          }

          if (i + 1 >= props.pages) {
            hasLast = true;
          }
        }

        mid.sort((a, b) => a - b);

        if (!hasLast) {
          mid.push('...');
        }
      }
    }

    return [...start, ...mid, ...last];
  }

  return props.pages;
});

function changePage(page) {
  if (!pagination.value) {
    return;
  }

  const parent = pagination.value.closest('section');

  window.scrollTo({
    top: parent.offsetTop - 16,
    behavior: 'smooth',
  });

  setTimeout(() => {
    emit('change', page);
  }, 500);
}
</script>
