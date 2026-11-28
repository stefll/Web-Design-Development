class FooterTicker {
	constructor(element) {
		this.element = element;
		this.track = element.querySelector('.footer__ticker-track');
		this.groups = this.track?.querySelectorAll('.footer__ticker-group');
		this.copy = this.groups?.[0]?.querySelector('.footer__ticker-copy');

		if (!this.track || !this.groups || this.groups.length !== 2 || !this.copy) {
			return;
		}

		if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
			return;
		}

		this.fillGroups = this.fillGroups.bind(this);
		this.fillGroups();

		if ('ResizeObserver' in window) {
			this.resizeObserver = new ResizeObserver(this.fillGroups);
			this.resizeObserver.observe(this.element);
		} else {
			window.addEventListener('resize', this.fillGroups);
		}

		if (document.fonts?.ready) {
			document.fonts.ready.then(this.fillGroups);
		}
	}

	fillGroups() {
		const copyWidth = this.copy.getBoundingClientRect().width;
		const tickerWidth = this.element.clientWidth;

		if (!copyWidth || !tickerWidth) {
			return;
		}

		const copies = Math.ceil(tickerWidth / copyWidth) + 1;

		this.groups.forEach((group) => {
			const template = group.firstElementChild;

			while (group.children.length > copies) {
				group.lastElementChild.remove();
			}

			while (group.children.length < copies) {
				const copy = template.cloneNode(true);
				copy.setAttribute('aria-hidden', 'true');
				group.append(copy);
			}
		});

		this.track.style.setProperty('--footer-ticker-duration', `${copies * 24}s`);
		this.track.classList.add('is-ready');
	}
}

document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('.footer__ticker').forEach((ticker) => {
		new FooterTicker(ticker);
	});
});
