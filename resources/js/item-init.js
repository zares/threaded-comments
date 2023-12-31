import defaultModal from './default-modal'
import popupModal from './popup-modal'
import formLoader from './form-loader';

/* Thread item init */
const itemInit = (element) => {
    if (element !== undefined) {
        let replyBtn, editBtn, removeBtn;

        // Reply button initialization
        if (replyBtn = element.querySelector('.js-reply-button')) {
            replyBtn.addEventListener('click', () => {
                // We pass the item id to the form as parent_id
                formLoader(replyBtn.dataset.id);
            });
        }

        // Edit button initialization
        if (editBtn = element.querySelector('.js-edit-button')) {
            editBtn.addEventListener('click', () => {
                // We also pass the token for access to edit
                formLoader(editBtn.dataset.id, editBtn.dataset.token);
                // Remove the element for prevend dublication
                element.remove();
            });
        }

        // Remove button initialization
        if (removeBtn = element.querySelector('.js-remove-button')) {
            removeBtn.addEventListener('click', () => {
                const modal = popupModal(
                    removeBtn.dataset.id,
                    removeBtn.dataset.token,
                    removeBtn.dataset.url
                );
                modal.show();
            });
        }

        // Nav to parent message by click on quote
        const quote = element.querySelector('.js-quote');
        if (quote && ! element.classList.contains('level-1')) {
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

        // Attachments initialization
        const hasExtra = element.dataset.extra;
        if (hasExtra == 'y') {
            // Image file
            const extraImage = element.querySelector('.js-extra-image');
            if (extraImage) {
                const url = extraImage.dataset.url;
                const title = 'Attached image';
                const content = '<img src="' + url + '">';
                extraImage.addEventListener('click', () => {
                    const modal = defaultModal(title, content);
                    modal.show();
                });
            }
            // Text file
            const extraFile = element.querySelector('.js-extra-file');
            if (extraFile) {
                extraFile.addEventListener('click', () => {
                    // Fetch the attached file
                    axios.get(extraFile.dataset.url)
                        .then((response) => {
                            let data = response.data;
                            data = data.replace(/(?:\r\n|\r|\n)/g, "<br>");
                            const title = 'Attached text file';
                            const modal = defaultModal(title, data);
                            modal.show();
                        })
                        .catch((failure) => {
                            console.log(failure);
                        });
                });
            }
        }
    }
};

export default itemInit;
