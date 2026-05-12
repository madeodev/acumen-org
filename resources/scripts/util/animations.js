import SplitType from 'split-type';
import { gsap } from 'gsap';
import debounce from 'lodash/debounce';

import { ScrollTrigger } from 'gsap/ScrollTrigger';

export default () => {
  gsap.registerPlugin(ScrollTrigger);

  animateParallaxImages();

  splitTextAndTriggerLineAnimation();

  genericAnimateIn();

  animateFeaturedImage();

  function settings(trigger, isTextAnimation = false) {
    const settings = {
      y: '100%',
      opacity: 0,
      duration: 1.1,
      ease: 'power1.out',
      stagger: 0.15,
      scrollTrigger: {
        trigger: trigger,
      },
    };

    if (!isTextAnimation) return settings;

    settings.onComplete = function () {
      SplitType.revert(this.scrollTrigger.trigger);
    };
    return settings;
  }

  function genericAnimateIn() {
    const animate = gsap.utils.toArray('[animate]');

    if (!animate) return;

    animate.forEach((item) => {
      gsap.from(item, settings(item));
    });
  }

  function animateParallaxImages() {
    const parallaxImages = gsap.utils.toArray('[parallax] img');

    if (!parallaxImages) return;

    parallaxImages.forEach((image) => {
      gsap.fromTo(
        image,
        {
          yPercent: 0,
        },
        {
          yPercent: 25,
          ease: 'none',
          scrollTrigger: {
            trigger: image.parentElement,
            start: () => 'top bottom',
            end: 'bottom top',
            scrub: 1,
            invalidateOnRefresh: true, // to make it responsive
          },
        },
      );
    });
  }

  function splitTextAndTriggerLineAnimation() {
    if (!document.querySelector('[animate-text]')) return;

    let splitType = new SplitType('[animate-text]', {
      types: 'lines',
      tagName: 'span',
    });

    resetSplitTextOnWindowResize(splitType);

    animateLines();
  }

  /**
   * triggers gsap animation for text lines
   * called by splitTextAndTriggerLineAnimation
   */
  function animateLines() {
    const textBlock = gsap.utils.toArray('[animate-text]');

    if (!textBlock) return;

    textBlock.forEach((block) => {
      gsap.from(block.getElementsByClassName('line'), settings(block, true));
    });
  }

  /**
   * create a resize observer to re-split text on resize
   */
  function resetSplitTextOnWindowResize(splitType) {
    if (window.ResizeObserver !== undefined) return;

    let resizeObserver = { observe: () => {}, disconnect: () => {} };
    let previousContainerWidth = null;

    resizeObserver = new ResizeObserver(
      debounce((entry) => {
        const [{ contentRect }] = entry;
        let width = Math.floor(contentRect.width);
        if (previousContainerWidth && previousContainerWidth !== width) {
          splitType.split();
        }
        previousContainerWidth = width;
      }, 100),
    );

    resizeObserver.observe(document.body);
  }

  function animateFeaturedImage() {
    const featuredImage = gsap.utils.toArray('[animate-image="reveal"]');

    if (!featuredImage) {
      return;
    }

    featuredImage.forEach((image) => {
      gsap
        .timeline({
          marker: true,
          scrollTrigger: {
            trigger: image,
            start: 'top 70%',
            end: 'bottom 70%',
            scrub: true,
          },
        })
        .from(image, {
          clipPath: 'inset(15% 20% 15% 20%)',
        })
        .to(image, {
          clipPath: 'inset(0% 0% 0% 0%)',
        });

      gsap
        .timeline({
          scrollTrigger: {
            trigger: image.querySelector('img'),
            start: 'top 70%',
            end: 'bottom 70%',
            scrub: true,
          },
        })
        .from(image, {
          transform: 'scale(1.1)',
        })
        .to(image, {
          transform: 'scale(1)',
        });
    });
  }
};
