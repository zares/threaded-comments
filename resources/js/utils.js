const docReady = fn => {
    // see if DOM is already available
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', fn);
    } else {
        setTimeout(fn, 1);
    }
};

const utils = {
    docReady
};

export default utils;
