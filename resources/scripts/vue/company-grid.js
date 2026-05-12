import { createApp } from 'vue';
import CompanyGrid from './components/CompanyGrid.vue';

const app = document.querySelectorAll('.company-grid-vue');

app.forEach((el) => {
  const app = createApp({
    components: {
      CompanyGrid,
    },
  });

  app.mount(el);
});
