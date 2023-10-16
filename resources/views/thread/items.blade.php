@foreach ($comments as $comment)
    @if ($comment->parent_id != $parent)
        @continue
    @endif
    <article class="js-thread-item level-{{ $comment->level }}" id="item-{{ $comment->id }}">
        <div class="js-wrapper pt-4 pl-0 md:pl-3 pr-1 rounded-lg">
            <footer class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold">
                        <img class="mr-2 w-10 h-10 rounded-full" src="{{ Avatar::make($comment->email) }}">
                        <span class="js-author">{{ $comment->user_name }}</span>
                    </p>
                    <p class="pt-1 text-xs text-gray-900">
                        <time>{!! str_replace(' ', '&nbsp;at&nbsp;', $comment->created_at->format("d.m.Y H:i")) !!}</time>
                    </p>
                </div>
            </footer>
            @if ($comment->parent_id)
                <p class="js-quote flex ml-4 text-sm text-gray-400 cursor-pointer" data-ref="{{ $comment->parent_id }}">
                    <span class="text-gray-400 text-2xl mr-2">&#11177;</span>
                    <span class="pt-1">
                        {{ $comment->parent->user_name }}: <em>{{ Str::words(strip_tags($comment->parent->text), 7) }}</em>
                    </span>
                </p>
            @endif
            <p class="mt-1 text-gray-500">{!! nl2br($comment->text) !!}</p>
            <div class="flex items-center mt-3 space-x-4">
                @if ($comment->token ?? null)
                    <button type="button" class="js-edit-button flex items-center mb-4 text-sm text-gray-500 font-medium" data-id="{{ $comment->id }}" data-token="{{ $comment->token }}">
                        <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 14 3-3m-3 3 3 3m-3-3h16v-3m2-7-3 3m3-3-3-3m3 3H3v3"></path>
                        </svg>
                        Edit Comment
                    </button>
                @else
                    <button type="button" class="js-reply-button flex items-center mb-4 text-sm text-gray-500 font-medium" data-id="{{ $comment->id }}">
                        <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                        </svg>
                        Reply
                    </button>
                @endif
            </div>
        </div>
        @if ($comment->replies)
            @include('thread.items', ['comments' => $comment->replies, 'parent' => $comment->id])
        @endif
    </article>
@endforeach
