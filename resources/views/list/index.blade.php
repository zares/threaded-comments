<div class="js-table relative overflow-x-auto shadow-md md:rounded-lg mb-4">
    <table class="w-full text-left text-sm font-medium text-gray-900">
        <thead class="text-gray-700 capitalize md:uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-3 md:px-6 py-3">
                    <div class="js-col-title flex items-center cursor-pointer" data-order="user_name" data-sort="desc">
                        Use&nbsp;Name
                        <svg class="w-3 h-3 ml-1.5 cursor-pointer text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 22">
                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg>
                    </div>
                </th>
                <th scope="col" class="px-3 md:px-6 py-3">
                    <div class="js-col-title flex items-center cursor-pointer" data-order="email" data-sort="desc">
                        Email&nbsp;Address
                        <svg class="w-3 h-3 ml-1.5 cursor-pointer text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 22">
                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg>
                    </div>
                </th>
                <th scope="col" class="px-3 md:px-6 py-3">
                    <div class="js-col-title flex items-center cursor-pointer" data-order="created_at" data-sort="asc">
                        Post&nbsp;Date
                        <svg class="w-3 h-3 ml-1.5 cursor-pointer text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 22">
                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg>
                    </div>
                </th>
                <th scope="col" class="px-3 md:px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody class="js-table-body" data-src="{{ route('comment.list') }}">
            @include('list.items', ['comments' => $comments])
        </tbody>
    </table>
</div>


