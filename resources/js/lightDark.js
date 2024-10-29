document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.querySelector('.theme-controller');
    const sidebar = document.getElementById('sidebar');

    // Function to add/remove the dark mode stylesheet for flatpickr
    function toggleFlatpickrStylesheet(theme) {
        const darkThemeLink = document.querySelector('#flatpickr-dark-theme');
        if (theme === 'dark') {
            if (!darkThemeLink) {
                const link = document.createElement('link');
                link.id = 'flatpickr-dark-theme';
                link.rel = 'stylesheet';
                link.type = 'text/css';
                link.href = 'https://npmcdn.com/flatpickr/dist/themes/dark.css';
                document.head.appendChild(link);
            }
        } else {
            if (darkThemeLink) {
                darkThemeLink.remove();
            }
        }
    }

    // Check stored theme preference
    const storedTheme = localStorage.getItem('theme');
    if (storedTheme) {
        document.documentElement.setAttribute('data-theme', storedTheme);
        themeToggle.checked = storedTheme === 'dark';
        applyTheme(storedTheme);
        toggleFlatpickrStylesheet(storedTheme); // Apply flatpickr theme
    }

    // Listen for the toggle change event
    themeToggle.addEventListener('change', function () {
        const theme = themeToggle.checked ? 'dark' : 'light';
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        applyTheme(theme);
        toggleFlatpickrStylesheet(theme); // Apply flatpickr theme
    });

    function applyTheme(theme) {
        if (theme === 'dark') {
            sidebar.classList.add('bg-[#191919]', 'shadow-2xl');
            sidebar.classList.remove('bg-[#F5F7F8]');
        } else {
            sidebar.classList.add('bg-[#F5F7F8]');
            sidebar.classList.remove('bg-[#191919]', 'shadow-2xl');
        }
    }
});

