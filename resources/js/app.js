// Sembakoci app JS
document.addEventListener('DOMContentLoaded', function () {
    // Mobile menu toggle
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Cart quantity controls for client-side forms
    document.querySelectorAll('.qty-increase').forEach(btn => {
        btn.addEventListener('click', function () {
            const input = this.closest('.qty-control').querySelector('.qty-input');
            if (input) {
                const max = parseInt(input.getAttribute('max') || '999');
                const current = parseInt(input.value || '1');
                if (current < max) {
                    input.value = current + 1;
                }
            }
        });
    });
    document.querySelectorAll('.qty-decrease').forEach(btn => {
        btn.addEventListener('click', function () {
            const input = this.closest('.qty-control').querySelector('.qty-input');
            if (input) {
                const min = parseInt(input.getAttribute('min') || '1');
                const current = parseInt(input.value || '1');
                if (current > min) {
                    input.value = current - 1;
                }
            }
        });
    });
});
