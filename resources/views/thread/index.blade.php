<div data-controller="thread" data-thread-src-form-value="{{ route('comment.form') }}">
    <div data-thread-target="form">
        Loading...
    </div>
    <div class="mt-5 md:mt-10">
        @include('thread.items', ['comments' => $comments, 'parent' => null])
    </div>
</div>