@extends('events::layouts.master')

@section('content')

    <h1 class="text-7xl mb-10">{{ $eventCategory->name }}</h1>

    <div class="grid grid-cols-12">
        <aside class="col-span-3">
            <h3 class="mb-6 text-xl font-bold">Categories</h3>
            <ul>
                @foreach($categories as $category)
                    <li class="mb-5">
                        <a class="font-bold" href="{{ route('events.category.show', $category) }}">{{ $category->name }}</a>

                        @if($category->sub_categories->count())
                            <ul>
                                @foreach($category->sub_categories as $sub_category)
                                    <li>
                                        <a href="{{ route('events.sub_category.show', [$category, $sub_category]) }}">{{ $sub_category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </aside>
        <section class="col-span-9">
            <p class="mb-5"><a href="{{ url()->current() }}/?events=past">Past Events</a> | <a href="{{ url()->current() }}/?events=upcoming">Upcoming</a></p>
            <div class="grid grid-cols-4 gap-5">
                @forelse($eventCategory->sub_categories as $sub_category)
                    @foreach($sub_category->events as $event)
                        <article class="bg-gray-100 p-6">
                            <h3 class="text-xl font-bold mb-4">{{ $event->title }}</h3>
                            <p class="font-bold @if(!$event->end_date) mb-4 @endif">{{ $event->start_date }}  @if($event->end_date) - {{ $event->end_date }}@endif</p>
                            <p class="font-bold mt-4">{{ $event->venue }}</p>
                            <p>@markdown($event->address)</p>
                            <button class="inline bg-gray-400 mt-4 py-2 px-10" href="{{ $event->cta_link }}">Register</button>
                        </article>

                    @endforeach
                @empty
                    <p>Sorry, no events.</p>
                @endforelse
            </div>
        </section>
    </div>

@endsection
