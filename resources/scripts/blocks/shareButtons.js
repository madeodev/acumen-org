export default (copied, failed) => {
  return {
    tooltip: false,
    
    open(el) {
      window.open(el.href, 'newwindow', 'width=500,height=600');
    },

    async copyLink() {
      try {
        const link = window.location.href;
        await navigator.clipboard.writeText(link);
        this.tooltipMessage(copied);
      } catch (err) {
        this.tooltipMessage(failed);
      }
    },

    tooltipMessage(message) {
      this.tooltip = message;
      setTimeout(() => {
        this.tooltip = false;
      }, 1500);
    },

  };
};
