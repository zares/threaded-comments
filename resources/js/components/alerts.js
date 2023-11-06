const errorMessage = (messages) => {
    let list = '';

    if (messages === undefined) {
        return list;
    }

    if (Array.isArray(messages)) {
        for (const msg of messages) {
            list += '<li>' + msg + '</li>';
        }
    } else {
        list = '<li>Unknown error...</li>';
    }

    const alert =
        '<div class="js-alert p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">' +
            '<div class="flex items-center">' +
                '<svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">' +
                    '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>' +
                '</svg>' +
                '<h3 class="text-lg font-medium">Failed attempt to submit</h3>' +
            '</div>' +
            '<div class="pl-7">' +
                '<ul class="mt-1.5 ml-1 list-disc list-inside">' +
                    list +
                '</ul>' +
            '</div>' +
        '</div>';
    return alert;
};

const infoMessage = (message) => {
    const alert =
        '<div class="js-alert p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50" role="alert">' +
            '<div class="flex items-center">' +
                '<svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">' +
                    '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>' +
                '</svg>' +
                '<h3 class="text-lg font-medium">Important notes</h3>' +
            '</div>' +
            '<div class="mt-2 mb-4 text-sm">' +
                'Right now you can only respond to comments of any level. To do this, click on the "Reply" button at the bottom of the comment block. To add a top-level comment, click the "Add Comment" button in this block.' +
            '</div>' +
            '<div class="flex">' +
                '<button type="button" class="js-add-comment text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">' +
                    'Add Comment' +
                '</button>' +
            '</div>' +
        '</div>';
    return alert;
};

const alerts = {
    errorMessage,
    infoMessage
}

export default alerts;
