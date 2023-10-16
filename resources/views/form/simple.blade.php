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
    <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
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
    <div class="flex justify-between">
        <button type="submit" class="js-submit-btn inline-flex items-center py-2.5 px-4 text-sm font-semibold text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200">
            @if ($action == 'create' && $_comment)
                Reply to Comment
            @elseif ($action == 'create')
                Post Comment
            @elseif ($action == 'update')
                Update Comment
            @endif
        </button>
        <button type="button" class="js-back-button text-sm text-blue-700 underline">Back to list</button>
    </div>
</form>
