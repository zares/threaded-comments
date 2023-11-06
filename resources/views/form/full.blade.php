<div data-form-target="alert">
    @if ($_comment)
        @include('alert.respond')
    @endif
</div>
<form class="mb-6" id="comment-form" data-action="form#submit" data-form-action-param="{{ route('comment.'. $action) }}">
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
    <div class="w-full mb-4" data-controller="editor">
        <label for="messageText" class="block mb-2 text-sm font-semibold text-gray-900">Your message</label>
        <div class="flex justify-between px-3 py-2 border border-b-0 border-gray-300 rounded-tl-lg rounded-tr-lg bg-gray-50">
            <div class="flex items-center space-x-1 sm:pr-4">
                <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100" data-action="editor#formatContent" data-editor-action-param="bold">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M4 2h4.5a3.501 3.501 0 0 1 2.852 5.53A3.499 3.499 0 0 1 9.5 14H4a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1Zm1 7v3h4.5a1.5 1.5 0 0 0 0-3Zm3.5-2a1.5 1.5 0 0 0 0-3H5v3Z"></path>
                    </svg>
                </button>
                <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100" data-action="editor#formatContent" data-editor-action-param="italic">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M6 2.75A.75.75 0 0 1 6.75 2h6.5a.75.75 0 0 1 0 1.5h-2.505l-3.858 9H9.25a.75.75 0 0 1 0 1.5h-6.5a.75.75 0 0 1 0-1.5h2.505l3.858-9H6.75A.75.75 0 0 1 6 2.75Z"></path>
                    </svg>
                </button>
                <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100" data-action="editor#formatContent" data-editor-action-param="code">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="m11.28 3.22 4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.749.749 0 0 1-1.275-.326.749.749 0 0 1 .215-.734L13.94 8l-3.72-3.72a.749.749 0 0 1 .326-1.275.749.749 0 0 1 .734.215Zm-6.56 0a.751.751 0 0 1 1.042.018.751.751 0 0 1 .018 1.042L2.06 8l3.72 3.72a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215L.47 8.53a.75.75 0 0 1 0-1.06Z"></path>
                    </svg>
                </button>
                <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100" data-action="editor#formatContent" data-editor-action-param="link">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="m7.775 3.275 1.25-1.25a3.5 3.5 0 1 1 4.95 4.95l-2.5 2.5a3.5 3.5 0 0 1-4.95 0 .751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018 1.998 1.998 0 0 0 2.83 0l2.5-2.5a2.002 2.002 0 0 0-2.83-2.83l-1.25 1.25a.751.751 0 0 1-1.042-.018.751.751 0 0 1-.018-1.042Zm-4.69 9.64a1.998 1.998 0 0 0 2.83 0l1.25-1.25a.751.751 0 0 1 1.042.018.751.751 0 0 1 .018 1.042l-1.25 1.25a3.5 3.5 0 1 1-4.95-4.95l2.5-2.5a3.5 3.5 0 0 1 4.95 0 .751.751 0 0 1-.018 1.042.751.751 0 0 1-1.042.018 1.998 1.998 0 0 0-2.83 0l-2.5 2.5a1.998 1.998 0 0 0 0 2.83Z"></path>
                    </svg>
                </button>
            </div>
        </div>
        <textarea data-editor-target="textarea" name="text" rows="6" id="messageText" class="py-2 px-4 w-full bg-gray-50 border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 rounded-bl-lg rounded-br-lg" placeholder="Message text..." required>{!! $comment->text ?? '' !!}</textarea>
    </div>
    <div class="flex text-left">
        <button type="submit" class="js-submit-btn inline-flex items-center py-2.5 px-4 text-sm font-semibold text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200" data-form-target="submit">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20" class="w-5 h-5 mr-1 text-gray-600"><path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z"></path><path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"></path>
                </svg>
                <span>{{ ($comment->extra['old_image'] ?? null) ?: 'Upload Image' }}</span>
                <input type="file" name="image" accept="image/jpeg, image/jpg, image/gif, image/png" class="hidden">
            </button>
        </div>
        <div class="js-attach-file">
            <button type="button" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm pr-4 pl-3 py-2.5 text-center inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 20" class="w-5 h-5 mr-1 text-gray-600"><path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6"></path>
                </svg>
                <span>{{ ($comment->extra['old_file'] ?? null) ?: 'Attach File' }}</span>
            </button>
            <input type="file" name="file" accept="text/plain" class="hidden">
        </div>
    </div>
    <div class="text-right">
        <button class="js-back-button text-sm text-blue-700 underline mr-1" type="button" data-action="index#toList">
            Back to list
        </button>
    </div>
</form>
