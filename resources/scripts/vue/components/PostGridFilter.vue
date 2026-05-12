<template>
  <div>
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between border-b pb-7.5">
      <h2 class="mb-7.5 lg:mb-0 mr-4">
        <slot name="title" />
      </h2>

      <search
        class="w-full lg:w-1/2 xl:w-1/4 lg:pl-3.75 xl:pl-14"
        :labels="labels.search"
        @submit="(term) => {
          resetPage();
          setSearch(term);
          load(0, true);
        }"
        @load="(term) => {
          setSearch(term);
        }"
      />
    </div>

    <div class="lg:mt-7.5 mb-16 pb-4 border-b border-black lg:border-none">
      <button
        class="flex lg:hidden items-center w-full justify-between text-black py-2.5 h4 mb-0"
        @click="handleFilterCollapse"
      >
        <span
          class="block mr-4"
          v-html="labels.filters.mobile_label"
        />
        <span
          class="rounded-full border border-black w-[42px] h-[42px] flex-shrink-0 flex items-center justify-center p-1"
        >
          <inline-svg
            aria-hidden="true"
            class="transition-transform"
            :src="'/wp-content/themes/sage/public/images/chevron-down.d65226.svg'"
            :class="{ 'rotate-180': isExpanded }"
          />
        </span>
      </button>

      <div class="lg:hidden">
        <Collapse :when="isExpanded">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3.25 md:gap-7.5 pb-5">
            <dropdown
              v-for="filter in filterDropdowns"
              :key="filter.slug"
              :classes="classes.filter"
              :options="filter"
              :labels="labels.filters"
              :selected="getActiveFilter(filter)[0]"
              class="w-4/5 md:w-full"
              @select="setActiveFilter($event, () => {
                reset(true);
              })"
              @clear="clearFilters(filter, () => {
                reset(true);
              })"
            />
          </div>
        </Collapse>
      </div>

      <div class="hidden lg:grid grid-cols-4 gap-7.5 xl:gap-x-25">
        <dropdown
          v-for="filter in filterDropdowns"
          :key="filter.slug"
          :classes="classes.filter"
          :options="filter"
          :labels="labels.filters"
          :selected="getActiveFilter(filter)[0]"
          @select="setActiveFilter($event, () => {
            reset(true);
          })"
          @clear="clearFilters(filter, () => {
            reset(true);
          })"
        />
      </div>

      <active-filters
        v-if="selected.length"
        :selected="selected"
        :classes="classes.button"
        :labels="labels.filters"
        class="pt-5 lg:pt-7.5 "
        @clear="() => {
          clearFilters();
          reset(true);
        }"
        @remove-selected="(filter) => {
          removeActiveFilter(filter);
          reset(true);
        }"
      />
    </div>

    <grid-results
      :key="gridComponentKey"
      aria-live="polite"
      aria-relevant="additions text"
      :aria-busy="isLoading"
    >
      <div
        v-if="resources.length && !isLoading"
        class="grid justify-between grid-cols-1 gap-10 md:grid-cols-3 lg:gap-20"
      >
        <article
          v-for="(post, key) in resources"
          :key="post.ID"
          :aria-posinset="key + 1"
          :aria-setsize="totalPosts"
          :class="[key === 3 || key === 4 ? 'md:col-span-3' : '']"
        >
          <transition-fade appear>
            <post-large
              v-if="key === 3 || key === 4"
              :post="post"
              :class="[
                key === 3
                  ? 'md:border-y md:py-20'
                  : 'md:[&>div]:order-1 md:[&>a]:order-2 md:border-b md:pb-20',
              ]"
              class="flex-col md:border-black"
            />
            <post-tile
              v-else
              :post="post"
            />
          </transition-fade>
        </article>
      </div>

      <div v-else>
        <div
          v-if="isLoading"
          class="text-center"
          v-html="labels.loading"
        />
        <div
          v-else
          class="text-center"
          v-html="labels.empty"
        />
      </div>

      <div class="border-t border-black mt-7.5">
        <pagination
          v-if="maxPages > 1"
          class="pt-15"
          :labels="labels.pagination"
          :current="page"
          :pages="maxPages"
          :btn-class="classes.button"
          @change="(newPage) => {
            load(newPage, true);
          }"
        />
      </div>
    </grid-results>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { debounce } from 'lodash';

import useFetch from '../composables/useFetch';
import useFilters from '../composables/useFilters';
import InlineSvg from 'vue-inline-svg';
import PostTile from './PostTile.vue';
import PostLarge from './PostLarge.vue';
import Pagination from './Pagination.vue';
import Search from './Search.vue';
import Dropdown from './Dropdown.vue';
import ActiveFilters from './ActiveFilters.vue';
import TransitionFade from './TransitionFade.vue';
import GridResults from './GridResults.vue';
import { Collapse } from 'vue-collapsed';

const isExpanded = ref(false);

const props = defineProps({
  endpoints: {
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
  prefilter: {
    type: Object,
    default: () => ({}),
  },
  chips: {
    type: String,
    default: '',
  },
  postType: {
    type: Object,
    default: () => ({}),
    required: true,
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
});

const filterDropdowns = computed(() =>
  filterGroups.value.filter((group) => {
    return group.slug !== props.chips;
  }),
);

const perpage = ref(8);
const isMobile = ref(false);
const gridComponentKey = ref(Math.ceil(Math.random() * 1000000));

const {
  filterGroups,
  selected,
  setActiveFilter,
  getActiveFilter,
  clearFilters,
  removeActiveFilter,
} = useFilters(props.endpoints.terms, ref(props.prefilter), ref(props.filters));

const {
  resources,
  totalPosts,
  page,
  maxPages,
  load,
  setSearch,
  reset,
  resetPage,
  isLoading,
  setPerPage,
} = useFetch(
  props.endpoints.posts,
  selected,
  ref({
    per_page: perpage.value,
    post_type: props.postType,
  }),
  true,
);

const handleFilterCollapse = () => {
  isExpanded.value = !isExpanded.value;
};

const resizeHandler = () => {
  if (window.innerWidth < 768) {
    if (!isMobile.value) {
      perpage.value = 4;
      isMobile.value = true;
      forceRerender();
    }
  } else {
    if (isMobile.value) {
      isMobile.value = false;
      perpage.value = 12;
      forceRerender();
    }
  }
};

const forceRerender = () => {
  gridComponentKey.value += 1;
  setPerPage(perpage.value);
  load();
}

resizeHandler();
window.addEventListener('resize', debounce(resizeHandler));
</script>
