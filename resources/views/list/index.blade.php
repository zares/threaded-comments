<div class="relative overflow-x-auto shadow-md md:rounded-lg mb-4"
    data-controller="list"
    data-list-src-content-value="{{ route('comment.list') }}"
    data-list-passive-order-class="text-gray-400"
    data-list-active-order-class="text-gray-700">
    <table class="w-full text-left text-sm font-medium text-gray-900">
        <thead class="text-gray-700 capitalize md:uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-3 md:px-6 py-3">
                    <div class="flex items-center cursor-pointer"
                        data-action="click->list#orderBy"
                        data-list-order-param="user_name">
                        User&nbsp;Name
                        <span data-sort>
                            <svg class="w-3 h-3 ml-1.5 cursor-pointer text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 22" data-sort-icon>
                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                            </svg>
                        </span>
                    </div>
                </th>
                <th scope="col" class="px-3 md:px-6 py-3">
                    <div class="flex items-center cursor-pointer"
                        data-action="click->list#orderBy"
                        data-list-order-param="email">
                        Email&nbsp;Address
                        <span data-sort>
                            <svg class="w-3 h-3 ml-1.5 cursor-pointer text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 22" data-sort-icon>
                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                            </svg>
                        <span>
                    </div>
                </th>
                <th scope="col" class="px-3 md:px-6 py-3">
                    <div class="flex items-center cursor-pointer"
                        data-action="click->list#orderBy"
                        data-list-order-param="created_at">
                        Post&nbsp;Date
                        <span data-sort>
                            <svg class="w-3 h-3 ml-1.5 cursor-pointer text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 22" data-sort-icon>
                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                            </svg>
                        </span>
                    </div>
                </th>
                <th scope="col" class="px-3 md:px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody data-list-target="content">
            @include('list.items', ['comments' => $comments])
        </tbody>
    </table>
</div>


