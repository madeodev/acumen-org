import Swiper from 'swiper';
import {
  Navigation,
  A11y,
  Keyboard,
  EffectFade,
  Pagination,
} from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-fade';

function focusElem(swiper, thisDirElms, otherDirElms) {
  if (window.outerWidth > 768) return;
  setTimeout(() => {
    if (thisDirElms[swiper.activeIndex].disabled) {
      otherDirElms[swiper.activeIndex].focus();
    } else {
      thisDirElms[swiper.activeIndex].focus();
    }
  }, 750);
}

export default (colors) => {
  return {
    activeSlide: colors[0],

    init() {
      this.$nextTick(() => {
        const swiperConfig = {
          modules: [Navigation, A11y, Keyboard, EffectFade],
          a11y: true,
          keyboard: true,
          speed: 1000,
          effect: 'fade',
          fadeEffect: {
            crossFade: true,
          },

          navigation: {
            nextEl: this.$refs.next,
            prevEl: this.$refs.prev,
          },

          on: {
            navigationNext: (swiper) => {
              focusElem(swiper, this.$refs.next, this.$refs.prev);
            },
            navigationPrev: (swiper) => {
              focusElem(swiper, this.$refs.prev, this.$refs.next);
            },
            activeIndexChange: (swiper) => {
              this.activeSlide = colors[swiper.activeIndex];
            },
          },
        };

        if (this.$id.pagination) {
          swiperConfig.pagination = {
            el: this.$id.pagination,
            clickable: true,
          };

          swiperConfig.modules = [...swiperConfig.modules, Pagination];
        }

        new Swiper(this.$refs.swiper, swiperConfig);
      });
    },
  };
};
