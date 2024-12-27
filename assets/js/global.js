document.addEventListener('click', function (event) {
    if (event.target.matches('a.primary-btn')) {
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
    } else if (!event.target.closest('.btn-dropdown-wrapper')) {
        document.querySelectorAll('.dropdown.active').forEach(function (dropdown) {
            dropdown.classList.remove('active');
        });
        document.querySelectorAll('.primary-btn.active').forEach(function (button) {
            button.classList.remove('active');
        });
    }
});

document.addEventListener('click', function (event) {
    let button = event.target.matches('.primary-btn > a') ? event.target : null;
    if (button) {
        event.preventDefault();

        let parentWrapper = button.closest('ul#menu-main-menu');

        if (parentWrapper) {
            let dropdown = parentWrapper.querySelector('.sub-menu');

            if (dropdown) {
                button.classList.toggle('active');
                dropdown.classList.toggle('active');
            }
        }

        event.stopPropagation();
    } else if (!event.target.closest('ul#menu-main-menu')) {
        document.querySelectorAll('.sub-menu.active').forEach(function (dropdown) {
            dropdown.classList.remove('active');
        });
        document.querySelectorAll('.primary-btn > a.active').forEach(function (button) {
            button.classList.remove('active');
        });
    }
});

document.querySelectorAll(".hamburger").forEach((element) => {
    element.addEventListener("click", (event) => {
        element.classList.toggle("is-active");
    });
});


// cursor js
import gsap from "https://esm.sh/gsap";
import lerp from "https://esm.sh/lerp";
import Bowser from "https://esm.sh/bowser";

// Cursor
const Cursor = (() => {

    const cursorArea  = document.querySelector('.cursor');
    const cursorSmall = document.querySelector('.cursor__circle--small');
    const cursorLarge = document.querySelector('.cursor__circle--large');

    if (!cursorSmall || !cursorLarge) {
        console.error('Cursor elements not found in the DOM.');
        return null;
    }

    let smallPos = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
    let largePos = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
    let mousePos = { x: window.innerWidth / 2, y: window.innerHeight / 2 };

    const updateCursor = () => {

        smallPos.x = lerp(smallPos.x, mousePos.x, 0.2);
        smallPos.y = lerp(smallPos.y, mousePos.y, 0.2);

        largePos.x = lerp(largePos.x, mousePos.x, 0.1);
        largePos.y = lerp(largePos.y, mousePos.y, 0.1);

        gsap.set(cursorSmall, { x: smallPos.x, y: smallPos.y });
        gsap.set(cursorLarge, { x: largePos.x, y: largePos.y });

    };

    const handleMouseMove = (e) => {

        mousePos.x = e.clientX;
        mousePos.y = e.clientY;

    };

    const handlePointerEnter = (e) => {

        const pointerType = e.target.getAttribute('data-pointer');

        // Check the value of `data-pointer` and apply animations accordingly.
        // You can extend this logic to add more animations for different `data-pointer` values.
        if ( pointerType == 'hover' ) {

            gsap.to(cursorLarge, { scale: 2, opacity: 1, duration: 0.3 });
            gsap.to(cursorSmall, { scale: 0, opacity: 0, duration: 0.3 });

        }

    };

    const handlePointerLeave = () => {

        gsap.to(cursorLarge, { scale: 1, opacity: 1, duration: 0.3 });
        gsap.to(cursorSmall, { scale: 1, opacity: 1, duration: 0.3 });

    };

    const addPointerEvents = () => {

        document.querySelectorAll('[data-pointer]').forEach((element) => {

            element.addEventListener('mouseenter', handlePointerEnter);
            element.addEventListener('mouseleave', handlePointerLeave);

        });

    };

    const removePointerEvents = () => {

        document.querySelectorAll('[data-pointer]').forEach((element) => {

            element.removeEventListener('mouseenter', handlePointerEnter);
            element.removeEventListener('mouseleave', handlePointerLeave);

        });

    };

    const init = () => {

        window.addEventListener('mousemove', handleMouseMove);
        addPointerEvents();
        gsap.ticker.add(updateCursor);

    };

    const destroy = () => {

        window.removeEventListener('mousemove', handleMouseMove);
        removePointerEvents();
        gsap.ticker.remove(updateCursor);

    };

    const disable = () => {
		
		destroy();
        cursorArea.classList.add('cursor-hide');

    }

    return { init, destroy, disable };

})();

export default Cursor;

// Init
document.addEventListener('DOMContentLoaded', () => {
	
	// Check Browser & Touch Devices
	const browser = Bowser.getParser(window.navigator.userAgent);
	const isHandheld = browser.getPlatformType() === 'tablet' || browser.getPlatformType() === 'mobile';
	const descriptionLog = document.querySelector('.hero-header__description');

    if (!isHandheld) {
		Cursor.init();
		descriptionLog.textContent = 'Non-touch device detected. Initializing cursor.';
		console.log('Non-touch device detected. Initializing cursor.');
	} else {
		Cursor.disable();
		descriptionLog.textContent = 'Touch device detected. Disabling cursor.';
		console.log('Touch device detected. Disabling cursor.');
	}

});