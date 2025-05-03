<aside  id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div id="drawer-navigation"  class="h-full px-3 pb-4 overflow-y-auto scrollable bg-white dark:bg-gray-800">
        @auth
            {!! $html !!}
        @endauth
    </div>

    <script>
        window.addEventListener('load', () => {
            let idT = setTimeout(() => {
                const elmSvgHidden = document.querySelectorAll('.show-after-init');
                for (let i = 0; i < elmSvgHidden.length; i++) {
                    const element = elmSvgHidden[i];
                    if (element.classList.contains('hidden')) element.classList.remove('hidden');
                }
                clearTimeout(idT);
            }, 50);
        });
    </script>
</aside>
