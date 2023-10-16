import listItemsInit from './list-items';

/* Comment list init */
const listIndexInit = () => {
    const table = document.querySelector('.js-table');
    if (table) {
        const listItems = table.querySelector('.js-table-body');
        const titles = table.querySelectorAll('.js-col-title');
        // Base url to data fetching
        const url = listItems.dataset.src;

        titles.forEach((item) => {
            item.addEventListener('click', () => {
                // Arrow color manipulation
                titles.forEach((i) => {
                    const arrow = i.querySelector('svg');
                    arrow.classList.remove('text-gray-700');
                    arrow.classList.add('text-gray-400');
                });
                const order = item.dataset.order;
                const sort = item.dataset.sort;
                const selfArrow = item.querySelector('svg');
                selfArrow.classList.remove('text-gray-400');
                selfArrow.classList.add('text-gray-700');
                // Dataset manipulation
                item.dataset.sort = (sort == 'desc') ? 'asc' : 'desc';

                // Fetch the ordering and sorted list
                axios.get(url + '?orderby=' + order + '&sort=' + sort)
                    .then((response) => {
                        const html = response.data.html;
                        if (html.length) {
                            listItems.innerHTML = html;
                            listItemsInit(listItems);
                        } else {
                            listItems.innerHTML = '';
                        }
                    })
                    .catch((failure) => {
                        console.log(failure);
                    });
            });
        });

        listItemsInit(listItems);
    }
};

export default listIndexInit;
