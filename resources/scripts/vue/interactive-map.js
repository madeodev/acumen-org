import { createApp } from 'vue';
import InteractiveMap from './components/map/InteractiveMap.vue';

function mountMaps() {
  document.querySelectorAll('.interactive-map-vue').forEach((el) => {
    if (el.__vue_app__) {
      return;
    }

    createApp({
      components: {
        InteractiveMap,
      },
    }).mount(el);
  });
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', mountMaps);
} else {
  mountMaps();
}
