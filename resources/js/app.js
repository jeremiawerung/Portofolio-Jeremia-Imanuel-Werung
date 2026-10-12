import './bootstrap';

// ============================================
// Scroll Reveal Animation
// ============================================
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            revealObserver.unobserve(entry.target);
        }
    });
}, { rootMargin: '0px 0px -100px 0px' });

document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

// ============================================
// Skill Bar Animation
// ============================================
const skillBarObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate');
            skillBarObserver.unobserve(entry.target);
        }
    });
}, { rootMargin: '0px 0px -50px 0px' });

document.querySelectorAll('.skill-bar-fill').forEach(bar => skillBarObserver.observe(bar));

// ============================================
// Navbar Scroll Effect
// ============================================
const navbar = document.getElementById('navbar');
let lastScrollY = 0;

const handleNavScroll = () => {
    const currentScrollY = window.scrollY;

    if (navbar) {
        if (currentScrollY > 50) {
            navbar.classList.add('bg-[#0f172a]/95', 'backdrop-blur-xl', 'shadow-lg', 'shadow-indigo-500/5');
            navbar.classList.remove('bg-transparent');
        } else {
            navbar.classList.remove('bg-[#0f172a]/95', 'backdrop-blur-xl', 'shadow-lg', 'shadow-indigo-500/5');
            navbar.classList.add('bg-transparent');
        }
    }

    lastScrollY = currentScrollY;
};

// ============================================
// Active Navigation Link
// ============================================
const updateActiveNav = () => {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    let currentSection = '';

    sections.forEach(section => {
        const sectionTop = section.offsetTop - 120;
        const sectionHeight = section.offsetHeight;
        if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
            currentSection = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${currentSection}`) {
            link.classList.add('active');
        }
    });
};

// ============================================
// Mobile Menu Toggle
// ============================================
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
const mobileMenuClose = document.getElementById('mobile-menu-close');
const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.add('open');
        mobileMenuOverlay?.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    const closeMenu = () => {
        mobileMenu.classList.remove('open');
        mobileMenuOverlay?.classList.add('hidden');
        document.body.style.overflow = '';
    };

    mobileMenuClose?.addEventListener('click', closeMenu);
    mobileMenuOverlay?.addEventListener('click', closeMenu);

    // Close on mobile nav link click
    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });
}

// ============================================
// Stat Counter Animation
// ============================================
const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (!entry.isIntersecting) return;

        const counter = entry.target;
        counterObserver.unobserve(counter);

        const target = parseInt(counter.dataset.count);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            counter.textContent = Math.floor(current) + (counter.dataset.suffix || '');
        }, 16);
    });
}, { rootMargin: '0px 0px -50px 0px' });

document.querySelectorAll('[data-count]').forEach(counter => counterObserver.observe(counter));

// ============================================
// Smooth Scroll for Anchor Links
// ============================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

// ============================================
// Typing Effect
// ============================================
const typingElement = document.getElementById('typing-text');
if (typingElement) {
    const texts = [
        'QA Engineer',
        'Web Developer',
        'Data Analyst',
        'Detail-Oriented',
    ];
    let textIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typingSpeed = 100;

    const type = () => {
        const currentText = texts[textIndex];

        if (isDeleting) {
            typingElement.textContent = currentText.substring(0, charIndex - 1);
            charIndex--;
            typingSpeed = 50;
        } else {
            typingElement.textContent = currentText.substring(0, charIndex + 1);
            charIndex++;
            typingSpeed = 100;
        }

        if (!isDeleting && charIndex === currentText.length) {
            typingSpeed = 2000;
            isDeleting = true;
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            textIndex = (textIndex + 1) % texts.length;
            typingSpeed = 500;
        }

        setTimeout(type, typingSpeed);
    };

    setTimeout(type, 1000);
}

// ============================================
// Particle Background (Hero Section)
// ============================================
const createParticles = () => {
    const canvas = document.getElementById('particle-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let particles = [];
    let animationId;

    const resize = () => {
        canvas.width = canvas.parentElement.offsetWidth;
        canvas.height = canvas.parentElement.offsetHeight;
    };

    class Particle {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 2 + 0.5;
            this.speedX = (Math.random() - 0.5) * 0.5;
            this.speedY = (Math.random() - 0.5) * 0.5;
            this.opacity = Math.random() * 0.5 + 0.1;
        }

        update() {
            this.x += this.speedX;
            this.y += this.speedY;

            if (this.x > canvas.width) this.x = 0;
            if (this.x < 0) this.x = canvas.width;
            if (this.y > canvas.height) this.y = 0;
            if (this.y < 0) this.y = canvas.height;
        }

        draw() {
            ctx.fillStyle = `rgba(99, 102, 241, ${this.opacity})`;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    const init = () => {
        particles = [];
        const numParticles = Math.floor((canvas.width * canvas.height) / 8000);
        for (let i = 0; i < Math.min(numParticles, 100); i++) {
            particles.push(new Particle());
        }
    };

    const connectParticles = () => {
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);

                if (dist < 120) {
                    ctx.strokeStyle = `rgba(99, 102, 241, ${0.1 * (1 - dist / 120)})`;
                    ctx.lineWidth = 0.5;
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }
    };

    const animate = () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => {
            p.update();
            p.draw();
        });
        connectParticles();
        animationId = requestAnimationFrame(animate);
    };

    resize();
    init();
    animate();

    window.addEventListener('resize', () => {
        resize();
        init();
    });
};

// ============================================
// Initialize Everything
// ============================================
window.addEventListener('scroll', () => {
    handleNavScroll();
    updateActiveNav();
}, { passive: true });

// Initial calls
document.addEventListener('DOMContentLoaded', () => {
    createParticles();
});

// Back to top button
const backToTop = document.getElementById('back-to-top');
if (backToTop) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 400) {
            backToTop.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
            backToTop.classList.add('opacity-100', 'translate-y-0');
        } else {
            backToTop.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
            backToTop.classList.remove('opacity-100', 'translate-y-0');
        }
    }, { passive: true });

    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// ============================================
// Layout sidebar + modul per halaman
// (cuma dimuat di halaman yang butuh)
// ============================================
import './portal';
import './theme';

const pageModules = {
    dashboard: () => import('./pages/dashboard'),
    'chat-room': () => import('./pages/chat-room'),
    'smart-talk': () => import('./pages/smart-talk'),
};

pageModules[document.body.dataset.page]?.();
