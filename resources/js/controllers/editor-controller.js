import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['textarea'];

    initialize() {
        this.actions = {
            bold:   '<strong>content</strong>',
            italic: '<i>content</i>',
            code:   '<code>content</code>',
            link:   '<a href="">content</a>'
        };
    }

    formatContent(event) {
        const textarea = this.textareaTarget;

        const selectionStart = textarea.selectionStart;
        const selectionEnd = textarea.selectionEnd;
        const selectionContent = textarea.value.slice(selectionStart, selectionEnd);

        let content = this.actions[event.params['action']];
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
    }
}
