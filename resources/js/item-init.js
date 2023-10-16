import formLoader from './form-loader';

/* Thread item init */
const itemInit = (element) => {
    if (element !== undefined) {
        let replyBtn, editBtn;

        // Reply button initialization
        if (replyBtn = element.querySelector('.js-reply-button')) {
            replyBtn.addEventListener('click', () => {
                // We pass the item id to the form as parent_id
                formLoader(replyBtn.dataset.id);
            });
            // Edit button initialization
        } else if (editBtn = element.querySelector('.js-edit-button')) {
            editBtn.addEventListener('click', () => {
                // We also pass the token for access to edit
                formLoader(editBtn.dataset.id, editBtn.dataset.token);
                // Remove the element for prevend dublication
                element.remove();
            });
        }

        // Nav to parent message by click on quote
        const quote = element.querySelector('.js-quote');
        if (quote) {
            const selector = 'item-' + quote.dataset.ref;
            const target = document.getElementById(selector);
            quote.addEventListener('click', () => {
                const wrapper = target.querySelector('.js-wrapper');
                wrapper.classList.add('bg-gray-50');
                target.scrollIntoView({behavior:'smooth', block:'start'});
                setTimeout(() => {
                    wrapper.classList.remove('bg-gray-50');
                }, 3000);

            });

        }
    }
};

export default itemInit;
