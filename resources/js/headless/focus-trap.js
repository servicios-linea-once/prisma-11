/**
 * Prisma 11 - Headless Focus Trapping & Restoration
 */

window.PrismaFocusTrap = {
    trap(containerEl, triggerEl) {
        if (!containerEl) return () => {};

        const focusableSelectors = [
            'a[href]',
            'button:not([disabled])',
            'textarea:not([disabled])',
            'input:not([disabled])',
            'select:not([disabled])',
            '[tabindex]:not([tabindex="-1"])',
        ].join(', ');

        const focusables = Array.from(containerEl.querySelectorAll(focusableSelectors));
        const firstFocusable = focusables[0] || containerEl;
        const lastFocusable = focusables[focusables.length - 1] || containerEl;

        const previousFocusedElement = triggerEl || document.activeElement;

        // Foco inicial
        setTimeout(() => {
            if (firstFocusable && typeof firstFocusable.focus === 'function') {
                firstFocusable.focus();
            }
        }, 50);

        function handleKeyDown(e) {
            if (e.key !== 'Tab') return;

            const currentFocusables = Array.from(containerEl.querySelectorAll(focusableSelectors));
            const first = currentFocusables[0];
            const last = currentFocusables[currentFocusables.length - 1];

            if (e.shiftKey) {
                if (document.activeElement === first) {
                    last.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === last) {
                    first.focus();
                    e.preventDefault();
                }
            }
        }

        containerEl.addEventListener('keydown', handleKeyDown);

        return function release() {
            containerEl.removeEventListener('keydown', handleKeyDown);
            if (previousFocusedElement && typeof previousFocusedElement.focus === 'function') {
                previousFocusedElement.focus();
            }
        };
    }
};
