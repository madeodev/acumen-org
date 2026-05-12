<template>
  <article
    class="grid md:grid-cols-[repeat(13,_minmax(0,_1fr))] gap-7.5"
    :class="classes['wrapper']"
  >
    <a
      :href="post.link"
      :target="post.target ?? '_self'"
      :class="classes['image-wrapper']"
      class="block link-no-underline md:col-span-9"
      aria-hidden="true"
      tabindex="-1"
    >
      <card-image
        :image="post.featured_image_html?.card"
        :icon="post.media_format && post.media_format.icon_path"
        :classes="classes"
      />
    </a>

    <div class="md:col-span-4">
      <post-card-info
        :post="post"
        :classes="classes"
        class="-ml-0.5"
      />
    </div>
  </article>
</template>

<script setup>
import { computed } from 'vue';
import PostCardInfo from './PostCardInfo.vue';
import CardImage from './CardImage.vue';

const props = defineProps({
  post: {
    type: Object,
    default: () => ({}),
    required: true,
  },
  classes: {
    type: Object,
    default: () => ({}),
  },
});

const classes = computed(() => {
  return props.post.card_classes['1-up'];
});
</script>
