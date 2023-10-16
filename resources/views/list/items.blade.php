@forelse ($comments as $comment)
    <tr class="js-list-item font-semibold text-sm border-b bg-gray-50">
        <td class="px-3 md:px-6 py-3">
            {{ $comment->user_name }}
        </td>
        <td class="px-3 md:px-6 py-3">
            {{ $comment->email }}
        </td>
        <td class="px-3 md:px-6 py-3">
            {!! str_replace(' ', '&nbsp;', $comment->created_at->format("d.m.Y H:i")) !!}
        </td>
        <td class="px-3 md:px-6 py-3 text-right">
            <button type="button" class="js-view-button text-blue-700 underline" data-id="{{ $comment->id }}">view</button>
        </td>
    </tr>
    <tr class="border-b">
        <td colspan="4" class="px-3 md:px-6 py-2 text-clip text-gray-500 overflow-hidden ...">
            {!! nl2br($comment->text) !!}
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="p-3">
            <p class="text-center border-b pb-4">There are no comments...</p>
            <p class="text-center">
                <button type="button" class="js-create-button border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm py-2 px-4 mb-0 mt-7">
                    Create First One
                </button>
            </p>
        </td>
    </tr>
@endforelse

<tr>
    <td colspan="4" class="p-3 js-paginator">{{ $comments->links() }}</td>
</tr>
