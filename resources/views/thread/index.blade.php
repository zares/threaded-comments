<div data-controller="thread" data-thread-src-form-value="{{ route('comment.form', $form_id) }}">
    <div data-thread-target="form"
        data-controller="form"
        data-action="form:updateThread->thread#updateThread">
        Loading...
    </div>
    <div class="mt-5 md:mt-10" data-thread-target="items">
        @include('thread.items', ['comments' => $comments, 'parent' => null])
    </div>
</div>