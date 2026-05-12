export default (preload) => {
  return {
    isPlaying: false,
    videoLoaded: false,

    init(){
      this.isPlaying = !!preload;
      this.videoLoaded = !!preload;
    },

    load(){
      if(preload) return;
      this.videoLoaded = true;
      this.$refs.video.load();
      this.isPlaying = true;
    },

    src(url){
      return this.videoLoaded ? url : '';
    },

    videoIsVisible(){
      if(!this.videoLoaded) return;
      this.$refs.video.play();
    },

    videoIsNotVisible(){
      this.$refs.video.pause();
    },

    playPause(){
      if(this.$refs.video.paused){
        this.$refs.video.play();
        this.isPlaying = true;
      }
      else{
        this.$refs.video.pause();
        this.isPlaying = false;
      }
    },

  };
};