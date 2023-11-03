import { Controller } from '@hotwired/stimulus';
import { initDropdowns } from 'flowbite';

export default class extends Controller {
	static targets = [ 'form' ];

	static values = { srcForm: String };

	connect() {
		this.loadForm(this.srcFormValue);
		initDropdowns();
  	}


    // Fill the section with form
    formContent(content) {
        content = typeof content == "undefined"
            ? "Loading..."
            : content;

        this.formTarget.innerHTML = content;
    }

	// Fetch and load the form
	loadForm(url) {
        axios.get(url)
            .then((response) => {
                this.formContent(response.data.html);
            })
            .catch((failure) => {
                console.log(failure);
            });
	}
}
