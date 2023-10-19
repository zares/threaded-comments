import formLoader from './form-loader';
import { Modal } from 'flowbite';

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

        // Modal initialization
        const getModal = (title, content) => {
            const modalElement = document.getElementById('modalElement');
            const modalTitle = modalElement.querySelector('.js-modal-title');
            const modalBody = modalElement.querySelector('.js-modal-body');

            const modal = new Modal(modalElement, {
                onHide: () => {
                    modalTitle.innerHTML = '';
                    modalBody.innerHTML = '';
                },
                onShow: () => {
                    if (title !== undefined && content !== undefined) {
                        modalTitle.innerHTML = title;
                        modalBody.innerHTML = content;
                    }
                }
            });

            const closeButton = modalElement.querySelector('.js-close-button');
            if (closeButton) {
                closeButton.addEventListener('click', () => {
                    modal.hide();
                })
            }

            return modal;
        };

        // Attachments initialization
        const hasExtra = element.dataset.hasextra;
        if (hasExtra == 'yes') {
            // Image file
            const extraImage = element.querySelector('.js-extra-image');
            if (extraImage) {
                const url = extraImage.dataset.url;
                const title = 'Attached file image';
                const content = '<img src="' + url + '">';
                extraImage.addEventListener('click', () => {
                    const modal = getModal(title, content);
                    modal.show();
                });
            }
            // Text file
            const extraFile = element.querySelector('.js-extra-file');
            if (extraFile) {
                extraFile.addEventListener('click', () => {
                    // Fetch attachment file
                    axios.get(extraFile.dataset.url)
                        .then((response) => {
                            let data = response.data;
                            data = data.replace(/(?:\r\n|\r|\n)/g, "<br>");
                            const title = 'Text of the attached file';
                            const modal = getModal(title, data);
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
