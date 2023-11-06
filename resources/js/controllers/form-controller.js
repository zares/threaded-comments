import { Controller } from '@hotwired/stimulus';
import alerts from '../components/alerts';

export default class extends Controller {
    static targets = ['submit', 'alert'];

    initialize() {
        this.form = null;
    }

    // Disable form and show spinner
    submitStart() {
        this.form.toggleAttribute("data-submitting", true);
        this.submitTarget.disabled = true;
    }

    // Enable form and hide spinner
    submitEnd() {
        this.form.toggleAttribute("data-submitting", false);
        this.submitTarget.disabled = false;
    }

    // Submit form action
    submit(event) {
        event.preventDefault();
        // Set the form as element
        this.form = event.target;
        // Disabling form & show spinner
        this.submitStart();
        // Send form data
        this.postMessage(
            event.params['action'],
            new FormData(this.form)
        );
    }

    // Thread update event
    updateThread(parent, content, id) {
        this.dispatch('updateThread', {
                detail: {
                    content: content,
                    parent: parent,
                    id: id
                }
            }
        );
    }

    // Show the alert message
    showAlert(response) {
        switch (response.status) {
            case 422:
                this.alertTarget.innerHTML = alerts.errorMessage([
                    response.data.message
                ]);
                break;
            case 419:
                this.alertTarget.innerHTML = alerts.errorMessage([
                    'HTTP 500 Internal Server Error.',
                    'Please refresh page and try again...'
                ]);
                break;
            default:
                this.alertTarget.innerHTML = alerts.errorMessage([
                    'HTTP 500 Internal Server Error.',
                ]);
                break;
        }
    }

    // Post the message
    postMessage(url, data) {
        axios.post(url, data, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                this.updateThread(
                    data.get('parent_id'),
                    response.data.html,
                    response.data.id
                );
                this.submitEnd();
            })
            .catch((failure) => {
                if (failure.response) {
                    this.showAlert(failure.response);
                } else {
                    console.log(failure);
                }
                this.submitEnd();
            });
    }
}
