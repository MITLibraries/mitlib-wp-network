document.addEventListener('DOMContentLoaded', function () {
	const navigation = document.querySelector('section.library-navigation-bar');

	if (!navigation) {
		return;
	}

	const rootMenu = navigation.querySelector('ul.main-header-navigation__menu');
	const triggers = navigation.querySelectorAll('li.menu-item-has-children > a');
	const searchItem = navigation.querySelector('li.global-search-trigger');
	const searchTrigger = searchItem && searchItem.querySelector(':scope > a');
	const searchSection = document.querySelector('.global-expanding-search');
	const searchContent = searchSection && searchSection.querySelector('.global-expanding-search__inner');

	function closeMenus(exceptItem) {
		triggers.forEach(function (trigger) {
			const menuItem = trigger.parentElement;

			if (menuItem !== exceptItem) {
				menuItem.classList.remove('is-open');
				menuItem.classList.remove('active');
				trigger.setAttribute('aria-expanded', 'false');
			}
		});
	}

	triggers.forEach(function (trigger) {
		const menuItem = trigger.parentElement;
		const submenu = menuItem.querySelector(':scope > ul.sub-menu');

		if (!submenu) {
			return;
		}

		trigger.setAttribute('aria-haspopup', 'true');
		trigger.setAttribute('aria-expanded', 'false');

		trigger.addEventListener('click', function (event) {
			const href = trigger.getAttribute('href');
			const isPlaceholderLink = href === '' || href === '#';

			if (isPlaceholderLink) {
				event.preventDefault();
			}

			const willOpen = !menuItem.classList.contains('is-open');
			closeMenus(menuItem);
			menuItem.classList.toggle('is-open', willOpen);
			menuItem.classList.toggle('active', willOpen);
			trigger.setAttribute('aria-expanded', String(willOpen));
		});
	});

	if (searchTrigger && searchSection && searchContent) {
		const labelNode = Array.from(searchTrigger.childNodes).find(function (node) {
			return node.nodeType === Node.TEXT_NODE && node.nodeValue.trim();
		});
		const originalLabel = labelNode ? labelNode.nodeValue.trim() : 'Search';
		const originalWidth = searchTrigger.getBoundingClientRect().width;
		searchTrigger.style.minWidth = originalWidth + 'px';

		searchTrigger.setAttribute('aria-controls', 'global-expanding-search');
		searchTrigger.setAttribute('aria-expanded', 'false');
		searchSection.id = 'global-expanding-search';
		searchSection.setAttribute('aria-hidden', 'true');

		searchTrigger.addEventListener('click', function (event) {
			event.preventDefault();

			const heroSearchInput = document.querySelector(
				'#hero #search-form input[type="search"], #hero form.search-bento input[name="q"], form.search-bento input[name="q"]'
			);
			if (heroSearchInput) {
				heroSearchInput.focus();
				return;
			}

			closeMenus();

			const willOpen = !searchItem.classList.contains('is-open');

			if (willOpen) {
				searchItem.classList.add('is-open');
				searchTrigger.setAttribute('aria-expanded', 'true');
				searchSection.classList.add('is-open');
				searchSection.setAttribute('aria-hidden', 'false');
				searchSection.style.height = '0px';
				requestAnimationFrame(function () {
					searchSection.style.height = searchContent.scrollHeight + 'px';
				});
			} else {
				searchSection.style.height = searchSection.getBoundingClientRect().height + 'px';
				searchSection.offsetHeight;
				searchItem.classList.remove('is-open');
				searchTrigger.setAttribute('aria-expanded', 'false');
				searchSection.classList.remove('is-open');
				searchSection.setAttribute('aria-hidden', 'true');
				searchSection.style.height = '0px';
			}

			if (labelNode) {
				labelNode.nodeValue = willOpen ? 'Close' : originalLabel;
			}
		});

		searchSection.addEventListener('transitionend', function (event) {
			if (event.propertyName === 'height' && searchSection.classList.contains('is-open')) {
				searchSection.style.height = 'auto';
			}
		});
	}

	if (rootMenu) {
		rootMenu.addEventListener('click', function (event) {
			const link = event.target.closest('a');
			const menuItem = link && link.closest('li');

			if (
				menuItem &&
				menuItem.parentElement === rootMenu &&
				menuItem !== searchItem
			) {
				if (!menuItem.classList.contains('menu-item-has-children')) {
					closeMenus();
				}
			}
		});
	}

	document.addEventListener('click', function (event) {
		if (!navigation.contains(event.target)) {
			closeMenus();
		}
	});

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			closeMenus();
		}
	});
});