@foreach ($comments as $comment)
    @if ($comment->parent_id != $parent)
        @continue
    @endif
    <article class="js-thread-item level-{{ $comment->level }}" id="item-{{ $comment->id }}" data-extra="{{ $comment->extra ? 'y' : 'n' }}">
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
            <div class="flex justify-between mt-4 space-x-4">
                @if ($comment->token ?? null)
                    <button type="button" class="js-edit-button flex items-center mb-4 text-sm text-gray-500 font-medium" data-id="{{ $comment->id }}" data-token="{{ $comment->token }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        Edit Comment
                    </button>
                @else
                    <button type="button" class="js-reply-button flex items-center mb-4 text-sm text-gray-500 font-medium" data-id="{{ $comment->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1 mt-1"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        Reply
                    </button>
                @endif
                @if ($comment->extra)
                    @php($extra = json_decode($comment->extra, true))
                    <div class="flex mb-4 text-xs text-gray-500 font-medium">
                        <span class="mr-2 py-0.5"><em>Attachments:</em></span>
                        @if ($image = ($extra['image']['file_name'] ?? null))
                            <div class="js-extra-image flex items-center cursor-pointer" data-url="{{ url('/storage/images/'. $image) }}">
                                <span class="bg-gray-100 text-gray-800 mr-2 pl-1.5 pr-2.5 py-0.5 rounded-full">&bull;&nbsp;Image</span>
                            </div>
                        @endif
                        @if ($file = ($extra['file']['file_name'] ?? null))
                            <div class="js-extra-file flex items-center cursor-pointer" data-url="{{ url('/storage/files/'. $file) }}">
                                <span class="bg-gray-100 text-gray-800 mr-2 pl-1.5 pr-2.5 py-0.5 rounded-full">&bull;&nbsp;Text file</span>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        @if ($comment->replies)
            @include('thread.items', ['comments' => $comment->replies, 'parent' => $comment->id])
        @endif
    </article>
@endforeach
