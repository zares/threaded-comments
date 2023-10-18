import sectionManager from './section-manager';
import formLoader from './form-loader';
import itemInit from './item-init';
import config from './config';
import alerts from './alerts';

/* Comment form init */
const formInit = () => {
    const alertWrapper = document.querySelector('.js-alert-place');
    const commentForm = document.querySelector('.js-comment-form');

    if (commentForm) {
        commentForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const formData = new FormData(commentForm);
            // Send post request
            axios.post(commentForm.action, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    const html = response.data.html;
                    const parentId = formData.get('parent_id');

                    if (parentId === "") {
                        const threadList = document.querySelector('.js-thread-list');
                        threadList.insertAdjacentHTML('afterbegin', html);
                    } else {
                        const parent = document.getElementById('item-' + parentId)
                        parent.insertAdjacentHTML('beforeend', html);
                    }
                    // Мark a new message with background highlighting
                    const elementId = 'item-' + response.data.id;
                    const element = document.getElementById(elementId);
                    element.classList.add('bg-gray-50');

                    // Init the block of new message
                    itemInit(element);

                    // Show empty form after success submit
                    if (config.reloadForm === true) {
                        // Use this option for single threads structure only!
                        const rootElement = document.querySelector('.js-thread-item');
                        const id = rootElement.id.replace('item-', '');
                        // Load form with disable scrolling to her
                        formLoader(id, undefined, false);
                    } else {
                        // Can be used for multi-threads structure.
                        // In this case current form clearing for prevent
                        // the repeating submit message with same parent id.
                        for (const key of formData.keys()) {
                            const selector = "[name='" + key + "']";
                            const input = commentForm.querySelector(selector);
                            if (input) {
                                input.value = '';
                                input.readOnly = true;
                                input.disabled = true;
                            }
                        }
                        // Disabling submit button for prevent the
                        // post message as top-level comment.
                        commentForm.querySelector('.js-submit-btn').disabled = true;

                        // Load the info alert message above disabled form
                        alertWrapper.innerHTML = alerts.infoMessage();
                        const addComment = document.querySelector('.js-add-comment');
                        if (addComment) {
                            addComment.addEventListener('click', () => {
                                formLoader();
                            })
                        }

                        // NOTE: We can also add a third option that involves
                        // clearing the form and populating the parent_id field
                        // with the top-level message ID. In this case will be
                        // need to add another alert message, which should include
                        // all the necessary information.
                        // Of course, this is a more complicated option...
                    }
                    // Scroll to inserted message
                    element.scrollIntoView({ behavior: 'smooth' });
                })
                .catch((failure) => {
                    if (! failure.response) {
                        return console.log(failure);
                    }
                    const status = failure.response.status;
                    switch (status) {
                        case 422:
                            alertWrapper.innerHTML = alerts.errorMessage(
                                failure.response.data
                            );
                            break;
                        case 419:
                            alertWrapper.innerHTML = alerts.errorMessage([
                                'HTTP 500 Internal Server Error.',
                                'Please refresh page and try again...'
                            ]);
                            break;
                        default:
                            alertWrapper.innerHTML = alerts.errorMessage([
                                'HTTP 500 Internal Server Error.',
                            ]);
                            break;
                    }
                });
        });
    }

    const attachImage = document.querySelector('.js-attach-image');
    if (attachImage) {
        attachImage.addEventListener('click', () => {
            const input = attachImage.querySelector('[name="image"]');
            input.addEventListener('change', (e) => {
                const label = attachImage.querySelector('span');
                label.innerHTML = e.target.files[0].name;
            })
            input.click();
        });
    }

    const attachfile = document.querySelector('.js-attach-file');
    if (attachfile) {
        attachfile.addEventListener('click', () => {
            const input = attachfile.querySelector('[name="file"]');
            input.addEventListener('change', (e) => {
                const label = attachfile.querySelector('span');
                label.innerHTML = e.target.files[0].name;
            })
            input.click();
        });
    }

    const backButton = document.querySelector('.js-back-button');
    if (backButton) {
        backButton.addEventListener('click', () => {
            sectionManager('list');
        });
    }
};

export default formInit;
