<div class="js-alert-place">
    @if ($_comment)
        @include('alert.respond')
    @endif
</div>
<form class="js-comment-form mb-6" id="comment-form" action="{{ route('comment.'. ($action)) }}">
    <input type="hidden" name="parent_id" value="{{ $comment->parent_id ?? '' }}">
    @if ($action == 'update')
        <input type="hidden" name="id" value="{{ $comment->id }}">
        <input type="hidden" name="token" value="{{ $token }}">
    @endif
    <div class="grid sm:grid-cols-2 gap-3 sm:gap-5 mb-2 sm:mb-4">
        <div class="w-full">
            <label for="userName" class="block mb-2 text-sm font-semibold text-gray-900">User name</label>
            <input type="text" name="user_name" value="{{ $comment->user_name ?? '' }}" id="userName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Bonnie_Green" required>
        </div>
        <div class="w-full">
            <label for="emailAddress" class="block mb-2 text-sm font-semibold text-gray-900">Email address</label>
            <input type="email" name="email" value="{{ $comment->email ?? '' }}" id="emailAddress" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="somename@mail.com" required>
        </div>
        <div class="w-full">
            <label for="homePage" class="block mb-2 text-sm font-semibold text-gray-900">Home page</label>
            <input type="text" name="home_page" value="{{ $comment->home_page ?? '' }}" id="homePage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="https://myhomepage.com">
        </div>
        <div class="w-full">
            <label for="captcha" class="block mb-2 text-sm font-semibold text-gray-900">Captcha</label>
            <div class="flex">
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">
                    {{ app('captcha')->label() }} =
                </span>
                <input type="text" name="captcha" id="captcha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-none rounded-r-lg focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full p-2.5" required>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <label for="yourComment" class="block mb-2 text-sm font-semibold text-gray-900">Your comment</label>
        <textarea name="text" id="yourComment" rows="6" class="py-2 px-4 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Message text..." required>{{ $comment->text ?? '' }}</textarea>
    </div>
    <div class="flex text-left">
        <button type="submit" class="js-submit-btn inline-flex items-center py-2.5 px-4 text-sm font-semibold text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200">
            @if ($action == 'create' && $_comment)
                Reply to Comment
            @elseif ($action == 'create')
                Post Comment
            @elseif ($action == 'update')
                Update Comment
            @endif
        </button>
        <div class="js-attach-image">
            <button type="button" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm pr-4 pl-3 py-2 text-center inline-flex items-center ml-2 mr-2">
                <svg class="w-5 h-5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20"><path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z"></path><path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"></path>
                </svg>
                <span>{{ ($comment->extra['old_image'] ?? null) ?: 'Upload Image' }}</span>
                <input type="file" name="image" accept="image/jpeg, image/jpg, image/gif, image/png" class="hidden">
            </button>
        </div>
        <div class="js-attach-file">
            <button type="button" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm pr-4 pl-3 py-2.5 text-center inline-flex items-center">
                <svg class="w-5 h-5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 20"><path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6"></path>
                </svg>
                <span>{{ ($comment->extra['old_file'] ?? null) ?: 'Attach File' }}</span>
            </button>
            <input type="file" name="file" accept="text/plain" class="hidden">
        </div>
    </div>
    <div class="text-right">
        <button type="button" class="js-back-button text-sm text-blue-700 underline mr-1">Back to list</button>
    </div>
</form>
