import sectionManager from './section-manager';

/* List items init */
const listItemsInit = (element) => {
    // "view" button
    const viewButtons = document.querySelectorAll('.js-view-button');
    if (viewButtons) {
        viewButtons.forEach((item) => {
            item.addEventListener('click', () => {
                sectionManager('thread', item.dataset.id);
            });
        });
    }
    // "Create First One" button
    const createButton = document.querySelector('.js-create-button');
    if (createButton) {
        createButton.addEventListener('click', () => {
            sectionManager('thread');
        });
    }
    // Pagination block
    const paginator = document.querySelector('.js-paginator');
    if (paginator) {
        const navLinks = paginator.querySelectorAll('a');
        navLinks.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                // Fetch the list
                axios.get(item.getAttribute('href'))
                    .then((response) => {
                        const bodyHtml = response.data.html;
                        if (bodyHtml.length) {
                            element.innerHTML = bodyHtml;
                            listItemsInit(element);
                        } else {
                            element.innerHTML = '';
                        }
                    })
                    .catch((failure) => {
                        console.log(failure);
                    });
            });
        });
    }
};

export default listItemsInit;
