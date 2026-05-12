
export default () => {

  return {
    videoSrc: '',
    isModalOpen: false,

    triggerOpenModal() {
      this.isModalOpen = true;

      this.$nextTick(() => {
        if (this.$refs.video?.getAttribute('data-src')) {
          this.videoSrc = this.$refs.video.getAttribute('data-src');
          this.$refs.video.setAttribute('src', this.videoSrc);
        }
      });
    },

    triggerCloseModal() {
      this.isModalOpen = false;
      this.$refs.video.removeAttribute('src');
    },
  };
};
