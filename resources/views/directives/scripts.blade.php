<script id="prisma-anti-fouc">
(function() {
    try {
        const mode = localStorage.getItem('p11-mode') || '{{ config('prisma.mode', 'system') }}';
        const isDark = mode === 'dark' || (mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        const theme = localStorage.getItem('p11-theme') || '{{ config('prisma.theme', 'default') }}';
        document.documentElement.setAttribute('data-theme', theme);
    } catch (e) {}
})();
</script>
