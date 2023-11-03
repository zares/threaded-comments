import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [
        'content'
    ];

    static values = {
        srcContent: String
    };

    static classes = [
        'passiveOrder',
        'activeOrder'
    ];

    connect() {
        this.initialzePagination();
    }

    initialize() {
        this.index = 0;
        this.order = 'id';
        this.sorts = ['desc', 'asc'];
    }

    initialzePagination() {
        const paginator = this.element.querySelector('[data-paginator]');
        const navLinks = paginator.querySelectorAll('a');
        navLinks.forEach((item) => {
            item.addEventListener('click', (event) => {
                event.preventDefault();
                this.fetchContent(item.getAttribute('href'));
            });
        });
    }

    orderBy(event) {
        let sort, url = this.srcContentValue;
        const order = event.params['order'];

        if (typeof order == "undefined") {
            order = this.order;
            sort = this.sorts[0];
        } else if (this.order == order) {
            sort = this.sorts[this.index];
            this.index = Math.abs(--this.index);
            this.order = order;
        } else {
            sort = this.sorts[0];
            this.order = order;
            this.index = 1;
        }

        url += '?orderby=' + order + '&sort=' + sort;
        this.fetchContent(url);

        this.toggleStyles(event.target);
    }

    toggleStyles(element) {
        const icons = this.element.querySelectorAll('[data-sort-icon]');

        icons.forEach((icon) => {
            if (icon.classList.contains(this.activeOrderClass)) {
                icon.classList.remove(this.activeOrderClass);
                icon.classList.add(this.passiveOrderClass);
            }
        });

        const icon = element.querySelector('[data-sort-icon]');
        icon.classList.remove(this.passiveOrderClass);
        icon.classList.add(this.activeOrderClass);
    }

    loadContent(content) {
        content = typeof content == "undefined"
            ? "Loading..."
            : content;

        this.contentTarget.innerHTML = content;
    }

    fetchContent(url) {
        axios.get(url)
            .then((response) => {
                this.loadContent(response.data.html);
                this.initialzePagination();
            })
            .catch((failure) => {
                console.log(failure);
            });
    }
}
