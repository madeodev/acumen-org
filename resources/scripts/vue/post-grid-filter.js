import { createApp } from 'vue';
import PostGridFilter from './components/PostGridFilter.vue';

const app = document.querySelectorAll('.post-grid-filter-vue');

app.forEach((el) => {
  const app = createApp({
    components: {
      PostGridFilter,
    },
  });

  app.mount(el);
});
