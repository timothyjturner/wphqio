document.addEventListener('click', function (event) {
    if (event.target.classList.contains('primary-btn')) {
        event.preventDefault();
        let parentWrapper = event.target.closest('.btn-dropdown-wrapper');

        if (parentWrapper) {
            let dropdown = parentWrapper.querySelector('.dropdown');

            if (dropdown) {
                event.target.classList.toggle('active');
                dropdown.classList.toggle('active');
            }
        }
        event.stopPropagation();
    } else {
        document.querySelectorAll('.dropdown.active').forEach(function (dropdown) {
            dropdown.classList.remove('active');
        });
        document.querySelectorAll('.primary-btn.active').forEach(function (button) {
            button.classList.remove('active');
        });
    }
});