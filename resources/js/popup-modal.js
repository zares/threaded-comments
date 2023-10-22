import { Modal } from 'flowbite';

/* Popup modal initialization */
const popupModal = (id, token, url) => {
    const element = document.getElementById('popup-modal');
    const modalTitle = element.querySelector('.js-title');
    const modalButtons = element.querySelector('.js-btn-group');
    const submitButton = element.querySelector('.js-submit-button');
    const closeButtons = element.querySelectorAll('.js-close-button');
    const defaultTitle = modalTitle.innerHTML;

    // Make request to endpoint
    const createRequest = () => {
        axios.post(url, {id: id, token: token})
            .then((response) => {
                document.getElementById('item-' + id).remove();
                modal.hide();
            })
            .catch((failure) => {
                const status = failure.response.status;
                if (status == 409) {
                    modalTitle.innerHTML = failure.response.data;
                } else {
                    modalTitle.innerHTML = 'Failed to delete message!';
                }
                modalButtons.classList.add('hidden');
            });
    };

    // Hide moda
    const hideModal = () => {
        modal.hide();
    };

    // Create Modal instance
    const modal = new Modal(element, {
        onShow: () => {
            submitButton.addEventListener('click', createRequest);
            closeButtons.forEach((button) => {
                button.addEventListener('click', hideModal);
            });
        },
        onHide: () => {
            modalTitle.innerHTML = defaultTitle;
            modalButtons.classList.remove('hidden');
            submitButton.removeEventListener('click', createRequest);
            closeButtons.forEach((button) => {
                button.removeEventListener('click', hideModal);
            });
        }
    });

    return modal;
};

export default popupModal;
