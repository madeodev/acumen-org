<template>
  <article :class="classes['wrapper']">
    <a
      :href="post.link"
      :target="post.target ?? '_self'"
      :class="classes['image-wrapper']"
      class="block link-no-underline"
      aria-hidden="true"
      tabindex="-1"
    >
      <card-image
        :image="post.featured_image_html?.card"
        :icon="post.media_format && post.media_format.icon_path"
        :classes="classes"
      />
    </a>

    <post-card-info
      :post="post"
      :classes="classes"
    />
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
});

const classes = computed(() => {
  return props.post.card_classes['3-up'];
});
</script>
