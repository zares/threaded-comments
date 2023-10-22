@extends('base')

@section('page-title', 'Index Page')

@section('content')
    <section class="py-8 md:py-16 antialiased">
        <div class="max-w-3xl mx-auto px-4">
            <div class="flex justify-between mb-2 md:mb-4">
                <h2 class="text-lg md:text-2xl font-bold text-gray-900">Threaded Comments</h2>
                <button type="button" class="js-add-button mt-10 text-sm text-blue-700 underline mr-1">Add new</button>
            </div>
            <div class="js-list-section hidden" data-src="{{ route('comment.list', ['index' => true]) }}">
                Loading...
            </div>
            <div class="js-thread-section hidden" data-src="{{ route('comment.thread') }}">
                Loading...
            </div>
        </div>
    </section>
    @include('modals.default')
    @include('modals.popup')
@stop