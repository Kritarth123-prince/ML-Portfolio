document.addEventListener('DOMContentLoaded', function() {
    // Typing Effect
    const typingText = document.getElementById('typing-text');
    const textToType = "Hello, I'm Kritarth Ranjan";
    let charIndex = 0;
    
    function typeWriter() {
        if (charIndex < textToType.length) {
            typingText.textContent += textToType.charAt(charIndex);
            charIndex++;
            setTimeout(typeWriter, 100);
        } else {
            document.querySelector('.typed-cursor').style.display = 'none';
        }
    }
    
    typeWriter();
    
    // Qualification Tabs
    const tabButtons = document.querySelectorAll('.qualification-button');
    const tabContents = document.querySelectorAll('.qualification-content');
    
    function showTab(tabId) {
        // Hide all tab contents
        tabContents.forEach(content => {
            content.classList.remove('qualification-active');
        });
        
        // Show the selected tab content
        const selectedTab = document.querySelector(tabId);
        if (selectedTab) {
            selectedTab.classList.add('qualification-active');
        }
        
        // Update active tab button
        tabButtons.forEach(button => {
            button.classList.remove('qualification-active');
            if (button.getAttribute('data-target') === tabId) {
                button.classList.add('qualification-active');
            }
        });
    }
    
    // Set initial active tab
    showTab('#work');
    
    // Add click event listeners to tab buttons
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-target');
            showTab(targetTab);
        });
    });
    
    // Skills Toggle
    const skillsContent = document.getElementsByClassName('skills-content');
    
    for (let i = 0; i < skillsContent.length; i++) {
        skillsContent[i].addEventListener('click', function() {
            const skillsList = this.lastElementChild;
            const skillsArrow = this.querySelector('.skills-arrow');
            
            if (this.classList.contains('skills-close')) {
                this.classList.remove('skills-close');
                this.classList.add('skills-open');
                skillsList.style.height = skillsList.scrollHeight + 'px';
                skillsArrow.style.transform = 'rotate(-180deg)';
            } else {
                this.classList.remove('skills-open');
                this.classList.add('skills-close');
                skillsList.style.height = '0';
                skillsArrow.style.transform = 'rotate(0)';
            }
        });
    }
    
    // Smooth scrolling for anchor links
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
                
                // Update URL without page jump
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

    const successMessage = document.querySelector('.form-success');
    const contactForm = document.querySelector('.contact-form form');
    
    if (successMessage && contactForm) {
        const formWasSubmitted = <?php echo isset($formDisabled) && $formDisabled ? 'true' : 'false'; ?>;
        
        if (formWasSubmitted) {
            const submissionTime = <?php echo isset($_SESSION['form_success_time']) ? $_SESSION['form_success_time'] : '0'; ?>;
            const currentTime = Math.floor(Date.now() / 1000);
            const timeRemaining = 10 - (currentTime - submissionTime);
            
            if (timeRemaining > 0) {
                contactForm.style.display = 'none';
                successMessage.style.display = 'block';
                
                setTimeout(function() {
                    successMessage.style.display = 'none';
                    contactForm.style.display = 'block';
                }, timeRemaining * 1000);
            } else {
                contactForm.style.display = 'block';
                successMessage.style.display = 'none';
            }
        }
    }
});