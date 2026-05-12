import { ScrollTrigger } from 'gsap/ScrollTrigger';

export default () => {
  return {
    isAnimated: false,
    init() {
      this.$nextTick(() => {
        const links = this.$refs.nav.querySelectorAll('.menu-item-parent');

        links.forEach((el) => {
          el.addEventListener('mouseenter', () => {
            if (this.isAnimated) {
              return;
            }

            this.animate();
          });
        });
      });
    },

    animate() {
      if (this.isAnimated) {
        return;
      }

      const textRect = this.$refs.logoText.getBoundingClientRect();
      const logoRect = this.$refs.logomark.getBoundingClientRect();
      const logoDivRect = this.$refs.logoDiv.getBoundingClientRect();
      const wordmarkSpacerRect =
        this.$refs.wordmarkSpacer.getBoundingClientRect();

      const width = logoRect.width / textRect.width;
      const transX = -(textRect.left - logoRect.left);
      const transY = -(textRect.top - wordmarkSpacerRect.top);

      this.$refs.logoText.style.transform = `translate(${transX}px, ${transY}px) scale(${width})`;
      this.$refs.logoDiv.style.height = `${logoDivRect.height}px`;

      setTimeout(() => {
        this.$refs.logoDiv.style.transition = `height 1000ms`;
        this.$refs.logoDiv.style.height = `0px`;
        this.isAnimated = true;
      }, 1);

      setTimeout(() => {
        ScrollTrigger.refresh(true);
      }, 1000);
    },

    onResize() {
      if (this.$refs.logomark.classList.contains('hidden')) {
        return;
      }

      if (document.body.classList.contains('tve-version-browser')) {
        return;
      }

      this.$refs.wordmarkSpacer.classList.add('hidden');
      this.$refs.logomark.classList.add('hidden');
      this.$refs.logoText.classList.add('hidden');
      this.$refs.logo.classList.remove('hidden');
    },
  };
};
