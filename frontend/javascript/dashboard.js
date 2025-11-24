document.addEventListener("DOMContentLoaded", () => {
    // Fade-in section
    const faders = document.querySelectorAll('.fade-in');

    const appearOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };

    const appearOnScroll = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
            }
        });
    }, appearOptions);

    faders.forEach(fader => {
        appearOnScroll.observe(fader);
    });

    const moreBtn = document.getElementById("more-button");
    const menu = document.getElementById("dropdown-menu");

    moreBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        menu.classList.toggle("show");
    });

    document.addEventListener("click", (e) => {
        if (!menu.contains(e.target) && !moreBtn.contains(e.target)) {
            menu.classList.remove("show");
        }
    });
});
