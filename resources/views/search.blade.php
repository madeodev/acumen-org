@extends('layouts.app')

@section('content')

  <div class="bg-amethyst text-white py-7.5 sm:py-15 xl:py-30">
    <div class="container-fluid flex flex-col gap-7.5 w-full">
      
      <nav class="mx-auto max-w-full">
        <x-search-form />
      </nav>

      <div class="py-7.5 max-w-4xl mx-auto w-full">

        @if(!empty($title))
          <h1 class="h4 leading-tight">
            {!! $title !!}
          </h1>
        @endif

        @if(!empty($info))
          <p>
            {!! $info !!}
          </p>
        @endif

        @if(!empty($results))
          <ul class="flex flex-col gap-5">
            @foreach ($results as $result)
              <li role="article">
                <a href="{{$result['link']}}" class="border-b py-7.5 group flex justify-between">
                  <div>
                    
                    <header>

                      @if(!empty($result['title']))
                        <h2 class="h3 mb-2.5">
                          {!! $result['title'] !!}
                        </h2>
                      @endif

                    </header>

                    @if(!empty($result['excerpt']))
                      <p class="mb-2.5">
                        {!! $result['excerpt'] !!}
                      </p>
                    @endif
                    

                    @if(!empty($result['post_type_pretty']))
                      <p class="h5">
                        {!! $result['post_type_pretty'] !!}
                      </p>
                    @endif

                  </div>
                  <x-button element="span" type="icon" icon="arrow-right" color="icon-white"/>
                </a>
              </li>
            @endforeach
          </ul>
        @endif

        <x-pagination :query-model="$query" />
      </div>


    </div>
  </div>
  
@endsection
