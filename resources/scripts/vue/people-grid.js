import { createApp } from 'vue';
import PeopleGrid from './components/PeopleGrid.vue';

const app = document.querySelectorAll('.people-grid-vue');

app.forEach((el) => {
  const app = createApp({
    components: {
      PeopleGrid,
    },
  });

  app.mount(el);
});
