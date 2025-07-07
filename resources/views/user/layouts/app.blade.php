
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - Desa Maju Sejahtera</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />
    <style>
    #chat-messages {
        scrollbar-width: thin;
        scrollbar-color: #059669 #f3f4f6;
    }
    #chat-messages::-webkit-scrollbar {
        width: 6px;
    }
    #chat-messages::-webkit-scrollbar-track {
        background: #f3f4f6;
    }
    #chat-messages::-webkit-scrollbar-thumb {
        background-color: #059669;
        border-radius: 3px;
    }
    </style>
</head>
<body class="bg-gray-50">
    @include('user.layouts.navbar')

    <main>
        @yield('content')
    </main>

    @include('user.layouts.footer')

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 bg-primary text-white w-12 h-12 rounded-full shadow-lg hover:bg-secondary transition-all duration-300 hidden items-center justify-center">
        <i class="fas fa-arrow-up text-xl"></i>
    </button>

    <!-- Chatbot Button -->
    <button id="chatbot-button" class="fixed bottom-24 right-8 bg-primary text-white w-12 h-12 rounded-full shadow-lg hover:bg-secondary transition-all duration-300 flex items-center justify-center">
        <i class="fas fa-comments text-xl"></i>
    </button>

    <!-- Chatbot Modal -->
    <div id="chatbot-modal" class="fixed bottom-32 right-8 w-80 bg-white rounded-lg shadow-xl hidden flex-col z-50 border border-gray-200">
        <!-- Chatbot content -->
    </div>
    <!-- JavaScript -->
     <script>
    // Population Counter Animation
    document.addEventListener("DOMContentLoaded", () => {
        const populationCounter = document.querySelector(".population-counter");
        const target = +populationCounter.getAttribute("data-target");
        const speed = 50; // Kecepatan animasi (ms)

        // Format number with commas
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

        // Trigger animasi ketika Hero Section masuk viewport
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animatePopulationCounter();
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.5 }
        );

        const heroSection = document.querySelector(".bg-gradient-to-br.from-primary.to-secondary");
        if (heroSection) {
            observer.observe(heroSection);
        }
    });
</script>
 <script>
    // Chatbot Functionality
    const chatbotButton = document.getElementById('chatbot-button');
    const chatbotModal = document.getElementById('chatbot-modal');
    const closeChatbot = document.getElementById('close-chatbot');
    const sendChatbot = document.getElementById('send-chatbot');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotMessages = document.getElementById('chatbot-messages');
    const chatbotQuestions = document.querySelectorAll('.chatbot-question');

    // Jawaban untuk pertanyaan umum
    const responses = {
        "Bagaimana cara mengurus surat keterangan?": "Anda bisa mengurus surat keterangan dengan datang ke kantor desa dengan membawa KK dan KTP. Prosesnya memakan waktu 1-2 hari kerja.",
        "Jam berapa kantor desa buka?": "Kantor desa buka setiap hari kerja (Senin-Jumat) pukul 08.00 - 16.00 WIB, dengan istirahat siang 12.00 - 13.00 WIB.",
        "Apa syarat pembuatan KTP baru?": "Syarat pembuatan KTP baru: 1. Fotokopi KK, 2. Surat pengantar RT/RW, 3. Pas foto 3x4 (2 lembar), 4. Datang ke kantor desa dengan pemohon.",
        "Bagaimana prosedur pengaduan?": "Pengaduan bisa disampaikan langsung ke kantor desa atau melalui email pengaduan@desamajusejahtera.id. Pastikan menyertakan identitas dan bukti yang jelas."
    };

    // Toggle chatbot modal
    chatbotButton.addEventListener('click', () => {
        chatbotModal.classList.toggle('hidden');
        chatbotModal.classList.toggle('flex');
    });

    // Close chatbot modal
    closeChatbot.addEventListener('click', () => {
        chatbotModal.classList.add('hidden');
        chatbotModal.classList.remove('flex');
    });

    // Handle question buttons
    chatbotQuestions.forEach(button => {
        button.addEventListener('click', () => {
            const question = button.textContent.trim();
            addMessage(question, 'user');

            setTimeout(() => {
                const answer = responses[question] || "Maaf, saya tidak mengerti pertanyaan Anda. Silakan hubungi kantor desa untuk informasi lebih lanjut.";
                addMessage(answer, 'bot');
            }, 500);
        });
    });

    // Send message function
    function sendChatbotMessage() {
        const message = chatbotInput.value.trim();
        if (message) {
            addMessage(message, 'user');
            chatbotInput.value = '';

            setTimeout(() => {
                let found = false;
                for (const [question, answer] of Object.entries(responses)) {
                    if (message.toLowerCase().includes(question.toLowerCase().substring(0, 15))) {
                        addMessage(answer, 'bot');
                        found = true;
                        break;
                    }
                }

                if (!found) {
                    addMessage("Maaf, saya tidak mengerti pertanyaan Anda. Silakan hubungi kantor desa di (021) 1234-5678 untuk informasi lebih lanjut.", 'bot');
                }
            }, 1000);
        }
    }

    // Add message to chat
    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = sender === 'user'
            ? 'bg-blue-100 p-3 rounded-lg mb-2 ml-8 text-sm'
            : 'bg-gray-100 p-3 rounded-lg mb-2 text-sm';
        messageDiv.innerHTML = `<p>${text}</p>`;
        chatbotMessages.appendChild(messageDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    // Send message on button click
    sendChatbot.addEventListener('click', sendChatbotMessage);

    // Send message on Enter key
    chatbotInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendChatbotMessage();
        }
    });
</script>
    <script>
      document
        .getElementById("mobile-menu-button")
        .addEventListener("click", function () {
          const mobileMenu = document.getElementById("mobile-menu");
          mobileMenu.classList.toggle("hidden");
        });

      // Add scroll effect to navigation
      window.addEventListener("scroll", function () {
        const nav = document.querySelector("nav");
        if (window.scrollY > 100) {
          nav.classList.add("bg-white/95", "backdrop-blur-sm");
        } else {
          nav.classList.remove("bg-white/95", "backdrop-blur-sm");
        }
      });
    </script>
    <script>
      // Animasi counter
      document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll(".counter");
        const speed = 200; // Kecepatan animasi (ms)

        const animateCounters = () => {
          counters.forEach((counter) => {
            const target = +counter.getAttribute("data-target");
            const count = +counter.innerText;
            const increment = target / speed;

            if (count < target) {
              counter.innerText = Math.ceil(count + increment);
              setTimeout(animateCounters, 1);
            } else {
              counter.innerText = target;
            }
          });
        };

        // Trigger animasi ketika section masuk viewport
        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
              }
            });
          },
          { threshold: 0.5 }
        );

        const statsSection = document.querySelector("section.py-16.bg-white");
        if (statsSection) {
          observer.observe(statsSection);
        }
      });
    </script>
    <script>
      // Back to Top Button
      const backToTopButton = document.getElementById("back-to-top");

      // Tampilkan/tutup tombol berdasarkan scroll position
      window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
          backToTopButton.classList.remove("hidden");
          backToTopButton.classList.add("flex");
        } else {
          backToTopButton.classList.add("hidden");
          backToTopButton.classList.remove("flex");
        }
      });

      // Scroll ke Hero Section saat tombol diklik
      backToTopButton.addEventListener("click", () => {
        const heroSection = document.querySelector(
          ".bg-gradient-to-br.from-primary.to-secondary"
        );
        heroSection.scrollIntoView({ behavior: "smooth" });
      });
    </script>
</body>
</html>
