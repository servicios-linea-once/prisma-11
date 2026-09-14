/**
 * Prisma 11 - Headless Roving Tabindex & Typeahead
 */

window.PrismaRovingTabindex = {
    attach(containerEl, itemSelector = '[role="menuitem"], [role="option"]') {
        if (!containerEl) return;

        let query = '';
        let queryTimeout = null;

        containerEl.addEventListener('keydown', (e) => {
            const items = Array.from(containerEl.querySelectorAll(itemSelector)).filter(
                el => !el.hasAttribute('disabled') && el.offsetParent !== null
            );

            if (!items.length) return;

            const currentIndex = items.indexOf(document.activeElement);

            switch (e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    const next = currentIndex < items.length - 1 ? currentIndex + 1 : 0;
                    items[next].focus();
                    break;

                case 'ArrowUp':
                    e.preventDefault();
                    const prev = currentIndex > 0 ? currentIndex - 1 : items.length - 1;
                    items[prev].focus();
                    break;

                case 'Home':
                    e.preventDefault();
                    items[0].focus();
                    break;

                case 'End':
                    e.preventDefault();
                    items[items.length - 1].focus();
                    break;

                default:
                    // Typeahead para letras imprimibles
                    if (e.key.length === 1 && !e.ctrlKey && !e.metaKey && !e.altKey) {
                        clearTimeout(queryTimeout);
                        query += e.key.toLowerCase();
                        queryTimeout = setTimeout(() => { query = ''; }, 500);

                        const match = items.find(item =>
                            item.textContent.trim().toLowerCase().startsWith(query)
                        );
                        if (match) {
                            match.focus();
                        }
                    }
                    break;
            }
        });
    }
};
