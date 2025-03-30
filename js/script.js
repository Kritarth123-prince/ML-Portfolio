document.addEventListener('DOMContentLoaded', function() {
    // Typing Effect
    const typingText = document.getElementById('typing-text');
    if (typingText) {
        const fullText = "Hello, I'm Kritarth Ranjan";
        const nameStart = fullText.indexOf("Kritarth Ranjan");
        let charIndex = 0;
        let nameSpan = null;

        function typeWriter() {
            if (charIndex < fullText.length) {
                if (charIndex === nameStart && !nameSpan) {
                    nameSpan = document.createElement('span');
                    nameSpan.className = 'name-highlight';
                    typingText.appendChild(nameSpan);
                }

                const currentChar = fullText.charAt(charIndex);
                if (charIndex >= nameStart && nameSpan) {
                    nameSpan.textContent += currentChar;
                } else {
                    typingText.textContent += currentChar;
                }

                charIndex++;
                setTimeout(typeWriter, 100);
            } else {
                const cursor = document.querySelector('.typed-cursor');
                if (cursor) cursor.style.display = 'none';
            }
        }

        typingText.textContent = '';
        typeWriter();
    }
    
    // Qualification Tabs
    const tabButtons = document.querySelectorAll('.qualification-button');
    const tabContents = document.querySelectorAll('.qualification-content');
    
    function showTab(tabId) {
        tabContents.forEach(content => {
            content.classList.remove('qualification-active');
        });
        
        const selectedTab = document.querySelector(tabId);
        if (selectedTab) {
            selectedTab.classList.add('qualification-active');
        }
        
        tabButtons.forEach(button => {
            button.classList.remove('qualification-active');
            if (button.getAttribute('data-target') === tabId) {
                button.classList.add('qualification-active');
            }
        });
    }
    
    showTab('#work');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-target');
            showTab(targetTab);
        });
    });
    
    // Skills Toggle
    const skillsHeaders = document.querySelectorAll('.skills-header');
    
    skillsHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const content = this.parentElement;
            content.classList.toggle('skills-open');
            content.classList.toggle('skills-close');
            
            const arrow = this.querySelector('.skills-arrow');
            if (arrow) {
                arrow.style.transform = content.classList.contains('skills-open') ? 'rotate(-180deg)' : 'rotate(0)';
            }
        });
    });
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
                
                if (history.pushState) {
                    history.pushState(null, null, targetId);
                } else {
                    window.location.hash = targetId;
                }
            }
        });
    });
    
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.section-title, .project-card, .about-content, .contact-container, .qualification-data, .skills-content, .research-card');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementPosition < windowHeight - 100) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };
    
    document.querySelectorAll('.section-title, .project-card, .about-content, .contact-container, .qualification-data, .skills-content, .research-card').forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });
    
    animateOnScroll();
    window.addEventListener('scroll', animateOnScroll);
    
    const yearElement = document.querySelector('.footer p');
    if (yearElement) {
        yearElement.textContent = `© ${new Date().getFullYear()} Kritarth Ranjan. All rights reserved.`;
    }

    // Research Papers Scroll
    const researchContainer = document.querySelector('.research-container');
    const researchScrollLeftBtn = document.querySelector('.research-scroll-btn.left');
    const researchScrollRightBtn = document.querySelector('.research-scroll-btn.right');
    
    if (researchContainer && researchScrollLeftBtn && researchScrollRightBtn) {
        const researchCards = document.querySelectorAll('.research-card');
        const minCardsForScroll = 4;
        
        const checkResearchScroll = () => {
            const hasEnoughCards = researchCards.length >= minCardsForScroll;
            const hasOverflow = researchContainer.scrollWidth > researchContainer.clientWidth;
            
            const shouldShowButtons = hasEnoughCards && hasOverflow;
            
            researchScrollLeftBtn.classList.toggle('hidden', !shouldShowButtons);
            researchScrollRightBtn.classList.toggle('hidden', !shouldShowButtons);
            
            researchScrollLeftBtn.classList.toggle('disabled', researchContainer.scrollLeft === 0);
            researchScrollRightBtn.classList.toggle('disabled', 
                researchContainer.scrollLeft + researchContainer.clientWidth >= researchContainer.scrollWidth - 1
            );
        };
        
        checkResearchScroll();
        
        researchScrollLeftBtn.addEventListener('click', () => {
            researchContainer.scrollBy({ left: -350, behavior: 'smooth' });
        });
        
        researchScrollRightBtn.addEventListener('click', () => {
            researchContainer.scrollBy({ left: 350, behavior: 'smooth' });
        });
        
        researchContainer.addEventListener('scroll', checkResearchScroll);
        window.addEventListener('resize', checkResearchScroll);
    }

    // Projects Scroll
    const projectsGrid = document.querySelector('.projects-grid');
    const projectsScrollLeftBtn = document.querySelector('.projects-scroll-btn.left');
    const projectsScrollRightBtn = document.querySelector('.projects-scroll-btn.right');
    
    if (projectsGrid && projectsScrollLeftBtn && projectsScrollRightBtn) {
        const projectCards = document.querySelectorAll('.project-card');
        const minCardsForScroll = 4;
        
        const checkProjectsScroll = () => {
            const hasEnoughCards = projectCards.length >= minCardsForScroll;
            const hasOverflow = projectsGrid.scrollWidth > projectsGrid.clientWidth;
            
            const shouldShowButtons = hasEnoughCards && hasOverflow;
            
            projectsScrollLeftBtn.classList.toggle('hidden', !shouldShowButtons);
            projectsScrollRightBtn.classList.toggle('hidden', !shouldShowButtons);
            
            projectsScrollLeftBtn.classList.toggle('disabled', projectsGrid.scrollLeft === 0);
            projectsScrollRightBtn.classList.toggle('disabled', 
                projectsGrid.scrollLeft + projectsGrid.clientWidth >= projectsGrid.scrollWidth - 1
            );
        };
        
        checkProjectsScroll();
        
        projectsScrollLeftBtn.addEventListener('click', () => {
            projectsGrid.scrollBy({ left: -350, behavior: 'smooth' });
        });
        
        projectsScrollRightBtn.addEventListener('click', () => {
            projectsGrid.scrollBy({ left: 350, behavior: 'smooth' });
        });
        
        projectsGrid.addEventListener('scroll', checkProjectsScroll);
        window.addEventListener('resize', checkProjectsScroll);
        
        let touchStartX = 0;
        let touchEndX = 0;
        
        projectsGrid.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, false);
        
        projectsGrid.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            if (touchEndX < touchStartX - 50) {
                projectsGrid.scrollBy({ left: 350, behavior: 'smooth' });
            }
            if (touchEndX > touchStartX + 50) {
                projectsGrid.scrollBy({ left: -350, behavior: 'smooth' });
            }
        }, false);
    }
});