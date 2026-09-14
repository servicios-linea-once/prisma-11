/**
 * Prisma 11 - Reactive Alpine.js Store
 * https://github.com/servicio-linea-once/prisma-11
 */

(function () {
    function initPrismaStore() {
        if (!window.Alpine) {
            return;
        }

        window.Alpine.store('prisma', {
            mode: localStorage.getItem('p11-mode') || 'system',
            theme: localStorage.getItem('p11-theme') || 'default',

            get isDark() {
                if (this.mode === 'dark') return true;
                if (this.mode === 'light') return false;
                return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            },

            init() {
                this.apply();

                if (window.matchMedia) {
                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                        if (this.mode === 'system') {
                            this.apply();
                        }
                    });
                }
            },

            setMode(newMode) {
                if (!['light', 'dark', 'system'].includes(newMode)) {
                    return;
                }
                this.mode = newMode;
                try {
                    localStorage.setItem('p11-mode', newMode);
                    document.cookie = `p11-mode=${newMode}; path=/; max-age=31536000; SameSite=Lax`;
                } catch (e) {}

                this.apply();
                window.dispatchEvent(new CustomEvent('prisma:mode-changed', {
                    detail: { mode: newMode, isDark: this.isDark }
                }));
            },

            toggleMode() {
                this.setMode(this.isDark ? 'light' : 'dark');
            },

            setTheme(newTheme) {
                this.theme = newTheme;
                try {
                    localStorage.setItem('p11-theme', newTheme);
                    document.cookie = `p11-theme=${newTheme}; path=/; max-age=31536000; SameSite=Lax`;
                } catch (e) {}

                document.documentElement.setAttribute('data-theme', newTheme);
                window.dispatchEvent(new CustomEvent('prisma:theme-changed', {
                    detail: { theme: newTheme }
                }));
            },

            apply() {
                const dark = this.isDark;
                if (dark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
                document.documentElement.setAttribute('data-theme', this.theme);
            }
        });
    }

    if (window.Alpine) {
        initPrismaStore();
    } else {
        document.addEventListener('alpine:init', initPrismaStore);
    }
})();
