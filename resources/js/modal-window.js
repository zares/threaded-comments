/* Modal window initialization */
const modalWindow = (title, body) => {
    const element = document.getElementById('modal-window');
    const modalTitle = element.querySelector('.js-modal-title');
    const modalBody = element.querySelector('.js-modal-body');

    const modal = new Modal(element, {
        onShow: () => {
            modalTitle.innerHTML = title;
            modalBody.innerHTML = body;
        },
        onHide: () => {
            modalTitle.innerHTML = '';
            modalBody.innerHTML = '';
        }
    });

    const closeButton = element.querySelector('.js-close-button');
    if (closeButton) {
        closeButton.addEventListener('click', () => {
            modal.hide();
        })
    }

    return modal;
};

export default modalWindow;
