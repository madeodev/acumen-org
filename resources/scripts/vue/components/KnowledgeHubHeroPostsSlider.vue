<template>
  <div class="pt-0 py-8 sm:pt-8"
  >
    <!-- Loading State --> 
    <div
      v-if="isLoading"
      class="text-center"
      v-html="labels.loading"
    />
    
    <!-- Posts Slider -->
    <div v-else>
      <!-- Empty State -->
      <div
        v-if="resources.length === 0" 
        class="text-center"
        v-html="labels.empty"
      />
      
      <h2 class="text-2xl font-bold mb-8 container-fluid" v-html="postsSliderTitle"></h2>
      
      <!-- Carousel -->
      <div
        x-data="carouselKnowledgeHub"
        :key="'carousel-' + resources.length"
        class="relative lg:mr-0 xl:mr-carousel-overflow"
        @carousel-slide-change="hoveredCardIndex = $event.detail.activeSlide"
      >
        <div
          class="swiper w-full h-fit pb-3"
          tabindex="0"
          x-ref="swiper"
        >
          <div class="swiper-wrapper"> 
            <article
              v-for="(post, index) in resources"
              :key="post.ID"
              :aria-posinset="index + 1"
              :aria-setsize="resources.length"
              class="swiper-slide h-auto w-260 sm:w-344 lg:w-auto lg:max-w-636"
              @mouseenter="hoveredCardIndex = index"
              @mouseleave="hoveredCardIndex = hoveredCardIndex === index ? 0 : hoveredCardIndex"
            >
              <a
                :href="post.link"
                :class="[
                  'rounded-10 block link-no-underline bg-white bg-opacity-80 overflow-hidden h-full transition-shadow duration-200',
                  hoveredCardIndex === index ? 'shadow-card' : ''
                ]"
              >
                <!-- Responsive Layout -->
                <div class="flex flex-col lg:flex-row h-full lg:aspect-hero-card">
                  <!-- Featured Image -->
                  <div 
                    v-if="post.featured_image_html?.card"
                    class="w-full lg:w-49% relative overflow-hidden aspect-4/3 lg:aspect-auto"
                  >
                    <div v-html="post.featured_image_html.card" class="scale-125 lg:scale-100 origin-left w-full h-full object-cover">
                    </div>
                  </div>
                  
                  <!-- Content -->
                  <div class="py-12 px-8 flex flex-col flex-grow lg:flex-none lg:justify-between lg:w-51%">
                    <!-- Taxonomy Terms -->
                    <div class="flex flex-col gap-2 mb-5">
                      <!-- Post Type Taxonomy -->
                      <tax-label
                        v-if="post.post_type_object && post.post_type_object?.label !== ''"
                        :tax="post.post_type_object"
                        class="text-sm lg:text-base"
                      />
                      
                      <!-- Problem Taxonomy -->
                      <template v-if="post.problems">
                        <tax-label
                          v-if="post.problems.length > 1"
                          :tax="post.labels.multiProblem"
                          class="text-sm lg:text-base"
                        />
                        <tax-label
                          v-if="post.problems.length === 1 && post.primary_problem?.label"
                          :tax="post.primary_problem"
                          class="text-sm lg:text-base"
                        />
                      </template>
                    </div>
                    
                    <!-- Post Title -->
                    <h3
                      v-if="post.title"
                      class="mb-3 lg:mb-6 text-lg font-semibold lg:font-medium"
                      v-html="post.title"
                    />
                    
                    <!-- Post Excerpt -->
                    <div
                      v-if="post.excerpt"
                      class="text-sm lg:text-md lg:leading-5 line-clamp-3 lg:line-clamp-5 mb-4 flex-grow lg:flex-grow-0"
                      v-html="post.excerpt"
                    ></div>
                    
                    <!-- Read More Link -->
                    <div class="lg:mt-auto">
                      <span class="text-sm lg:text-md font-medium lg:font-bold" v-html="labels.read_more"></span>
                    </div>
                  </div>
                </div>
              </a>
            </article>
          </div>
        </div>

        <!-- Navigation Buttons -->
        <div
          v-if="resources.length"
          class="absolute -bottom-20 right-0 sm:right-5 xl:right-0 flex justify-between w-full sm:justify-end px-5 lg:pr-50 sm:gap-4"
        >
          <button
            x-ref="prev"
            type="button"
            class="w-16 h-16 lg:w-10 lg:h-10 border border-black rounded-full flex items-center justify-center bg-transparent cursor-pointer"
          >
            <inline-svg
              :src="'/wp-content/themes/sage/public/images/arrow-left.2f96d1.svg'"
              class="w-5 h-5 lg:w-2.5 lg:h-2.5"
            />
            <span class="sr-only" v-html="labels.navigation.previous"></span>
          </button>

          <button
            x-ref="next"
            type="button"
            class="w-16 h-16 lg:w-10 lg:h-10 border border-black rounded-full flex items-center justify-center bg-transparent cursor-pointer"
          >
            <inline-svg
              :src="'/wp-content/themes/sage/public/images/arrow-right.465f57.svg'"
              class="w-5 h-5 lg:w-2.5 lg:h-2.5"
            />
            <span class="sr-only" v-html="labels.navigation.next"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import useFetch from '../composables/useFetch';
import useFilters from '../composables/useFilters';
import InlineSvg from 'vue-inline-svg';
import TaxLabel from './TaxLabel.vue';

const props = defineProps({
  endpoints: {
    type: Object,
    required: true,
  },
  labels: {
    type: Object,
    required: true,
  },
  postTypes: {
    type: Array,
    required: true,
  },
  postsSliderTitle: {
    type: String,
    required: true,
  },
});

const { selected } = useFilters('', ref([]), ref([]));

const fetchParams = ref({
  page: 1,
  search: '',
  post: null,
  terms: JSON.stringify([]), 
  per_page: 4,
  post_type: props.postTypes.join(','),
  orderby: 'date',
  order: 'DESC',
});

const {
  resources,
  isLoading,
  load,
} = useFetch(
  props.endpoints.posts,
  selected,
  fetchParams,
  false, 
  false  
);

onMounted(() => {
  load();
});

const hoveredCardIndex = ref(0);

</script>