import threadInit from './thread-init';
import formLoader from './form-loader';

/* Comments thread loader */
const threadLoader = (param) => {
    const threadSection = document.querySelector('.js-thread-section');
    if (threadSection) {
        threadSection.innerHTML = 'Loading...';

        let url = threadSection.dataset.src;
        // If thread (top level cooment id) is defined
        if (param  !== undefined) {
            url += '/' + param;
        }

        axios.get(url)
            .then((response) => {
                const threadHtml = response.data.html;
                if (threadHtml.length) {
                    threadSection.innerHTML = threadHtml;
                    formLoader(param);
                    threadInit();
                } else {
                    threadSection.innerHTML = '';
                }
            })
            .catch((failure) => {
                console.log(failure);
            });
    }
};

export default threadLoader;
