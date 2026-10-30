document.querySelectorAll('[data-mobile-nav-toggle]').forEach((toggle) => {
    const navigation = document.getElementById(toggle.getAttribute('aria-controls'));

    if (!navigation) {
        return;
    }

    document.documentElement.classList.add('has-mobile-navigation');

    const closeNavigation = () => {
        navigation.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Menu openen');
    };

    toggle.addEventListener('click', () => {
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';

        navigation.classList.toggle('is-open', !isOpen);
        toggle.setAttribute('aria-expanded', String(!isOpen));
        toggle.setAttribute('aria-label', isOpen ? 'Menu openen' : 'Menu sluiten');
    });

    navigation.addEventListener('click', (event) => {
        if (event.target.closest('a')) {
            closeNavigation();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
            closeNavigation();
            toggle.focus();
        }
    });

    window.matchMedia('(min-width: 601px)').addEventListener('change', (event) => {
        if (event.matches) {
            closeNavigation();
        }
    });
});
