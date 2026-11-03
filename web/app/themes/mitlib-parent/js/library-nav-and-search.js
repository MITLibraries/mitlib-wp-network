// Initialize after the server-rendered header, menus, and search widgets are available.
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
	// Mobile controls are separate from the desktop links but reuse the same search panel.
	const mobileControls = navigation.querySelector('.mobile-header-controls');
	const mobileSearchTrigger = navigation.querySelector('.mobile-search-toggle');
	const mobileMenuTrigger = navigation.querySelector('.mobile-menu-toggle');
	const mobileDialog = document.querySelector('#mobile-menu-dialog');
	// This media query governs JavaScript focus and dialog cleanup when crossing layouts.
	const mobileBreakpoint = window.matchMedia('(max-width: 64rem)');
	// Either search trigger may be absent on a particular header layout.
	const searchControls = [searchTrigger, mobileSearchTrigger].filter(Boolean);
	// Menu handlers can call this even when no search panel exists; search setup replaces it.
	let closeSearch = function () {};

	// Only enable the mobile layout when its markup and the native modal API are available.
	if (mobileDialog && mobileMenuTrigger && rootMenu && typeof mobileDialog.showModal === 'function') {
		// Clone the WordPress menu so mobile changes do not alter desktop links or dropdowns.
		const mobileMenu = rootMenu.cloneNode(true);
		mobileMenu.removeAttribute('id');
		mobileMenu.className = 'mobile-main-menu';
		// WordPress assigns IDs to menu items; a second copy must not duplicate those IDs.
		mobileMenu.querySelectorAll('[id]').forEach(function (element) {
			element.removeAttribute('id');
		});
		// Search already has its own mobile-header button, so omit it from the dialog list.
		mobileMenu.querySelectorAll('.global-search-trigger').forEach(function (item) {
			item.remove();
		});
		// Convert only top-level items with submenus into independently toggled accordions.
		Array.from(mobileMenu.children).forEach(function (menuItem, index) {
			const link = menuItem.querySelector(':scope > a');
			const submenu = menuItem.querySelector(':scope > ul.sub-menu');
			// Ordinary menu links stay as links and need no accordion wrapper.
			if (!link || !submenu) {
				return;
			}
			const button = document.createElement('button');
			const panel = document.createElement('div');
			// Each generated panel has a unique ID for its button's aria-controls reference.
			const panelId = 'mobile-menu-panel-' + index;
			button.type = 'button';
			button.className = 'mobile-menu-accordion-toggle';
			// Preserve the existing label markup, including any icons or descriptive spans.
			button.innerHTML = link.innerHTML;
			button.setAttribute('aria-expanded', 'false');
			button.setAttribute('aria-controls', panelId);
			panel.id = panelId;
			panel.className = 'mobile-menu-accordion-panel';
			// Collapsed content must not receive keyboard focus or expose interactive controls.
			panel.inert = true;
			const href = link.getAttribute('href');
			// Keep a real parent destination reachable after replacing its link with a button.
			if (href && href !== '#') {
				const overview = document.createElement('li');
				overview.appendChild(link.cloneNode(true));
				submenu.prepend(overview);
			}
			// Wrap the existing submenu rather than reconstructing its links and attributes.
			link.replaceWith(button);
			submenu.replaceWith(panel);
			panel.appendChild(submenu);
			button.addEventListener('click', function () {
				// ARIA describes the state, the class controls CSS, and inert controls interaction.
				const willOpen = button.getAttribute('aria-expanded') !== 'true';
				button.setAttribute('aria-expanded', String(willOpen));
				menuItem.classList.toggle('is-open', willOpen);
				panel.inert = !willOpen;
			});
		});
		mobileDialog.querySelector('.mobile-menu-navigation').appendChild(mobileMenu);
		// Add institute links after the main menu, preserving their URLs and icon classes.
		const instituteMenu = document.querySelector('.wrap-page > .institute-bar .institute-bar-menu');
		if (instituteMenu) {
			const mobileInstituteNavigation = document.createElement('nav');
			const mobileInstituteMenu = instituteMenu.cloneNode(true);
			mobileInstituteNavigation.className = 'mobile-menu-institute-navigation';
			// Give this second navigation landmark a distinct accessible name.
			mobileInstituteNavigation.setAttribute('aria-label', 'Mobile Institute Navigation');
			mobileInstituteMenu.removeAttribute('id');
			// As with the main clone, retain classes but remove duplicate menu-item IDs.
			mobileInstituteMenu.querySelectorAll('[id]').forEach(function (element) {
				element.removeAttribute('id');
			});
			mobileInstituteNavigation.appendChild(mobileInstituteMenu);
			mobileDialog.appendChild(mobileInstituteNavigation);
		}
		// Opening the modal dismisses other header UI; invoking the trigger again closes it.
		mobileMenuTrigger.addEventListener('click', function () {
			if (mobileDialog.open) {
				mobileDialog.close();
				return;
			}
			closeMenus();
			closeSearch();
			// The native dialog handles modal focus containment and makes the page outside inert.
			mobileDialog.showModal();
			mobileMenuTrigger.setAttribute('aria-expanded', 'true');
			// CSS uses this body class to prevent the underlying page from scrolling.
			document.body.classList.add('mobile-menu-open');
		});
		mobileDialog.querySelector('.mobile-menu-close').addEventListener('click', function () {
			mobileDialog.close();
		});
		// Centralize cleanup for every closing path, including the button and Escape key.
		mobileDialog.addEventListener('close', function () {
			mobileMenuTrigger.setAttribute('aria-expanded', 'false');
			document.body.classList.remove('mobile-menu-open');
			// Do not restore focus to a mobile trigger when the layout has switched to desktop.
			if (mobileBreakpoint.matches) {
				mobileMenuTrigger.focus();
			}
		});
		// Clear desktop dropdown state on either crossing and dismiss the modal on desktop.
		mobileBreakpoint.addEventListener('change', function (event) {
			closeMenus();
			if (!event.matches && mobileDialog.open) {
				mobileDialog.close();
				// Move focus to a visible desktop destination after removing the mobile dialog.
				const desktopLink = rootMenu.querySelector('a');
				if (desktopLink) {
					desktopLink.focus();
				}
			}
		});
		// Reveal responsive controls only after their menu and event handlers are ready.
		navigation.classList.add('has-mobile-navigation');
		mobileControls.hidden = false;
	}

	// Keep visual and ARIA states in sync, optionally preserving the item being toggled.
	function closeMenus(exceptItem) {
		triggers.forEach(function (trigger) {
			const menuItem = trigger.parentElement;

			if (menuItem !== exceptItem) {
				// Both classes are used by header styling; remove them together with ARIA state.
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

		// Ignore a menu-item class if its expected submenu is not actually present.
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

			// Read the current state before closing siblings so this item can toggle closed.
			const willOpen = !menuItem.classList.contains('is-open');
			closeMenus(menuItem);
			menuItem.classList.toggle('is-open', willOpen);
			menuItem.classList.toggle('active', willOpen);
			trigger.setAttribute('aria-expanded', String(willOpen));
		});
	});

	// Search is optional; initialize it only when a control, panel, and measurable content exist.
	if (searchControls.length && searchSection && searchContent) {
		// Change only the text node to preserve icons; reserve width to avoid label shifts.
		const labelNode = searchTrigger && Array.from(searchTrigger.childNodes).find(function (node) {
			return node.nodeType === Node.TEXT_NODE && node.nodeValue.trim();
		});
		const originalLabel = labelNode ? labelNode.nodeValue.trim() : 'Search';
		// Measure the visible desktop link once to limit shifts when Search becomes Close.
		if (searchTrigger && !mobileBreakpoint.matches) {
			searchTrigger.style.minWidth = searchTrigger.getBoundingClientRect().width + 'px';
		}
		if (searchTrigger) {
			// Discard the initial measurement on resize so responsive CSS can size the link.
			window.addEventListener('resize', function () {
				searchTrigger.style.removeProperty('min-width');
			});
		}

		// Associate the search control with its initially hidden panel.
		searchControls.forEach(function (control) {
			control.setAttribute('aria-controls', 'global-expanding-search');
			control.setAttribute('aria-expanded', 'false');
		});
		searchSection.id = 'global-expanding-search';
		searchSection.setAttribute('aria-hidden', 'true');
		// Hidden search fields must not remain in the keyboard tab order.
		searchSection.inert = true;

		// Update both triggers and the panel together, including the animated height target.
		function setSearchOpen(willOpen) {
			// Freeze the current rendered height, including when it was previously set to auto.
			searchSection.style.height = searchSection.getBoundingClientRect().height + 'px';
			// Force layout so the browser transitions from that height to the new pixel target.
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
			// The inner wrapper supplies the full expanded height without the collapsed clipping.
			searchSection.style.height = willOpen ? searchContent.scrollHeight + 'px' : '0px';
			if (labelNode) {
				labelNode.nodeValue = willOpen ? 'Close' : originalLabel;
			}
		}
		// Supply the real close action to the mobile-menu handler registered earlier.
		closeSearch = function () {
			setSearchOpen(false);
		};

		searchControls.forEach(function (control) {
			control.addEventListener('click', function (event) {
				// Desktop search may be an anchor; handle it without following its href.
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
			// Ignore other transitioned properties and leave collapsed panels at zero height.
			if (event.propertyName === 'height' && searchSection.classList.contains('is-open')) {
				searchSection.style.height = 'auto';
			}
		});
	}

	// Plain top-level links dismiss dropdowns; dropdown and search controls handle themselves.
	if (rootMenu) {
		rootMenu.addEventListener('click', function (event) {
			// Event delegation also handles clicks on icons or spans inside a menu link.
			const link = event.target.closest('a');
			const menuItem = link && link.closest('li');

			// Only plain direct children dismiss dropdowns here; nested links are excluded.
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
				// Handle modal dismissal explicitly; the close event restores state and focus.
				event.preventDefault();
				mobileDialog.close();
			}
		}
	});
});