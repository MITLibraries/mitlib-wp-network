document.addEventListener('DOMContentLoaded', function () {
	// Some page layouts omit this navigation, so leave those pages untouched.
	const navigation = document.querySelector('section.library-navigation-bar');

	if (!navigation) {
		return;
	}

	// Collect dropdown controls and the optional expanding search panel.
	const rootMenu = navigation.querySelector('ul.main-header-menu');
	const triggers = navigation.querySelectorAll('li.menu-item-has-children > a');
	const searchItem = navigation.querySelector('li.global-search-trigger');
	const searchTrigger = searchItem && searchItem.querySelector(':scope > a');
	const searchSection = document.querySelector('.global-expanding-search');
	const searchContent = searchSection && searchSection.querySelector('.global-search-wrapper');
	const mobileControls = navigation.querySelector('.mobile-header-controls');
	const mobileSearchTrigger = navigation.querySelector('.mobile-search-toggle');
	const mobileMenuTrigger = navigation.querySelector('.mobile-menu-toggle');
	const mobileDialog = document.querySelector('#mobile-menu-dialog');
	const mobileBreakpoint = window.matchMedia('(max-width: 64rem)');
	const searchControls = [searchTrigger, mobileSearchTrigger].filter(Boolean);
	let closeSearch = function () {};

	if (mobileDialog && mobileMenuTrigger && rootMenu && typeof mobileDialog.showModal === 'function') {
		const mobileMenu = rootMenu.cloneNode(true);
		mobileMenu.removeAttribute('id');
		mobileMenu.className = 'mobile-main-menu';
		mobileMenu.querySelectorAll('[id]').forEach(function (element) {
			element.removeAttribute('id');
		});
		mobileMenu.querySelectorAll('.global-search-trigger').forEach(function (item) {
			item.remove();
		});
		Array.from(mobileMenu.children).forEach(function (menuItem, index) {
			const link = menuItem.querySelector(':scope > a');
			const submenu = menuItem.querySelector(':scope > ul.sub-menu');
			if (!link || !submenu) {
				return;
			}
			const button = document.createElement('button');
			const panel = document.createElement('div');
			const panelId = 'mobile-menu-panel-' + index;
			button.type = 'button';
			button.className = 'mobile-menu-accordion-toggle';
			button.innerHTML = link.innerHTML;
			button.setAttribute('aria-expanded', 'false');
			button.setAttribute('aria-controls', panelId);
			panel.id = panelId;
			panel.className = 'mobile-menu-accordion-panel';
			panel.inert = true;
			const href = link.getAttribute('href');
			if (href && href !== '#') {
				const overview = document.createElement('li');
				overview.appendChild(link.cloneNode(true));
				submenu.prepend(overview);
			}
			link.replaceWith(button);
			submenu.replaceWith(panel);
			panel.appendChild(submenu);
			button.addEventListener('click', function () {
				const willOpen = button.getAttribute('aria-expanded') !== 'true';
				button.setAttribute('aria-expanded', String(willOpen));
				menuItem.classList.toggle('is-open', willOpen);
				panel.inert = !willOpen;
			});
		});
		mobileDialog.querySelector('.mobile-menu-navigation').appendChild(mobileMenu);
		const instituteMenu = document.querySelector('.wrap-page > .institute-bar .institute-bar-menu');
		if (instituteMenu) {
			const mobileInstituteNavigation = document.createElement('nav');
			const mobileInstituteMenu = instituteMenu.cloneNode(true);
			mobileInstituteNavigation.className = 'mobile-menu-institute-navigation';
			mobileInstituteNavigation.setAttribute('aria-label', 'Mobile Institute Navigation');
			mobileInstituteMenu.removeAttribute('id');
			mobileInstituteMenu.querySelectorAll('[id]').forEach(function (element) {
				element.removeAttribute('id');
			});
			mobileInstituteNavigation.appendChild(mobileInstituteMenu);
			mobileDialog.appendChild(mobileInstituteNavigation);
		}
		mobileMenuTrigger.addEventListener('click', function () {
			if (mobileDialog.open) {
				mobileDialog.close();
				return;
			}
			closeMenus();
			closeSearch();
			mobileDialog.showModal();
			mobileMenuTrigger.setAttribute('aria-expanded', 'true');
			document.body.classList.add('mobile-menu-open');
		});
		mobileDialog.querySelector('.mobile-menu-close').addEventListener('click', function () {
			mobileDialog.close();
		});
		mobileDialog.addEventListener('close', function () {
			mobileMenuTrigger.setAttribute('aria-expanded', 'false');
			document.body.classList.remove('mobile-menu-open');
			if (mobileBreakpoint.matches) {
				mobileMenuTrigger.focus();
			}
		});
		mobileBreakpoint.addEventListener('change', function (event) {
			closeMenus();
			if (!event.matches && mobileDialog.open) {
				mobileDialog.close();
				const desktopLink = rootMenu.querySelector('a');
				if (desktopLink) {
					desktopLink.focus();
				}
			}
		});
		navigation.classList.add('has-mobile-navigation');
		mobileControls.hidden = false;
	}

	// Keep visual and ARIA states in sync, optionally preserving the item being toggled.
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

	// Initialize dropdown accessibility state and allow only one dropdown to stay open.
	triggers.forEach(function (trigger) {
		const menuItem = trigger.parentElement;
		const submenu = menuItem.querySelector(':scope > ul.sub-menu');

		if (!submenu) {
			return;
		}

		trigger.setAttribute('aria-haspopup', 'true');
		trigger.setAttribute('aria-expanded', 'false');

		trigger.addEventListener('click', function (event) {
			// Placeholder links only toggle; real links retain their navigation behavior.
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

	if (searchControls.length && searchSection && searchContent) {
		// Change only the text node to preserve icons; reserve width to avoid label shifts.
		const labelNode = searchTrigger && Array.from(searchTrigger.childNodes).find(function (node) {
			return node.nodeType === Node.TEXT_NODE && node.nodeValue.trim();
		});
		const originalLabel = labelNode ? labelNode.nodeValue.trim() : 'Search';
		if (searchTrigger && !mobileBreakpoint.matches) {
			searchTrigger.style.minWidth = searchTrigger.getBoundingClientRect().width + 'px';
		}

		// Associate the search control with its initially hidden panel.
		searchControls.forEach(function (control) {
			control.setAttribute('aria-controls', 'global-expanding-search');
			control.setAttribute('aria-expanded', 'false');
		});
		searchSection.id = 'global-expanding-search';
		searchSection.setAttribute('aria-hidden', 'true');
		searchSection.inert = true;

		function setSearchOpen(willOpen) {
			searchSection.style.height = searchSection.getBoundingClientRect().height + 'px';
			searchSection.offsetHeight;
			if (searchItem) {
				searchItem.classList.toggle('is-open', willOpen);
			}
			searchControls.forEach(function (control) {
				control.setAttribute('aria-expanded', String(willOpen));
			});
			searchSection.classList.toggle('is-open', willOpen);
			searchSection.setAttribute('aria-hidden', String(!willOpen));
			searchSection.inert = !willOpen;
			searchSection.style.height = willOpen ? searchContent.scrollHeight + 'px' : '0px';
			if (labelNode) {
				labelNode.nodeValue = willOpen ? 'Close' : originalLabel;
			}
		}
		closeSearch = function () {
			setSearchOpen(false);
		};

		searchControls.forEach(function (control) {
			control.addEventListener('click', function (event) {
				event.preventDefault();

				// Reuse an existing hero/bento search field instead of opening a second search UI.
				const heroSearchInput = document.querySelector(
					'#hero #search-form input[type="search"], #hero form.search-bento input[name="q"], form.search-bento input[name="q"]'
				);
				if (heroSearchInput) {
					heroSearchInput.focus();
					return;
				}

				// Clear dropdowns before toggling the separate search panel.
				closeMenus();

				setSearchOpen(!searchSection.classList.contains('is-open'));
			});
		});

		// Restore natural sizing after expansion so the open panel can adapt to its content.
		searchSection.addEventListener('transitionend', function (event) {
			if (event.propertyName === 'height' && searchSection.classList.contains('is-open')) {
				searchSection.style.height = 'auto';
			}
		});
	}

	// Plain top-level links dismiss dropdowns; dropdown and search controls handle themselves.
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

	// Dismiss on outside or bar-background clicks, preserving clicks within menu items.
	document.addEventListener('click', function (event) {
		if (!navigation.contains(event.target) || !event.target.closest('li')) {
			closeMenus();
		}
	});

	// Let keyboard users dismiss dropdowns without moving focus.
	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			closeMenus();
			if (mobileDialog && mobileDialog.open) {
				event.preventDefault();
				mobileDialog.close();
			}
		}
	});
});