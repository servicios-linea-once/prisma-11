/**
 * Prisma 11 - Headless Floating Positioning Engine
 * Calcule geometría y auto-flip con evasión de colisiones sin dependencias externas.
 */

window.PrismaFloating = {
    computePosition(referenceEl, floatingEl, options = {}) {
        if (!referenceEl || !floatingEl) return;

        const placement = options.placement || 'bottom-start';
        const offset = options.offset || 8;

        const refRect = referenceEl.getBoundingClientRect();
        const floatRect = floatingEl.getBoundingClientRect();

        const vw = window.innerWidth;
        const vh = window.innerHeight;

        let top = 0;
        let left = 0;

        // Auto-flip vertical si desborda abajo
        let isBottom = placement.startsWith('bottom');
        if (isBottom && (refRect.bottom + offset + floatRect.height > vh) && (refRect.top - offset - floatRect.height > 0)) {
            isBottom = false; // flip a top
        } else if (!isBottom && (refRect.top - offset - floatRect.height < 0) && (refRect.bottom + offset + floatRect.height < vh)) {
            isBottom = true; // flip a bottom
        }

        if (isBottom) {
            top = refRect.bottom + offset;
        } else {
            top = refRect.top - floatRect.height - offset;
        }

        // Alineación horizontal
        if (placement.endsWith('end')) {
            left = refRect.right - floatRect.width;
        } else if (placement.endsWith('center')) {
            left = refRect.left + (refRect.width / 2) - (floatRect.width / 2);
        } else {
            left = refRect.left;
        }

        // Restringir a bordes visibles de pantalla
        left = Math.max(8, Math.min(left, vw - floatRect.width - 8));
        top = Math.max(8, Math.min(top, vh - floatRect.height - 8));

        floatingEl.style.position = 'fixed';
        floatingEl.style.top = `${top}px`;
        floatingEl.style.left = `${left}px`;
        floatingEl.style.zIndex = options.zIndex || '50';
    }
};
