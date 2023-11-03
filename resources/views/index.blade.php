@extends('base')

@section('page-title', 'Index Page')

@section('content')
    <section class="py-8 md:py-16 antialiased">
        <div class="max-w-3xl mx-auto px-4"
            data-controller="index"
            data-index-src-list-value="{{ route('comment.list', ['index' => true]) }}"
            data-index-src-thread-value="{{ route('comment.thread') }}">
            <div class="flex justify-between mb-2 md:mb-4">
                <h2 class="text-lg md:text-2xl font-bold text-gray-900">Threaded Comments</h2>
                <button class="mt-10 text-sm text-blue-700 underline mr-1" type="button" data-action="index#addNew">
                    Add new
                </button>
            </div>
            <div data-index-target="content">
                Loading...
            </div>
        </div>
    </section>
@stop