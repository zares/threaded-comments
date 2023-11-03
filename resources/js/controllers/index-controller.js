import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
	static targets = ['content'];

	static values = {
		srcList: String,
		srcThread: String
	};

	connect() {
		// Load default section
		this.fetchContent(this.srcListValue);
  	}

  	// Add new comment button
	addNew() {
		this.loadContent();
		this.fetchContent(this.srcThreadValue);
	}

	// Back to list button
	toList() {
		this.loadContent();
		this.fetchContent(this.srcListValue);
	}

	// Show thread from list
    showThread(event) {
        this.fetchContent(event.params['url']);
    }

	// Fill the section with content
	loadContent(content) {
		content = typeof content == "undefined"
			? "Loading..."
			: content;

		this.contentTarget.innerHTML = content;
	}

	// Fetch and load the section content
	fetchContent(url) {
        axios.get(url)
            .then((response) => {
            	this.loadContent(response.data.html);
            })
            .catch((failure) => {
                console.log(failure);
            });
	}
}
