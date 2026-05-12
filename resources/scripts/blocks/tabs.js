import { ScrollTrigger } from 'gsap/ScrollTrigger';

export default (tabCount) => {
  return {
    currentTab: 1,

    selectTab(tab) {
      this.currentTab = tab;
      setTimeout(()=>{
        ScrollTrigger.refresh(true);
      }, 300)
    },

    isSelected(tab) {
      return tab == this.currentTab;
    },

    tabIndex(tab) {
      return this.isSelected(tab) ? 0 : -1;
    },

    moveRight() {
      if (this.currentTab == tabCount) {
        this.currentTab = 1;
      } else {
        this.currentTab++;
      }

      this.$focus.within(this.$refs.tablist).wrap().next();
    },

    moveLeft() {
      if (this.currentTab == 1) {
        this.currentTab = tabCount;
      } else {
        this.currentTab--;
      }

      this.$focus.within(this.$refs.tablist).wrap().previous();
    },
  };
};
