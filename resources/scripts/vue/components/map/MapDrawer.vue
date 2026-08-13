<template>
  <transition-slide-in
    appear
    @after-enter="drawerIn"
    @after-leave="drawerOut"
  >
    <div
      v-if="active"
      ref="drawer"
      v-on-click-outside="close"
      role="dialog" 
      :aria-labelledby="'dialog-title-'+data.slug" 
      aria-modal="true" 
      :class="data.bg_class"
      class="rounded-l-card p-7.5 flex flex-col gap-7.5 min-w-[337px]"
    >
      <!-- Top Row: close button and taxonomy terms -->
      <div class="flex gap-5 md:gap-10 border-b sm:border-none">
        <button
          ref="closeButton"
          type="button"
          class="w-9 h-9 shrink-0 rounded-full border flex items-center justify-center hover:bg-white hover:text-black hover:border-white"
          @click="close"
        >
          <inline-svg
            aria-hidden="true"
            :src="assets.close"
            class="h-2.5 w-2.5"
          />
          <span
            class="sr-only"
            v-html="labels.close"
          />
        </button>
        <!-- Tax terms -->
        <ul
          v-if="taxonomies?.length"
          class="sm:border-b flex gap-5 w-full flex-wrap pb-5 sm:pb-0 sm:-mt-1"
        >
          <li
            v-for="taxonomy in taxonomies"
            :key="taxonomy.slug"
            class="inline-flex"
          >
            <tax-label :tax="taxonomy" />
          </li>
        </ul>
      </div>

      <!-- Second Row: title, image, excerpt + stats -->
      <div
        class="flex flex-col gap-y-12.5 gap-x-5 lg:flex-row lg:gap-x-7.5 xl:gap-x-12.5 lg:pb-2.5"
      >
        <!-- Title, Image, Excerpt -->
        <div class="flex-shrink basis-3/5">
          <h2
            :id="'dialog-title-'+data.slug"
            class="h4"
            v-html="data.title"
          />
          <div class="flex flex-col gap-5 sm:flex-row md:gap-7.5 xl:gap-12.5">
            <div
              v-if="data.featured_image_html?.card"
              class="mask overflow-hidden h-56 w-56 shrink-0"
              v-html="data.featured_image_html.card"
            />
            <div>
              <p
                v-if="data.excerpt"
                v-html="data.excerpt"
              />
              <a
                :href="link"
                class="inline-flex items-center justify-center text-center transition-all duration-300 text-md link-no-underline disabled:opacity-50 disabled:pointer-events-none py-1.25 px-3.5 gap-2 rounded-full border border-current text-white bg-transparent hover:text-black hover:bg-white hover:border-white active:bg-white"
                v-html="linkTitle"
              />
            </div>
          </div>
        </div>

        <!-- Stats -->
        <ul
          v-if="stats"
          class="grid md:grid-cols-2 gap-y-5 gap-x-7.5 basis-2/5 shrink-0"
        >
          <li
            v-for="(stat, key) in stats"
            :key="key"
            class="block"
          >
            <figure class="pl-5 border-l">
              <div
                class="font-display text-5.5xl font-medium leading-extra-tight tracking-tight"
                v-html="stat.stat"
              />
              <figcaption
                v-if="stat.description"
                class="h6"
                v-html="stat.description"
              />
            </figure>
          </li>
        </ul>
      </div>

      <!-- Third Row: related programs -->
      <div
        v-if="resources.length"
        class="border-t pt-5"
      >
        <div class="mb-6.5 flex gap-5">
          <h3
            class="h4 mr-auto"
            v-html="labels.programs"
          />
          <button
            ref="swiperPrev"
            class="h-9 w-9 border border-white rounded-full flex items-center justify-center hover:bg-white hover:text-black focus-visible:bg-white focus-visible:text-black"
            :aria-label="labels.prev"
          >
            <inline-svg
              aria-hidden="true"
              class="w-3 h-auto"
              :src="assets.arrowLeft"
            />
          </button>
          <button
            ref="swiperNext"
            class="h-9 w-9 border border-white rounded-full flex items-center justify-center hover:bg-white hover:text-black focus-visible:bg-white focus-visible:text-black"
            :aria-label="labels.next"
          >
            <inline-svg
              aria-hidden="true"
              class="w-3 h-auto"
              :src="assets.arrowRight"
            />
          </button>
        </div>
        <swiper-container
          ref="swiper"
          init="false"
          class="-mr-7.5 grid"
        >
          <swiper-slide
            v-for="program in resources"
            :key="program.ID"
            class="w-96 max-w-full pr-7.5"
          >
            <a
              :href="program.link"
              :target="program.target"
              :class="data.program_hover"
              class="h-full group mask overflow-hidden block bg-white link-no-underline relative focus-visible:!outline-none"
            >
              <!-- This div creates the masked card's border -->
              <div
                :class="data.bg_class"
                aria-hidden="true"
                class="mask group-hover:bg-transparent group-focus-visible:bg-transparent absolute inset-px z-0"
              />
              <div class="p-7.5 flex flex-col gap-5 relative z-10">
                <tax-label
                  :tax="program.type"
                  :icon-path="program.icon_path"
                />
                <h4
                  class="m-0 leading-tight"
                  v-html="program.title"
                />
                <p
                  class="h6 m-0"
                  v-html="program.excerpt"
                />
                <span class="border-b w-fit flex items-center justify-center gap-1.5 pb-1.25 pr-1">
                  <span
                    class="h5 m-0"
                    v-html="labels.learn_more"
                  />
                  <inline-svg
                    aria-hidden="true"
                    :src="assets.arrowRight"
                    class="w-3 h-auto"
                  />
                </span>
              </div>
            </a>
          </swiper-slide>
        </swiper-container>
      </div>
    </div>
  </transition-slide-in>
</template>

<script>

</script>

<script setup>
import { ref, computed, watch, nextTick, onMounted } from 'vue';
import { vOnClickOutside } from '@vueuse/components';
import { useFocusTrap } from '@vueuse/integrations/useFocusTrap'
import InlineSvg from 'vue-inline-svg';
import TransitionSlideIn from '../TransitionSlideIn.vue';
import TaxLabel from '../TaxLabel.vue';
import useFetch from '../../composables/useFetch';
import { register as registerSwiperElement } from 'swiper/element/bundle';

const emit = defineEmits(['closeDrawer']);

const props = defineProps({
  active: {
    type: Boolean,
    default: false,
    required: true,
  },  
  data: {
    type: Object,
    default: () => ({}),
    required: true,
  },
  labels: {
    type: Object,
    require: true,
    default: () => {},
  },
  endpoint: {
    type: String,
    require: true,
    default: '',
  },
  assets: {
    type: Object,
    required: true,
    default: () => ({}),
  },
});

const drawer = ref();
const closeButton = ref();
const swiper = ref();
const swiperNext = ref();
const swiperPrev = ref();

const { activate, deactivate } = useFocusTrap(drawer)

const taxonomies = computed(() => {
  if(props.data.post_type == 'region') return props.data.problems ?? [];
  if(props.data.post_type == 'problem') return props.data.regions ?? [];
  return [];
});

const correspondingTaxonomy = computed(() => {
  const tax = props.data['primary_' + props.data.post_type];
  if( !tax?.ID ) return [];
  return [tax]; 
});

const link = computed(() => {
  return props.data.custom_link?.url ?? props.data.link;
})

const linkTitle = computed(() => {
  return props.data.custom_link?.title ?? props.labels.learn_more;
})

const { resources, load } = useFetch(props.endpoint, correspondingTaxonomy, ref({ per_page: -1 }), true, false);

// Filter out empty stats
const stats = computed(() => {
  if (!props.data.stats?.stats) return [];
  return props.data.stats.stats.filter((stat) => stat?.stat);
});

watch(
  () => props.active,
  () => {
    if (!correspondingTaxonomy.value[0]?.ID) return;
    if (resources.value.length) return; 
    if (!props.active) return;
    load();
  },
);

onMounted(()=>{
  registerSwiperElement();
  if(props.active && correspondingTaxonomy.value[0]?.ID) load();
})

watch(resources, () => {
  setupSwiper();
});

function drawerIn() {
  setupSwiper();
  activate();
}

function drawerOut() {
  deactivate();
}

function close() {
  emit('closeDrawer');
}

function setupSwiper() {
  if (!resources.value.length) return;
  nextTick(() => {
    Object.assign(swiper.value, {
      a11y: true,
      keyboard: true,
      cssMode: true,
      slidesPerView: 'auto',
      spaceBetween: 20,
      navigation: {
        nextEl: swiperNext.value,
        prevEl: swiperPrev.value,
      },
    });
    swiper.value.initialize();
  });
}
</script>
