import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

export default () => ({
  init() {
    gsap.registerPlugin(ScrollTrigger);

    const blockquote = this.$refs.blockquoteContent;

    if (!blockquote) return;

    gsap.fromTo(
      blockquote,
      {
        y: 100,
        opacity: 0,
      },
      {
        y: 0,
        opacity: 1,
        ease: 'power2.in',
        scrollTrigger: {
          trigger: blockquote,
          start: 'top bottom',
          end: 'top 40%',
          scrub: true,
          invalidateOnRefresh: true,
        },
      },
    );
  },
});
