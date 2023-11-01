import listIndexInit from './list-index';

/* Comment list loader */
const listLoader = (param) => {
    const listSection = document.querySelector('.js-list-section');
    if (listSection) {
        listSection.innerHTML = 'Loading...';

        axios.get(listSection.dataset.src)
            .then((response) => {
                const listHtml = response.data.html;
                if (listHtml.length) {
                    listSection.innerHTML = listHtml;
                    listIndexInit();
                } else {
                    listSection.innerHTML = '';
                }
            })
            .catch((failure) => {
                console.log(failure);
            });
    }
};

export default listLoader;
