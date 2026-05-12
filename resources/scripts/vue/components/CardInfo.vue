<template>
  <div :class="classes['wrapper']">
    <a
      :href="post.link.url"
      :target="post.link.target"
      class="relative block w-full h-full overflow-hidden link-no-underline rounded-t-card rounded-br-card aspect-card"
      aria-hidden="true"
      tabindex="-1"
    >
      <card-image
        :image="post.featured_image_html?.card"
        :classes="classes"
      />
    </a>

    <div class="inline-flex w-full gap-x-5 flex-col">
      <tax-label
        v-for="tax in post.card_tax"
        :key="tax.ID"
        :tax="tax"
      />
    </div>

    <h3
      :class="classes['title']"
      role="presentation"
    >
      <a
        :href="post.link.url"
        :target="post.link.target"
        v-html="post.title"
      />
    </h3>

    <p
      v-if="post.excerpt"
      :class="classes['text-area']"
      v-html="post.excerpt"
    />

    <a
      :href="post.link.url"
      :target="post.link.target"
      class="h5 inline-flex gap-1.5 items-center mb-0 animate-underline self-start"
      tabindex="-1"
      aria-hidden="true"
    >
      <span
        class="mb-0 h5"
        v-html="post.labels.readmore"
      />
      <inline-svg
        :src="'/wp-content/themes/sage/public/images/arrow-right.465f57.svg'"
        aria-hidden="true"
      />
    </a>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import InlineSvg from 'vue-inline-svg';
import TaxLabel from './TaxLabel.vue';
import CardImage from './CardImage.vue';

const props = defineProps({
  post: {
    type: Object,
    default: () => ({}),
    required: true,
  },
});

const classes = computed(() => {
  return props.post.card_classes['3-up'];
});
</script>
