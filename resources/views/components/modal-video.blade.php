<div
  {{ $attributes }}
  class="fixed top-0 left-0 w-full h-full bg-black/80 z-50"
  role="dialog"
  x-show="isModalOpen"
  x-trap="isModalOpen"
  x-transition
  x-cloak
  aria-modal="true"
  aria-labelledby="{{ $id }}_label"
  aria-describedby="{{ $id }}_desc"
  @keyup.escape="triggerCloseModal"
>
  <button
    @click="triggerCloseModal"
    class="{{ $button_class }} border rounded-full w-12.5 h-12.5 flex items-center justify-center absolute right-5 top-5"
  >
    @svg('images.close')
    <span class="sr-only">{!! __('Close modal', 'modal-video') !!}</span>
  </button>

  <div class="lg:container-fluid w-screen lg:w-auto h-screen flex items-center justify-center">
    <iframe
      data-src="{{ $src }}"
      class="object-cover mx-auto w-full lg:h-full aspect-video lg:px-0"
      frameborder="0"
      allow="autoplay"
      x-ref="video"
      @click.outside="triggerCloseModal"
    ></iframe>
  </div>
</div>
