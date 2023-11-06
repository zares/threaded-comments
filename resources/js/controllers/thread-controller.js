import { Controller } from '@hotwired/stimulus';
import { initDropdowns } from 'flowbite';

export default class extends Controller {
	static targets = ['form', 'items'];

	static values = {
        srcForm: String
    };

	connect() {
		this.fetchForm(this.srcFormValue);
		initDropdowns();
  	}

    // Update thread with new message and form reloading
    updateThread(event) {
        const parent = event.detail.parent;
        const content = event.detail.content;
        const id = event.detail.id;

        if (parent !== '') {
            const terget = document.getElementById('item-' + parent);
            terget.insertAdjacentHTML('beforeend', content);
        } else {
            this.itemsTarget.insertAdjacentHTML('afterbegin', content);
        }

        const element = document.getElementById('item-' + id);

        element.classList.add('bg-gray-50');
        element.scrollIntoView({ behavior: 'smooth' });

        this.fetchForm(this.srcFormValue);
    }

    // Load form to add new comment or make reply
    loadForm(content) {
        content = typeof content == "undefined"
            ? "Loading..."
            : content;

        this.formTarget.innerHTML = content;
    }

    // Fetch form from server
	fetchForm(url) {
        axios.get(url)
            .then((response) => {
                this.loadForm(response.data.html);
            })
            .catch((failure) => {
                console.log(failure);
            });
	}
}
