import './bootstrap';

(function () {
    const STORAGE_KEY_THEME = 'weather-theme';
    const STORAGE_KEY_HISTORY = 'weather-history';
    const MAX_HISTORY = 5;

    const html = document.documentElement;
    const themeToggle = document.getElementById('theme-toggle');
    const iconSun = document.getElementById('icon-sun');
    const iconMoon = document.getElementById('icon-moon');
    const historyContainer = document.getElementById('history-container');
    const historyChips = document.getElementById('history-chips');

    function applyTheme(dark) {
        if (dark) {
            html.classList.add('dark');
            iconSun.classList.remove('hidden');
            iconMoon.classList.add('hidden');
        } else {
            html.classList.remove('dark');
            iconSun.classList.add('hidden');
            iconMoon.classList.remove('hidden');
        }
    }

    const savedTheme = localStorage.getItem(STORAGE_KEY_THEME);
    if (savedTheme === 'dark') {
        applyTheme(true);
    } else if (savedTheme === 'light') {
        applyTheme(false);
    } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        applyTheme(true);
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            const isDark = html.classList.contains('dark');
            applyTheme(!isDark);
            localStorage.setItem(STORAGE_KEY_THEME, !isDark ? 'dark' : 'light');
        });
    }

    function getHistory() {
        try {
            return JSON.parse(localStorage.getItem(STORAGE_KEY_HISTORY)) || [];
        } catch {
            return [];
        }
    }

    function saveHistory(history) {
        localStorage.setItem(STORAGE_KEY_HISTORY, JSON.stringify(history));
    }

    function addToHistory(city) {
        if (!city || !city.trim()) return;
        const trimmed = city.trim();
        let history = getHistory().filter(
            (c) => c.toLowerCase() !== trimmed.toLowerCase()
        );
        history.unshift(trimmed);
        if (history.length > MAX_HISTORY) {
            history = history.slice(0, MAX_HISTORY);
        }
        saveHistory(history);
        renderHistory();
    }

    function removeFromHistory(city) {
        const history = getHistory().filter(
            (c) => c.toLowerCase() !== city.toLowerCase()
        );
        saveHistory(history);
        renderHistory();
    }

    function renderHistory() {
        const history = getHistory();
        if (!historyContainer || !historyChips) return;

        if (history.length === 0) {
            historyContainer.classList.add('hidden');
            return;
        }

        historyContainer.classList.remove('hidden');
        historyChips.innerHTML = '';

        history.forEach(function (city) {
            const chip = document.createElement('div');
            chip.className =
                'inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/10 hover:bg-white/20 border border-white/10 rounded-full text-sm text-white/70 hover:text-white transition-all duration-200 cursor-pointer select-none';

            const label = document.createElement('span');
            label.textContent = city;
            label.addEventListener('click', function () {
                const url = new URL(window.location);
                url.searchParams.set('city', city);
                window.location.href = url.toString();
            });

            const removeBtn = document.createElement('span');
            removeBtn.className =
                'ml-0.5 text-white/30 hover:text-red-400 transition-colors';
            removeBtn.innerHTML =
                '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>';
            removeBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                removeFromHistory(city);
            });

            chip.appendChild(label);
            chip.appendChild(removeBtn);
            historyChips.appendChild(chip);
        });
    }

    const params = new URLSearchParams(window.location.search);
    const currentCity = params.get('city');
    if (currentCity) {
        addToHistory(currentCity);
    }

    renderHistory();
})();
