import Swiper from 'swiper';
import { Navigation, A11y, Keyboard, Pagination } from 'swiper/modules';
import 'swiper/css';

export default () => ({
  init() {
    this.$nextTick(() => {
      new Swiper(this.$refs.swiper, {
        modules: [Navigation, A11y, Keyboard, Pagination],
        a11y: true,
        keyboard: true,
        loop: true,
        navigation: {
          enabled: this.$refs.next !== undefined,
          nextEl: this.$refs.next,
          prevEl: this.$refs.prev,
        },
        pagination: {
          el: this.$refs.pagination,
          clickable: true,
          renderBullet: function (index, className) {
            const currentindex = index + 1;
            return `<button class="${className}"><span class="sr-only">Slide ${currentindex}"</span></button>`;
          },
        },
      });
    });
  },
});
