<script>
    document.addEventListener("DOMContentLoaded", () => {
        const menuButton = document.getElementById("menu-button");
        const menu = document.getElementById("nav-menu");
        const menuIcon = document.getElementById("menu-icon");
        if (menuButton && menu && menuIcon) {
            menuButton.addEventListener("click", () => {
                menu.classList.toggle("hidden");
                const isMenuVisible = !menu.classList.contains("hidden");
                menuIcon.classList.toggle("fa-bars", !isMenuVisible);
                menuIcon.classList.toggle("fa-times", isMenuVisible);
            });
        }
        const nav = document.querySelector("nav");
        if (nav) {
            window.addEventListener("scroll", () => {
                if (window.scrollY > 100) {
                    nav.classList.add("bg-white/95", "backdrop-blur-sm");
                } else {
                    nav.classList.remove("bg-white/95", "backdrop-blur-sm");
                }
            });
        }
        const populationCounters = document.querySelectorAll(".population-counter");
        if (populationCounters.length > 0) {
            function animateCounter(counter) {
                const target = +counter.getAttribute("data-target");
                const duration = 2000;
                const startTime = performance.now();
                const startValue = 0;
                function numberWithCommas(x) {
                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
                function updateCounter(currentTime) {
                    const elapsedTime = currentTime - startTime;
                    const progress = Math.min(elapsedTime / duration, 1);
                    const currentValue = Math.floor(progress * target);

                    counter.innerText = numberWithCommas(currentValue);

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = numberWithCommas(target);
                    }
                }
                requestAnimationFrame(updateCounter);
            }
            const heroSection = document.querySelector(".bg-gradient-to-r.from-primary.to-secondary");
            if (heroSection) {
                const observer = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                populationCounters.forEach((counter) => {
                                    animateCounter(counter);
                                });
                                observer.disconnect();
                            }
                        });
                    },
                    {
                        threshold: 0.1,
                        rootMargin: "0px 0px -100px 0px",
                    }
                );
                observer.observe(heroSection);
            } else {
                populationCounters.forEach((counter) => {
                    animateCounter(counter);
                });
            }
        }
        const backToTopButton = document.getElementById("back-to-top");
        if (backToTopButton) {
            window.addEventListener("scroll", () => {
                if (window.scrollY > 300) {
                    backToTopButton.classList.remove("hidden");
                    backToTopButton.classList.add("flex");
                } else {
                    backToTopButton.classList.add("hidden");
                    backToTopButton.classList.remove("flex");
                }
            });
            backToTopButton.addEventListener("click", () => {
                const heroSection = document.querySelector(".bg-gradient-to-r.from-primary.to-secondary");
                if (heroSection) {
                    heroSection.scrollIntoView({ behavior: "smooth" });
                } else {
                    window.scrollTo({ top: 0, behavior: "smooth" });
                }
            });
        }
    });
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
<script defer>
    document.addEventListener("DOMContentLoaded", function () {
        AOS.init({
            once: true,
        });
    });
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "GovernmentOrganization",
        "name": "Kelurahan Sukowinangun",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo-desa.png') }}",
        "description": "Website resmi Kelurahan Sukowinangun"
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr("#ttl", {
    dateFormat: "Y-m-d",
    allowInput: true
  });
</script>
