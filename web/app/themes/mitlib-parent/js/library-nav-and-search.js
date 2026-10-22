document.addEventListener('DOMContentLoaded', function () {
	const navigation = document.querySelector('section.library-navigation-bar');

	if (!navigation) {
		return;
	}

	const rootMenu = navigation.querySelector('ul.main-header-navigation__menu');
	const triggers = navigation.querySelectorAll('li.menu-item-has-children > a');

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

	if (rootMenu) {
		rootMenu.addEventListener('click', function (event) {
			const link = event.target.closest('a');
			const menuItem = link && link.closest('li');

			if (
				menuItem &&
				menuItem.parentElement === rootMenu &&
				!menuItem.classList.contains('menu-item-has-children')
			) {
				closeMenus();
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