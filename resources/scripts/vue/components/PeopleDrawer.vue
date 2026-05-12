<template>
  <div
    class="fixed top-0 right-0 z-50 flex justify-end w-screen h-screen"
    role="dialog"
    aria-modal="true"
    :aria-labelledby="`label_${post.slug}`"
    :aria-describedby="`desc_${post.slug}`"
  >
    <transition-slide-fade appear>
      <div
        class="rounded-tl-card py-30 px-20 md:w-[65vw] h-full overflow-auto relative z-10"
        :class="classes['wrapper']"
      >
        <div class="flex justify-between">
          <div class="md:w-1/2">
            <div :class="cardClasses['wrapper']">
              <div
                v-if="post.featured_image_html?.drawer"
                class="w-full h-full overflow-hidden rounded-t-card rounded-br-card aspect-drawer"
                v-html="post.featured_image_html.drawer"
              />

              <div
                v-if="post.drawer_topics.length || post.linkedIn"
                class="flex items-start justify-between gap-2"
              >
                <div class="flex flex-wrap gap-x-5 gap-y-2">
                  <tax-label
                    v-for="tax in post.drawer_topics"
                    :key="tax.ID"
                    :tax="tax"
                    :icon-path="tax.icon_path"
                  />
                </div>

                <a
                  v-if="post.linkedIn"
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

              <h3
                :id="`label_${post.slug}`"
                v-html="nameBlock"
              />

              <div
                v-if="post.role"
                v-html="post.role"
              />
            </div>
          </div>

          <div class="w-1/4 text-right">
            <button
              type="button"
              class="p-1 w-9 h-9"
              :class="classes.button.icon"
              @click="close"
            >
              <inline-svg
                aria-hidden="true"
                :src="'/wp-content/themes/sage/public/images/close.fda38d.svg'"
              />
              <span
                class="sr-only"
                v-html="labels.close"
              />
            </button>
          </div>
        </div>

        <div
          :id="`label_${post.slug}`"
          class="w-full border-t border-black mt-7.5 pt-7.5"
          v-html="post.content"
        />
      </div>
    </transition-slide-fade>

    <transition-fade appear>
      <div
        class="absolute z-0 w-full h-full bg-black/80"
        aria-hidden="true"
        @click="close"
      />
    </transition-fade>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import TransitionSlideFade from './TransitionSlideFade.vue';
import TransitionFade from './TransitionFade.vue';
import InlineSvg from 'vue-inline-svg';
import TaxLabel from './TaxLabel.vue';

const emit = defineEmits(['closeDrawer']);

const props = defineProps({
  post: {
    type: Object,
    default: () => ({}),
    required: true,
  },
  labels: {
    type: Object,
    default: () => ({}),
    required: true,
  },
  classes: {
    type: Object,
    default: () => ({}),
    required: true,
  },
});

function close() {
  emit('closeDrawer');
}

const nameBlock = computed(() => {
  if (props.post.first_name && props.post.last_name) {
    return `${props.post.first_name} <br /> ${props.post.last_name}`;
  }

  return [props.post.title];
});

const cardClasses = computed(() => {
  return props.post.card_classes['4-up'];
});
</script>
