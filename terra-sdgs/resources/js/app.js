import { createIcons, icons } from 'lucide';
import { animate, inView, scroll } from 'motion';

// Initialize Lucide icons
document.addEventListener('DOMContentLoaded', () => {
    createIcons({ icons });

    // Navbar scroll effect
    const navbar = document.getElementById('main-navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-sm', 'bg-white/95');
                navbar.classList.remove('bg-white');
            } else {
                navbar.classList.remove('shadow-sm', 'bg-white/95');
                navbar.classList.add('bg-white');
            }
        });
    }

    // Scroll fade-in animations
    inView('.animate-on-scroll', (element) => {
        animate(
            element,
            { opacity: [0, 1], y: [30, 0] },
            { duration: 0.6, easing: 'ease-out' }
        );
    });

    // Donation amount selector
    const amountBtns = document.querySelectorAll('.donate-amount-btn');
    const customAmountInput = document.getElementById('custom-amount-input');
    const selectedAmountInput = document.getElementById('selected-amount-input');

    if (amountBtns.length && customAmountInput && selectedAmountInput) {
        amountBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                amountBtns.forEach(b => {
                    b.classList.remove('bg-[#5E745D]', 'text-white', 'border-[#5E745D]');
                    b.classList.add('bg-white', 'text-neutral-800', 'border-neutral-300');
                });
                btn.classList.remove('bg-white', 'text-neutral-800', 'border-neutral-300');
                btn.classList.add('bg-[#5E745D]', 'text-white', 'border-[#5E745D]');

                const val = btn.dataset.value;
                selectedAmountInput.value = val;
                customAmountInput.value = val;
            });
        });

        customAmountInput.addEventListener('input', () => {
            selectedAmountInput.value = customAmountInput.value;
            amountBtns.forEach(b => {
                b.classList.remove('bg-[#5E745D]', 'text-white', 'border-[#5E745D]');
                b.classList.add('bg-white', 'text-neutral-800', 'border-neutral-300');
            });
        });
    }

    // Donation Program selection badges
    const programBadges = document.querySelectorAll('.donate-program-badge');
    const selectedProgramInput = document.getElementById('selected-program-id');
    const selectedProgramNameInput = document.getElementById('selected-program-name');

    if (programBadges.length && selectedProgramInput) {
        programBadges.forEach(badge => {
            badge.addEventListener('click', () => {
                programBadges.forEach(b => {
                    b.classList.remove('border-[#5E745D]', 'bg-[#EBF2EA]', 'ring-2', 'ring-[#5E745D]');
                    b.classList.add('border-neutral-200', 'bg-white');
                });
                badge.classList.remove('border-neutral-200', 'bg-white');
                badge.classList.add('border-[#5E745D]', 'bg-[#EBF2EA]', 'ring-2', 'ring-[#5E745D]');

                selectedProgramInput.value = badge.dataset.id;
                if (selectedProgramNameInput) {
                    selectedProgramNameInput.value = badge.dataset.name;
                }
            });
        });
    }

    // Article Category tab switcher
    const categoryTabs = document.querySelectorAll('.article-category-tab');
    const articleCards = document.querySelectorAll('.article-item-card');

    if (categoryTabs.length && articleCards.length) {
        categoryTabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                const targetCat = tab.dataset.category.toLowerCase();
                categoryTabs.forEach(t => {
                    t.classList.remove('bg-[#5E745D]', 'text-white');
                    t.classList.add('bg-neutral-100', 'text-neutral-600', 'hover:bg-neutral-200');
                });
                tab.classList.remove('bg-neutral-100', 'text-neutral-600', 'hover:bg-neutral-200');
                tab.classList.add('bg-[#5E745D]', 'text-white');

                articleCards.forEach(card => {
                    const cardCat = card.dataset.category.toLowerCase();
                    if (targetCat === 'all' || cardCat.includes(targetCat) || targetCat.includes(cardCat)) {
                        card.style.display = 'flex';
                        animate(card, { opacity: [0, 1], scale: [0.97, 1] }, { duration: 0.3 });
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }
});
