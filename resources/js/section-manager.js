import threadLoader from './thread-loader';
import listLoader from './list-loader';

const sectionManager = (section, param) => {
    const loaders = {
        thread: threadLoader,
        list: listLoader
    };

    if (section !== undefined) {
        for (const [key, loader] of Object.entries(loaders)) {
            const selector = '.js-' + key + '-section';
            const element = document.querySelector(selector);
            if (key == section) {
                element.classList.remove('hidden');
                element.classList.add('block');
                loader(param);
            } else {
                element.classList.remove('block');
                element.classList.add('hidden');
            }
        }
    }
};

export default sectionManager;
