{{-- resources/views/user/layouts/scripts.blade.php --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const populationCounters = document.querySelectorAll(".population-counter");

        if (populationCounters.length > 0) {
            function animateCounter(counter) {
                const target = +counter.getAttribute("data-target");
                const duration = 2000; // 2 seconds animation
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

            // Trigger animation when section is visible
            const heroSection = document.querySelector(".bg-gradient-to-br.from-primary.to-secondary");

            if (heroSection) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            populationCounters.forEach(counter => {
                                animateCounter(counter);
                            });
                            observer.disconnect();
                        }
                    });
                }, {
                    threshold: 0.1, // Lower threshold
                    rootMargin: '0px 0px -100px 0px' // Trigger 100px before element enters
                });

                observer.observe(heroSection);
            } else {
                // Fallback if observer fails
                populationCounters.forEach(counter => {
                    animateCounter(counter);
                });
            }
        }


        // Mobile menu
        const menuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");
        const menuIcon = document.getElementById("menu-icon");

        if (menuButton && mobileMenu && menuIcon) {
            menuButton.addEventListener("click", () => {
                mobileMenu.classList.toggle("hidden");

                // Toggle ikon
                if (menuIcon.classList.contains("fa-bars")) {
                    menuIcon.classList.remove("fa-bars");
                    menuIcon.classList.add("fa-times");
                } else {
                    menuIcon.classList.remove("fa-times");
                    menuIcon.classList.add("fa-bars");
                }
            });
        }


        // Scroll nav effect
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

        // Back to Top
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
                const heroSection = document.querySelector(
                    ".bg-gradient-to-r.from-primary.to-secondary, .bg-gradient-to-br.from-primary.to-secondary"
                );
                if (heroSection) {
                    heroSection.scrollIntoView({
                        behavior: "smooth"
                    });
                }
            });
        }

        // Chatbot
        // Chatbot Implementation
        const initChatbot = () => {
            const chatbotButton = document.getElementById("chatbot-button");
            const chatbotModal = document.getElementById("chatbot-modal");
            const closeChatbot = document.getElementById("close-chatbot");
            const sendChatbot = document.getElementById("send-chatbot");
            const chatbotInput = document.getElementById("chatbot-input");
            const chatbotMessages = document.getElementById("chatbot-messages");
            const chatbotQuestions = document.querySelectorAll(".chatbot-question");

            // Return if elements not found
            if (!chatbotButton || !chatbotModal || !closeChatbot || !sendChatbot ||
                !chatbotInput || !chatbotMessages) return;

            // Responses configuration
            const responses = {
                "Bagaimana cara mengurus surat keterangan?": "Anda bisa mengurus surat keterangan dengan datang ke kantor desa dengan membawa KK dan KTP. Prosesnya memakan waktu 1-2 hari kerja.",
                "Jam berapa kantor desa buka?": "Kantor desa buka setiap hari kerja (Senin-Jumat) pukul 08.00 - 16.00 WIB, dengan istirahat siang 12.00 - 13.00 WIB.",
                "Apa syarat pembuatan KTP baru?": "Syarat pembuatan KTP baru: 1. Fotokopi KK, 2. Surat pengantar RT/RW, 3. Pas foto 3x4 (2 lembar), 4. Datang ke kantor desa dengan pemohon.",
                "Bagaimana prosedur pengaduan?": "Pengaduan bisa disampaikan langsung ke kantor desa atau melalui email pengaduan@desamajusejahtera.id. Pastikan menyertakan identitas dan bukti yang jelas.",
            };

            // Add message to chat
            const addMessage = (text, sender) => {
                const messageDiv = document.createElement("div");
                messageDiv.className = sender === "user" ?
                    "bg-blue-100 p-3 rounded-lg mb-2 ml-8 text-sm" :
                    "bg-gray-100 p-3 rounded-lg mb-2 text-sm";
                messageDiv.innerHTML = `<p>${text}</p>`;
                chatbotMessages.appendChild(messageDiv);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            };

            // Send message function
            const sendChatbotMessage = () => {
                const message = chatbotInput.value.trim();
                if (!message) return;

                addMessage(message, "user");
                chatbotInput.value = "";

                setTimeout(() => {
                    let found = false;
                    // Check for matching questions
                    for (const [question, answer] of Object.entries(responses)) {
                        if (message.toLowerCase().includes(question.toLowerCase().substring(0,
                                15))) {
                            addMessage(answer, "bot");
                            found = true;
                            break;
                        }
                    }

                    if (!found) {
                        addMessage(
                            "Maaf, saya tidak mengerti pertanyaan Anda. Silakan hubungi kantor desa di (021) 1234-5678 untuk informasi lebih lanjut.",
                            "bot"
                        );
                    }
                }, 1000);
            };

            // Event Listeners
            chatbotButton.addEventListener("click", () => {
                chatbotModal.classList.toggle("hidden");
                chatbotModal.classList.toggle("flex");
            });

            closeChatbot.addEventListener("click", () => {
                chatbotModal.classList.add("hidden");
                chatbotModal.classList.remove("flex");
            });

            // Handle question buttons if they exist
            if (chatbotQuestions.length > 0) {
                chatbotQuestions.forEach((button) => {
                    button.addEventListener("click", () => {
                        const question = button.textContent.trim();
                        addMessage(question, "user");

                        setTimeout(() => {
                            const answer = responses[question] ||
                                "Maaf, saya tidak mengerti pertanyaan Anda. Silakan hubungi kantor desa untuk informasi lebih lanjut.";
                            addMessage(answer, "bot");
                        }, 500);
                    });
                });
            }

            sendChatbot.addEventListener("click", sendChatbotMessage);

            chatbotInput.addEventListener("keypress", (e) => {
                if (e.key === "Enter") {
                    sendChatbotMessage();
                }
            });
        };

        // Initialize chatbot
        initChatbot();
    });
</script>


<script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
<script defer>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
            once: true,
        });
    });
</script>
