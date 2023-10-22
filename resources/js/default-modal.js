import { Modal } from 'flowbite';

/* Default modal initialization */
const defaultModal = (title, body) => {
    const element = document.getElementById('default-modal');
    const closeButton = element.querySelector('.js-close-button');
    const modalTitle = element.querySelector('.js-modal-title');
    const modalBody = element.querySelector('.js-modal-body');

    // Hide modal window
    const hideModal = () => {
        modal.hide();
    };

    // Create Modal instance
    const modal = new Modal(element, {
        onShow: () => {
            closeButton.addEventListener('click', hideModal);
            modalTitle.innerHTML = title;
            modalBody.innerHTML = body;
        },
        onHide: () => {
            closeButton.removeEventListener('click', hideModal);
            modalTitle.innerHTML = '';
            modalBody.innerHTML = '';
        }
    });

    return modal;
};

export default defaultModal;
