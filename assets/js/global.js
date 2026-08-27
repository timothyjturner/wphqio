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

(function(){
    const params=new URLSearchParams(window.location.search);
    const eventName=params.get('wphq_event');
    const source=params.get('wphq_source');

    if(!eventName)return;

    if(typeof gtag==='function'){
        gtag('event',eventName,{
            source:source||'unknown'
        });
    }

    params.delete('wphq_event');
    params.delete('wphq_source');

    const cleanQuery=params.toString();
    const cleanUrl=window.location.pathname+
        (cleanQuery?'?'+cleanQuery:'')+
        window.location.hash;

    window.history.replaceState({},document.title,cleanUrl);
})();