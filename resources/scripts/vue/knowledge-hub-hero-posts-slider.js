import { createApp } from 'vue';
import KnowledgeHubHeroPostsSlider from './components/KnowledgeHubHeroPostsSlider.vue';

const app = document.querySelectorAll('.knowledge-hub-hero-posts-slider-vue');

app.forEach((el) => {
  const app = createApp({
    components: {
      KnowledgeHubHeroPostsSlider,
    },
  });

  app.mount(el);
});
