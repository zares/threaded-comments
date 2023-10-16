import formInit from './form-init';

/* Comment form loader */
const formLoader = (id, token, scroll) => {
    const formSection = document.querySelector('.js-form-section');
    if (formSection) {
        // Form source base url
        let url = formSection.dataset.src;
        // Url for reply mode
        if (id !== undefined) {
            url += '/' + id;
        }
        // Url for edit mode
        if (token !== undefined) {
            url += '/' + token;
        }

        // Fetch required form
        axios.get(url)
            .then((response) => {
                const formHtml = response.data.html;
                if (formHtml.length) {
                    // Fill form section
                    formSection.innerHTML = formHtml;
                    // Scroll to the point just above the form
                    // For default scrolling is enabled
                    if (scroll === undefined) {
                        formSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'end'
                        });
                    }
                    // Init the inserted form
                    formInit();
                } else {
                    formSection.innerHTML = 'Nothing to load...';
                }
            })
            .catch((failure) => {
                console.log(failure);
            });
    }
};

export default formLoader;
