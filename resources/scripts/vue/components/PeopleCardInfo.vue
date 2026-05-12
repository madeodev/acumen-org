<template>
  <div :class="classes['wrapper']">
    <div class="relative block w-full overflow-hidden link-no-underline rounded-t-card rounded-br-card aspect-card">
      <a
        v-if="post.open_page"
        :href="post.link"
        class="block w-full h-full link-no-underline"
      >
        <card-image
          :image="post.featured_image_html?.card"
          :icon="'/wp-content/themes/sage/public/images/open-in-full.svg'"
          :classes="classes"
        />
      </a>
      <button
        v-else
        class="w-full h-full"
        aria-hidden="true"
        tabindex="-1"
        @click="openDrawer(post)"
      >
        <card-image
          :image="post.featured_image_html?.card"
          :icon="'/wp-content/themes/sage/public/images/open-in-full.svg'"
          :classes="classes"
        />
      </button>
    </div>

    <div
      v-if="post.topics.length"
      class="flex items-start justify-between gap-2"
    >
      <div class="flex flex-wrap gap-x-5 gap-y-2">
        <tax-label
          v-for="tax in post.topics"
          :key="tax.ID"
          :tax="tax"
          :icon-path="tax.icon_path"
        />
      </div>

      <a
        v-if="post.linkedIn && showSocial"
        :href="post.linkedIn"
        target="_blank"
      >
        <inline-svg
          :src="'/wp-content/themes/sage/public/images/linkedin-fill.svg'"
          aria-hidden="true"
        />
        <span
          class="sr-only"
          v-html="`LinkedIn`"
        />
      </a>
    </div>

    <a
      v-if="post.open_page"
      :href="post.link"
    >
      <h3
        role="presentation"
        class="inline animate-underline"
        v-html="nameBlock"
      />
    </a>

    <button
      v-else
      class="text-left"
      @click="openDrawer(post)"
    >
      <h3
        role="presentation"
        class="inline animate-underline"
        v-html="nameBlock"
      />
    </button>

    <div
      v-if="post.role"
      v-html="post.role"
    />

    <a
      v-if="post.open_page && post.link"
      class="inline-flex gap-1.5 items-center self-start"
      aria-hidden="true"
      tabindex="-1"
      :href="post.link"
    >
      <span
        class="mb-0 h5"
        v-html="post.labels.readmore"
      />
      <inline-svg
        aria-hidden="true"
        :src="'/wp-content/themes/sage/public/images/arrow-right.465f57.svg'"
        class="w-3 h-3"
      />
    </a>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import InlineSvg from 'vue-inline-svg';
import TaxLabel from './TaxLabel.vue';
import CardImage from './CardImage.vue';

const emit = defineEmits(['openDrawer']);
const props = defineProps({
  post: {
    type: Object,
    default: () => ({}),
    required: true,
  },
  showSocial: {
    type: Boolean,
    default: false,
  },
});

function openDrawer(postId) {
  emit('openDrawer', postId);
}

const nameBlock = computed(() => {
  if (props.post.first_name && props.post.last_name) {
    return `${props.post.first_name} <br /> ${props.post.last_name}`;
  }

  return [props.post.title];
});

const classes = computed(() => {
  return props.post.card_classes['4-up'];
});
</script>
