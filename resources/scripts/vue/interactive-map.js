import { createApp } from 'vue';
import InteractiveMap from './components/map/InteractiveMap.vue';

const app = document.querySelectorAll('.interactive-map-vue');

app.forEach((el) => {
  const app = createApp({
    components: {
      InteractiveMap,
    },
  });

  app.mount(el);
});
