{{-- resources/views/user/layouts/scripts.blade.php --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const populationCounter = document.querySelector(".population-counter");
        if (populationCounter) {
            const target = +populationCounter.getAttribute("data-target");
            const speed = 50;

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            const animatePopulationCounter = () => {
                const count = +populationCounter.innerText.replace(/,/g, '');
                const increment = Math.ceil(target / speed);
                if (count < target) {
                    populationCounter.innerText = numberWithCommas(Math.min(count + increment, target));
                    setTimeout(animatePopulationCounter, 1);
                }
            };
            const heroSection = document.querySelector(
                ".bg-gradient-to-r.from-primary.to-secondary, .bg-gradient-to-br.from-primary.to-secondary");
            if (heroSection) {
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animatePopulationCounter();
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.5
                });
                observer.observe(heroSection);
            }
        }

        // Counter umum
        const counters = document.querySelectorAll(".counter");
        if (counters.length > 0) {
            const animateCounters = () => {
                counters.forEach(counter => {
                    const target = +counter.getAttribute("data-target");
                    const count = +counter.innerText;
                    const increment = target / 200;
                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(animateCounters, 1);
                    } else {
                        counter.innerText = target;
                    }
                });
            };
            const statsSection = document.querySelector("section.py-16.bg-white");
            if (statsSection) {
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounters();
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.5
                });
                observer.observe(statsSection);
            }
        }

        // Mobile menu
        const menuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");
        if (menuButton && mobileMenu) {
            menuButton.addEventListener("click", () => {
                mobileMenu.classList.toggle("hidden");
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
                "Bagaimana cara mengurus surat keterangan?":
                    "Anda bisa mengurus surat keterangan dengan datang ke kantor desa dengan membawa KK dan KTP. Prosesnya memakan waktu 1-2 hari kerja.",
                "Jam berapa kantor desa buka?":
                    "Kantor desa buka setiap hari kerja (Senin-Jumat) pukul 08.00 - 16.00 WIB, dengan istirahat siang 12.00 - 13.00 WIB.",
                "Apa syarat pembuatan KTP baru?":
                    "Syarat pembuatan KTP baru: 1. Fotokopi KK, 2. Surat pengantar RT/RW, 3. Pas foto 3x4 (2 lembar), 4. Datang ke kantor desa dengan pemohon.",
                "Bagaimana prosedur pengaduan?":
                    "Pengaduan bisa disampaikan langsung ke kantor desa atau melalui email pengaduan@desamajusejahtera.id. Pastikan menyertakan identitas dan bukti yang jelas.",
            };

            // Add message to chat
            const addMessage = (text, sender) => {
                const messageDiv = document.createElement("div");
                messageDiv.className = sender === "user"
                    ? "bg-blue-100 p-3 rounded-lg mb-2 ml-8 text-sm"
                    : "bg-gray-100 p-3 rounded-lg mb-2 text-sm";
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
                        if (message.toLowerCase().includes(question.toLowerCase().substring(0, 15))) {
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
