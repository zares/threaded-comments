<div class="js-form-section" data-src="{{ route('comment.form') }}"></div>
<div class="js-thread-list mt-5 md:mt-10">
    @include('thread.items', ['comments' => $comments, 'parent' => null])
</div>