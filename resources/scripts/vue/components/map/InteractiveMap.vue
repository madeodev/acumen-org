<template>
  <div class="relative pt-8 pb-25">
    <div class="container-fluid min-h-[600px]">
      <div
        aria-hidden="true"
        class="lg:-mr-20 [&>svg]:w-full [&>svg]:h-auto"
      >
        <slot name="map">
          <inline-svg
            v-if="assets.map"
            class="w-full h-auto"
            :src="assets.map"
          />
        </slot>
      </div>

      <div class="md:w-80 md:absolute md:top-20 md:bottom-0 overflow-auto px-1 pt-1">
        <accordion
          v-for="(accordionSection, key) in sections"
          :key="key"
          :uid="key"
          :open="openAccordion == key"
          :title="labels[key]"
          :icon-src="assets.chevronDown"
          @toggle-accordion="handleAccordionToggle"
        >
          <ul>
            <li
              v-for="post in accordionSection"
              :key="post.ID"
            >
              <button
                class="pr-3 flex items-center gap-5 transition-all rounded text-md text-left"
                :class="
                  currentHighlight?.ID == post.ID &&
                    post.bg_class + ' pl-3.5 font-semibold'
                "
                @click="openDrawer(post)"
                @mouseover="setHighlight(post)"
                @focus="setHighlight(post)"
              >
                <span
                  class="py-2"
                  v-html="post.title"
                />

                <inline-svg
                  v-show="currentHighlight?.ID == post.ID"
                  aria-hidden="true"
                  class="h-3.5 w-3.5 mx-0.75 transition-opacity"
                  :src="assets.open"
                />
              </button>
            </li>
          </ul>
        </accordion>
      </div>
    </div>

    <template v-for="section in sections">
      <map-drawer
        v-for="post in section" 
        :key="post.ID"
        :active="drawer.ID == post.ID"
        :data="post"
        :endpoint="endpoint"
        :labels="labels"
        :assets="assets"
        tabindex="-1"
        class="absolute right-0 top-0 left-auto ml-16 z-infinity max-w-screen-2xl w-90vw"
        @close-drawer="closeDrawer"
      />
    </template>

    <div
      v-if="drawer.ID"
      class="fixed inset-0 w-full h-full bg-black/50 z-50"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import InlineSvg from 'vue-inline-svg';
import useFetch from '@scripts/vue/composables/useFetch';
import Accordion from '../Accordion.vue';
import MapDrawer from './MapDrawer.vue';
import colors from '@tailwind/colors';

const props = defineProps({
  endpoint: {
    type: String,
    require: true,
    default: '',
  },
  sections: {
    type: Object,
    require: true,
    default: () => ({}),
  },
  labels: {
    type: Object,
    require: true,
    default: () => {},
  },
  assets: {
    type: Object,
    required: true,
    default: () => ({}),
  },
});

const openAccordion = ref('region')
const drawer = ref({});
const currentHighlight = ref(null);
const color = ref('');
const currentCountries = ref([]);

const {setPost} = useFetch(null, ref([]), ref(), false, false)

onMounted(()=>{
  openDrawerFromUrl();
})

function setHighlight(post) {
  currentHighlight.value = post;
  color.value = colors[post.color];

  unHighlightCountries();

  currentCountries.value = post.countries ?? [];

  post.countries?.forEach((country) => {
    const element = document.getElementById(country);
    if (element) {
      element.classList.add('currentCountry');
      // Directly set fill color to override inline styles
      const paths = element.querySelectorAll('path:not(.patternFill)');
      paths.forEach(path => {
        path.style.fill = color.value;
        path.style.setProperty('fill', color.value, 'important');
      });
    }
  });
}

function unHighlightCountries() {
  currentCountries.value?.forEach((country) => {
    const element = document.getElementById(country);
    if (element) {
      element.classList.remove('currentCountry');
      // Reset fill color back to original
      const paths = element.querySelectorAll('path:not(.patternFill)');
      paths.forEach(path => {
        path.style.fill = '';
        path.style.removeProperty('fill');
      });
    }
  });
  currentCountries.value = [];
}

function openDrawer(post) {
  drawer.value = post;
  setPost({
    ...post,
    post_type: 'map-'+post.post_type,
  });
}

function openDrawerFromUrl(){
  const url = new URL(window.location.href);
  const urlSearch = new URLSearchParams(url.search);

  for (const key in props.sections){
    if (!urlSearch.has('map-'+key)) continue;

    const slug = urlSearch.get('map-'+key);
    const post = props.sections[key].find(entry => entry.slug == slug)
    
    if(!post) continue;
    drawer.value = post;
    openAccordion.value = key;
  }
}

function clearUrlParams(){
  window.history.pushState(
    null,
    null,
    `${window.location.origin}${window.location.pathname}`,
  );
}

function handleAccordionToggle(open, key){
  if (open) openAccordion.value = key
}

function closeDrawer() {
  drawer.value = {};
  clearUrlParams()
}

document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') closeDrawer();
});

</script>

<style>
.currentCountry path:not(.patternFill) {
  transition: fill 300ms, stroke 300ms;
}

.currentCountry.kashmir path.solidFill {
  transition: stroke 300ms;
}
</style>
