import { createApp } from 'vue';
import FoundryGrid from './components/FoundryGrid.vue';

const app = document.querySelectorAll('.foundry-grid-vue');

app.forEach((el) => {
  const app = createApp({
    components: {
      FoundryGrid,
    },
  });

  app.mount(el);
});
