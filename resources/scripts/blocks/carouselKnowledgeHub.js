import Swiper from 'swiper';
import { Navigation, A11y, Keyboard, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/autoplay';

export default () => ({
  activeSlide: 0,

  init() {
    this.$nextTick(() => {

      // Calculate left offset to match container-fluid padding
      const getLeftOffset = () => {
        const viewportWidth = window.innerWidth;
        const maxWidth = 1536; // max-w-screen-2xl = 1536px
        
        // Calculate the container's left margin when centered
        let containerMargin = 0;
        if (viewportWidth > maxWidth) {
          containerMargin = (viewportWidth - maxWidth) / 2;
        }
        
        // Add the padding based on breakpoint
        if (viewportWidth >= 1024) { // lg breakpoint
          return containerMargin + 80; // container margin + lg:px-20 (20 * 4 = 80px)
        } else {
          return containerMargin + 20; // container margin + px-5 (5 * 4 = 20px)
        }
      };

      new Swiper(this.$refs.swiper, {
        modules: [Navigation, A11y, Keyboard, Autoplay],
        a11y: true,
        keyboard: true,
        slidesPerView: 'auto',
        spaceBetween: 20,
        slidesOffsetBefore: getLeftOffset(),
        slidesOffsetAfter: 200,
        watchSlidesProgress: true,
        autoplay: {
          delay: 4000,
          disableOnInteraction: true,
          pauseOnMouseEnter: true,
        },
        speed: 800,
        cssMode: false,
        easing: 'cubic-bezier(0.4, 0, 0, 1)',
        grabCursor: true,
        slideToClickedSlide: true,
        navigation: {
          nextEl: this.$refs.next,
          prevEl: this.$refs.prev,
          disabledClass: 'swiper-button-disabled',
        },
        on: {
          init: (swiper) => {
            this.updateNavigationState(swiper);
            
            // Dispatch initial event for Vue component
            this.$el.dispatchEvent(new CustomEvent('carousel-slide-change', {
              detail: { activeSlide: this.activeSlide },
            }));
          },
          slideChange: (swiper) => {
            this.activeSlide = swiper.realIndex;
            this.updateNavigationState(swiper);
            
            // Dispatch custom event for Vue component
            this.$el.dispatchEvent(new CustomEvent('carousel-slide-change', {
              detail: { activeSlide: this.activeSlide },
            }));
          },
          resize: (swiper) => {
            this.updateNavigationState(swiper);
          },
        },
      });
    });
  },

  updateNavigationState(swiper) {
    const isAtBeginning = swiper.isBeginning;
    const isAtEnd = swiper.isEnd;
    
    // Handle previous button
    if (isAtBeginning) {
      this.$refs.prev.classList.add('swiper-button-disabled');
      this.$refs.prev.setAttribute('disabled', 'true');
    } else {
      this.$refs.prev.classList.remove('swiper-button-disabled');
      this.$refs.prev.removeAttribute('disabled');
    }
    
    // Handle next button - check if we're at the last slide or if last slide is fully visible
    const lastSlideIndex = swiper.slides.length - 1;
    const currentIndex = swiper.activeIndex;
    
    if (isAtEnd || currentIndex >= lastSlideIndex) {
      this.$refs.next.classList.add('swiper-button-disabled');
      this.$refs.next.setAttribute('disabled', 'true');
    } else {
      this.$refs.next.classList.remove('swiper-button-disabled');
      this.$refs.next.removeAttribute('disabled');
    }
  },
});
