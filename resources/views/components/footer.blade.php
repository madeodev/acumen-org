<footer class="bg-amethyst py-8 lg:py-25 text-white">
  <div class="container-fluid">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-7.5">
      <div class="lg:max-w-[654px]">
        @if (!empty($newsletter['form']))
          @if (!empty($newsletter['heading']))
            <p class="text-lg md:text-xl h4">{!! $newsletter['heading'] !!}</p>
          @endif
          {!! $newsletter['form'] !!}
        @endif
      </div>

      @if (!empty($nav))
        <nav>
          <ul class="list-none flex flex-col md:flex-row gap-7.5 justify-end">
            @foreach ($nav as $item)
              <li class="md:w-1/3 lg:max-w-[160px]">
                @if (empty($item['url']) || $item['url'] === '#')
                  <span class="font-bold">{!! $item['title'] !!}</span>
                @else
                  <a
                    href="{{ $item['url'] }}"
                    target="{{ $item['target'] }}"
                  >
                    {!! $item['title'] !!}
                  </a>
                @endif

                @if (!empty($item['children']))
                  <ul class="list-none">
                    @foreach ($item['children'] as $child)
                      <li class="my-3 text-md">
                        <a
                          href="{{ $child['url'] }}"
                          target="{{ $child['target'] }}"
                        >
                          {!! $child['title'] !!}
                        </a>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </li>
            @endforeach
          </ul>
        </nav>
      @endif
    </div>

    <div
      class="mt-8 lg:mt-16.75 flex flex-col lg:flex-row lg:grid lg:grid-cols-3 justify-between items-center lg:items-end gap-8"
    >
      <a
        href="{{ home_url() }}"
        class="max-w-[176px] link-no-underline"
      >
        @svg('images.logo-white')
        <span class="sr-only">{!! $siteName !!}</span>
      </a>

      <x-social-media class="lg:flex lg:justify-center" />

      <div class="lg:flex lg:justify-end">
        @if (!empty($utility))
          <nav>
            <ul class="list-none flex gap-4 lg:gap-6 xl:gap-8 text-base">
              @foreach ($utility as $item)
                <li>
                  <a
                    href="{{ $item['url'] }}"
                    target="{{ $item['target'] }}"
                    class="lg:whitespace-nowrap"
                  >
                    {!! $item['title'] !!}
                  </a>
                </li>
              @endforeach

              <li>
                <a
                  href="https://briteweb.com"
                  target="_blank"
                  class="lg:whitespace-nowrap"
                >
                  {!! __('Site by Briteweb', 'footer') !!}
                </a>
              </li>
            </ul>
          </nav>
        @endif
      </div>
    </div>
  </div>
</footer>
