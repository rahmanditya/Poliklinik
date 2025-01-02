<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Sidebar animation on load
        const sidebar = document.querySelector('.sidebar');
        const menuItems = document.querySelectorAll('.sidebar-menu ul li a');

        // Initial load animation
        sidebar.style.opacity = '0';
        sidebar.style.transform = 'translateX(-20px)';

        setTimeout(() => {
            sidebar.style.transition = 'all 0.5s ease';
            sidebar.style.opacity = '1';
            sidebar.style.transform = 'translateX(0)';
        }, 100);

        // Menu items stagger animation
        menuItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-20px)';

            setTimeout(() => {
                item.style.transition = 'all 0.3s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, 200 + (index * 100));
        });

        // Header shadow on scroll
        const header = document.querySelector('header');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > lastScroll && currentScroll > 50) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }

            if (currentScroll > 100) {
                header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'none';
            }

            lastScroll = currentScroll;
        });

        // Search input animation
        const searchInput = document.querySelector('.search-wrapper input');

        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.style.transform = 'scale(1.02)';
        });

        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.style.transform = 'scale(1)';
        });

        // Active menu item highlight
        const currentPath = window.location.pathname;
        menuItems.forEach(item => {
            if (item.getAttribute('href') === currentPath) {
                item.classList.add('active');
            }
        });
    });

    // Modal functionality
    function openModal(periksaId) {
        const modal = document.getElementById('detailModal');
        const backdrop = modal.querySelector('.modal-backdrop');
        const content = modal.querySelector('.modal-content');
        const form = document.getElementById('periksaForm');

        // Set the form action
        form.action = `/dokter/periksa/${periksaId}/detail`;

        // Show modal
        modal.classList.remove('hidden');
        setTimeout(() => {
            backdrop.classList.add('show');
            content.classList.add('show');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('detailModal');
        const backdrop = modal.querySelector('.modal-backdrop');
        const content = modal.querySelector('.modal-content');

        // Hide modal with animation
        modal.classList.add('hidden');
        backdrop.classList.remove('show');
        content.classList.remove('show');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Notification functionality
    function closeNotification(id) {
        const notification = document.getElementById(id);
        notification.classList.add('hide');
        setTimeout(() => {
            notification.remove();
        }, 500);
    }

    // Auto-hide notifications after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const notifications = document.querySelectorAll('.notification');
        notifications.forEach(notification => {
            setTimeout(() => {
                if (notification) {
                    notification.classList.add('hide');
                    setTimeout(() => {
                        notification.remove();
                    }, 500);
                }
            }, 5000);
        });
    });
</script>