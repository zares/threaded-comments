import sectionManager from './section-manager';

/* Index init */
const indexInit = (activeSection) => {
    sectionManager(activeSection);
    const addButton = document.querySelector('.js-add-button');
    if (addButton) {
        addButton.addEventListener('click', () => {
            sectionManager('thread');
        });
    }
}

export default indexInit;
