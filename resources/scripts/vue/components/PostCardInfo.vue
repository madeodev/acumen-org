<template>
  <div :class="classes['text-area']">
    <div
      v-if="post.post_type_object?.label || post.primary_problem?.label"
      class="inline-flex flex-col flex-wrap gap-x-5 w-full"
    >
      <tax-label
        v-if="post.post_type_object && post.post_type_object?.label !== ''"
        :tax="post.post_type_object"
      />
      <template v-if="post.problems">
        <tax-label
          v-if="post.problems.length > 1"
          :tax="post.labels.multiProblem"
        />
        <tax-label
          v-else-if="post.primary_problem?.label !== ''"
          :tax="post.primary_problem"
        />
      </template>
    </div>

    <h3
      :class="classes['title']"
      role="presentation"
    >
      <a
        :href="post.link"
        :target="post.target ?? '_self'"
        class="text-left"
        v-html="post.title"
      />
    </h3>

    <p
      v-if="post.excerpt"
      class="my-0"
      v-html="post.excerpt"
    />

    <a
      :href="post.link"
      :target="post.target ?? '_self'"
      class="inline-flex gap-1.5 items-center mb-0 h5"
      tabindex="-1"
      aria-hidden="true"
    >
      <span v-html="post.labels.readmore" />
      <inline-svg
        :src="'/wp-content/themes/sage/public/images/arrow-right.465f57.svg'"
        class="w-3 h-3"
      />
    </a>
  </div>
</template>

<script setup>
import InlineSvg from 'vue-inline-svg';
import TaxLabel from './TaxLabel.vue';

defineProps({
  post: {
    type: Object,
    default: () => ({}),
    required: true,
  },
  labels: {
    type: Object,
    default: () => ({}),
  },
  classes: {
    type: Object,
    default: () => ({}),
  },
});

</script>
