import Swiper from 'swiper';
import { Navigation, A11y, Keyboard, Parallax } from 'swiper/modules';
import 'swiper/css';

export default () => ({
  activeSlide: 0,

  init() {
    this.$nextTick(() => {
      new Swiper(this.$refs.swiper, {
        modules: [Navigation, A11y, Keyboard, Parallax],
        a11y: true,
        keyboard: true,
        slidesPerView: 'auto',
        parallax: true,
        speed: 1000,
        grabCursor: true,
        slideToClickedSlide: true,
        navigation: {
          nextEl: this.$refs.next,
          prevEl: this.$refs.prev,
        },
        on: {
          activeIndexChange: (swiper) => {
            this.activeSlide = swiper.realIndex;
          },
        },
      });
    });
  },
});
