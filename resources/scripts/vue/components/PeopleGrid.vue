<template>
  <div>
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between border-b mb-7.5 pb-7.5">
      <h2 class="mr-4 lg:mb-0">
        <slot name="title" />
      </h2>

      <div v-if="chips">
        <span
          class="sr-only"
          v-html="labels.filter_by"
        />
        <ul class="mt-4 lg:mt-0 inline-flex flex-wrap lg:justify-end gap-3.5">
          <li
            v-for="filter in filterChips.terms"
            :key="filter.ID"
          >
            <button
              type="button"
              :class="isActiveFilter(filter) ? classes.button.active : classes.button.init"
              @click="() => setActiveFilter(filter, () => { reset(true); })"
              v-html="filter.label"
            />
          </li>
          <li>
            <button
              type="button"
              :class="hasFilterGroup(filterChips) ? classes.button.init : classes.button.active"
              @click="clearFilters(filterChips, () => { reset(true) })"
              v-html="labels.filters.all_label"
            />
          </li>
        </ul>
      </div>
    </div>

    <div class="pb-20">
      <div class="w-full inline-flex flex-col lg:flex-row justify-between items-end gap-7.5">
        <div
          class="inline-flex flex-col md:flex-row md:grid md:auto-cols-[1fr] md:grid-flow-col lg:inline-flex gap-7.5 w-full"
        >
          <dropdown
            v-for="filter in filterDropdowns"
            :key="filter.slug"
            :classes="classes.filter"
            :options="filter"
            :labels="labels.filters"
            :selected="getActiveFilter(filter)[0]"
            class="w-full lg:w-1/3 xl:w-1/4"
            @select="setActiveFilter($event, () => { reset(true); })"
            @clear="clearFilters(filter, () => { reset(true); })"
          />
        </div>

        <search
          class="w-full lg:w-1/3 xl:w-1/4"
          :labels="labels.search"
          :classes="classes.filter"
          @submit="(term) => {
            resetPage();
            setSearch(term);
            load(0, true);
          }"
          @load="(term) => { setSearch(term); }"
        />
      </div>

      <div
        v-if="selected.length"
        class="pt-5 lg:pt-7.5 hidden lg:block"
      >
        <active-filters
          :selected="selected"
          :classes="classes.button"
          :labels="labels.filters"
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
    </div>

    <grid-results
      :key="gridComponentKey"
      aria-live="polite"
      aria-relevant="additions text"
      :aria-busy="isLoading"
    >
      <div
        v-if="resources.length && !isLoading"
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-7.5 gap-y-5"
      >
        <article
          v-for="post, key in resources"
          :key="post.ID"
          :aria-posinset="key + 1"
          :aria-setsize="totalPosts"
        >
          <transition-fade appear>
            <people-card-info
              :post="post"
              @open-drawer="openDrawer(post)"
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

      <teleport to="body">
        <use-focus-trap
          v-if="drawer"
          :options="{ immediate: true }"
        >
          <people-drawer
            :post="drawer"
            :labels="labels.drawer"
            :classes="classes"
            @close-drawer="closeDrawer"
          />
        </use-focus-trap>
      </teleport>

      <div class="border-t border-black mt-7.5">
        <pagination
          v-if="maxPages > 1"
          class="pt-15"
          :labels="labels.pagination"
          :current="page"
          :pages="maxPages"
          :btn-class="classes.button"
          @change="(newPage) => { load(newPage, true); }"
        />
      </div>
    </grid-results>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { debounce } from 'lodash';
import { UseFocusTrap } from '@vueuse/integrations/useFocusTrap/component';

import useFetch from '../composables/useFetch';
import useFilters from '../composables/useFilters';
import Pagination from './Pagination.vue';
import Search from './Search.vue';
import PeopleCardInfo from './PeopleCardInfo.vue';
import PeopleDrawer from './PeopleDrawer.vue';
import Dropdown from './Dropdown.vue';
import GridResults from './GridResults.vue';
import TransitionFade from './TransitionFade.vue';
import ActiveFilters from './ActiveFilters.vue';

const drawer = ref(null);

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
  preselected: {
    type: Object,
    default: () => ({}),
  },
});

const {
  filterGroups,
  selected,
  setActiveFilter,
  getActiveFilter,
  getFilterGroup,
  isActiveFilter,
  clearFilters,
  removeActiveFilter,
  hasFilterGroup,
} = useFilters(props.endpoints.terms, ref(props.prefilter));

const filterChips = computed(() => getFilterGroup(props.chips));
const perpage = ref(12);
const isMobile = ref(false);
const gridComponentKey = ref(Math.ceil(Math.random() * 1000000));

const filterDropdowns = computed(() =>
  filterGroups.value.filter((group) => {
    return group.slug !== props.chips;
  }),
);

const {
  resources,
  page,
  totalPosts,
  maxPages,
  load,
  setSearch,
  reset,
  resetPage,
  isLoading,
  setPost,
  getPost,
  setPerPage,
} = useFetch(
  props.endpoints.posts,
  selected,
  ref({
    per_page: perpage.value,
    post__in: props.preselected,
    orderby: props.preselected.length ? 'post__in' : null,
  }),
  true,
);

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

onMounted(async () => {
  const urlParams = new URLSearchParams(window.location.search);
  if (!urlParams.get('team')) {
    return;
  }

  const post = await getPost('team');

  if (post) {
    openDrawer(post);
  }
})

function openDrawer(obj) {
  drawer.value = obj;
  setPost(drawer.value);
  document.body.classList.add('overflow-hidden');
}

function closeDrawer() {
  drawer.value = null;
  setPost(drawer.value);
  document.body.classList.remove('overflow-hidden');
}
</script>
