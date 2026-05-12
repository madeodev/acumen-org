@extends('layouts.app')

@section('content')
  <section class="bg-amethyst text-white py-30">
    <div class="container-fluid text-center max-w-[1040px] space-y-10 md:space-y-20">
      <h1 class="hero-headline">{!! $title !!}</h1>
      <p class="h3">{!! $content !!}</p>
      <x-button :link="$link" class="capitalize" color="fill" />
    </div>
  </section>
@endsection
