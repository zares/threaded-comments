import itemInit from './item-init';

/* Comment thread init */
const threadInit = () => {
    const threadItems = document.querySelectorAll('.js-thread-item');
    if (threadItems.length) {
        threadItems.forEach((item) => {
            itemInit(item);
        });
    }
};

export default threadInit;
