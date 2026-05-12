import { ScrollTrigger } from 'gsap/ScrollTrigger';

export default () => {
  return {
    open: false,

    toggle() {
      this.open = !this.open;
      setTimeout(()=>{
        ScrollTrigger.refresh(true);
      }, 300)
    },
  };
};
