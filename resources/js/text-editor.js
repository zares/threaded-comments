/* Text editor initialization */
const texteditorInit = (form) => {
    // Action buttons
    const actions = {
        bold:   '<strong>content</strong>',
        italic: '<i>content</i>',
        code:   '<code>content</code>',
        link:   '<a href="">content</a>'
    };

    const textarea = form.querySelector('.js-textarea');
    const buttons = form.querySelectorAll('.js-action-button');

    if (buttons.length) {
        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                const selectionStart = textarea.selectionStart;
                const selectionEnd = textarea.selectionEnd;
                const selectionContent = textarea.value.slice(selectionStart, selectionEnd);

                let content = actions[button.dataset.action];
                let actionEndLength = 0;

                const contentArr = content.split('content');
                if (contentArr.length == 2) {
                    actionEndLength = contentArr[1].length;
                }

                if (selectionContent.length) {
                    content = content.replace('content', selectionContent);
                }

                const value = textarea.value;

                textarea.value = value.slice(0, selectionStart) + content + value.slice(selectionEnd);
                textarea.focus();
                textarea.selectionEnd = selectionEnd - selectionContent.length + content.length - actionEndLength;

                if (selectionStart != selectionEnd) {
                    textarea.selectionStart = textarea.selectionEnd - selectionContent.length;
                } else {
                    textarea.selectionStart = textarea.selectionEnd;
                }
            });
        });
    }
};

export default texteditorInit;
