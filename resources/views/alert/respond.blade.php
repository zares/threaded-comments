<div class="js-alert p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50" role="alert">
    <div class="flex items-center">
        <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <h3 class="text-lg font-medium">Responding to message</h3>
    </div>
    <div class="mt-2 text-sm">
        Right now you can reply to the message:
        <em class="text-blue-600">"{{ Str::words(strip_tags($_comment['text']), 12) }}"</em>
        by {{ $_comment['user_name'] }}.
        To reply to another message сlick the "Reply" button on him.
    </div>
</div>