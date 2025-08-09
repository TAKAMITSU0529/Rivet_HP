// Navigation functionality
document.addEventListener('DOMContentLoaded', function() {
    // Mobile navigation toggle
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
        });
    }

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Close mobile menu if open
                if (navMenu.classList.contains('active')) {
                    navMenu.classList.remove('active');
                    navToggle.classList.remove('active');
                }
            }
        });
    });

    // Navbar scroll effect
    const navbar = document.getElementById('nav-main');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Solution tabs functionality
    const solutionTabs = document.querySelectorAll('.solution-tab');
    const solutionItems = document.querySelectorAll('.solution-item');

    solutionTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            
            // Remove active class from all tabs and items
            solutionTabs.forEach(t => t.classList.remove('active'));
            solutionItems.forEach(item => item.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding item
            this.classList.add('active');
            const targetItem = document.querySelector(`[data-solution="${target}"]`);
            if (targetItem) {
                targetItem.classList.add('active');
            }
        });
    });

    // Contact form handling
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Here you would typically send the form data to a server
            // For now, we'll just show a success message
            alert('JOD[BŠLhFTVD~YÅSˆŠ3¶måå…kT#aD_W~Y');
            
            // Reset form
            this.reset();
        });
    }

    // CASEŸ> Filter Functionality
    const filterTags = document.querySelectorAll('.filter-tag');
    const caseCards = document.querySelectorAll('.case-card');

    filterTags.forEach(tag => {
        tag.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            
            // Remove active class from all tags
            filterTags.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Filter case cards
            caseCards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                
                if (category === 'all' || cardCategory === category) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    // Case Upload Modal Functionality
    const addCaseBtn = document.getElementById('add-case-btn');
    const modalOverlay = document.getElementById('case-modal-overlay');
    const modalClose = document.getElementById('modal-close');
    const formCancel = document.getElementById('form-cancel');
    const caseUploadForm = document.getElementById('case-upload-form');
    const imageInput = document.getElementById('case-image');
    const imagePreview = document.getElementById('image-preview');

    // Open modal
    if (addCaseBtn) {
        addCaseBtn.addEventListener('click', function() {
            modalOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

    // Close modal
    function closeModal() {
        modalOverlay.classList.remove('active');
        document.body.style.overflow = 'auto';
        // Reset form
        if (caseUploadForm) {
            caseUploadForm.reset();
            resetImagePreview();
        }
    }

    if (modalClose) {
        modalClose.addEventListener('click', closeModal);
    }

    if (formCancel) {
        formCancel.addEventListener('click', closeModal);
    }

    // Close modal when clicking on overlay
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });
    }

    // Handle image upload preview
    function resetImagePreview() {
        imagePreview.innerHTML = `
            <div class="upload-placeholder">
                <span class="upload-icon">=÷</span>
                <p>¯êÃ¯Wf;Ï’xž</p>
                <small>¨hµ¤º: 400×250px</small>
            </div>
        `;
    }

    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                        <p style="margin-top: 10px; font-size: 0.9rem; color: var(--text-secondary);">${file.name}</p>
                    `;
                };
                reader.readAsDataURL(file);
            } else {
                resetImagePreview();
            }
        });
    }

    // Handle form submission
    if (caseUploadForm) {
        caseUploadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const caseData = {
                clientName: formData.get('clientName'),
                projectName: formData.get('projectName'),
                businessCategory: formData.get('businessCategory'),
                industryTag: formData.get('industryTag'),
                caseTitle: formData.get('caseTitle'),
                caseDescription: formData.get('caseDescription'),
                result1: formData.get('result1'),
                result2: formData.get('result2'),
                result3: formData.get('result3'),
                caseImage: formData.get('caseImage')
            };
            
            // Validate required fields
            const requiredFields = ['clientName', 'projectName', 'businessCategory', 'caseTitle', 'caseDescription'];
            const missingFields = requiredFields.filter(field => !caseData[field]);
            
            if (missingFields.length > 0) {
                alert('Åî’Yyfe›WfO`UD');
                return;
            }

            // In a real application, you would send this data to a server
            // For demonstration, we'll create a new case card and add it to the grid
            createNewCaseCard(caseData);
            
            // Close modal and show success message
            closeModal();
            alert('‹‹Lc8ký UŒ~W_');
        });
    }

    // Function to create a new case card
    function createNewCaseCard(caseData) {
        const casesGrid = document.querySelector('.cases-grid');
        if (!casesGrid) return;

        // Create image URL from file (in real app, this would be a server URL)
        let imageUrl = 'https://via.placeholder.com/400x250/667eea/ffffff?text=°‹‹';
        if (caseData.caseImage && caseData.caseImage.size > 0) {
            imageUrl = URL.createObjectURL(caseData.caseImage);
        }

        // Determine tag class based on business category
        let tagClass = 'ai-tag';
        let tagText = 'AIûDX/ô';
        
        switch(caseData.businessCategory) {
            case 'web':
                tagClass = 'web-tag';
                tagText = 'WEB6\';
                break;
            case 'subsidy':
                tagClass = 'subsidy-tag';
                tagText = 'Ü©Ñ/ô';
                break;
        }

        // Create case card HTML
        const caseCardHTML = `
            <div class="case-card" data-category="${caseData.businessCategory}">
                <div class="case-image-container">
                    <img src="${imageUrl}" alt="${caseData.caseTitle}" class="case-image">
                    <div class="case-business-tag ${tagClass}">${tagText}</div>
                    <div class="case-overlay">
                        <button class="case-detail-btn">s0’‹‹</button>
                    </div>
                </div>
                <div class="case-content">
                    <div class="case-meta">
                        <div class="client-info">
                            <span class="client-name">${caseData.clientName}</span>
                            <span class="project-name">${caseData.projectName}</span>
                        </div>
                        ${caseData.industryTag ? `<span class="industry-tag">${caseData.industryTag}</span>` : ''}
                    </div>
                    <h3 class="case-title">${caseData.caseTitle}</h3>
                    <p class="case-description">${caseData.caseDescription}</p>
                    <div class="case-results">
                        ${caseData.result1 ? `<span class="result-tag success">${caseData.result1}</span>` : ''}
                        ${caseData.result2 ? `<span class="result-tag success">${caseData.result2}</span>` : ''}
                        ${caseData.result3 ? `<span class="result-tag info">${caseData.result3}</span>` : ''}
                    </div>
                </div>
            </div>
        `;

        // Add the new card to the grid
        casesGrid.insertAdjacentHTML('beforeend', caseCardHTML);
    }

    // Admin mode toggle (for demonstration - in production, this would be based on user authentication)
    let adminMode = false;
    
    // Add keyboard shortcut to toggle admin mode (Ctrl+Shift+A)
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.shiftKey && e.key === 'A') {
            adminMode = !adminMode;
            const adminSection = document.querySelector('.case-admin-section');
            if (adminSection) {
                adminSection.style.display = adminMode ? 'block' : 'none';
            }
            console.log('Admin mode:', adminMode ? 'ON' : 'OFF');
        }
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    // Observe case cards for animation
    caseCards.forEach(card => {
        observer.observe(card);
    });
});

// Utility function to handle responsive design
function handleResize() {
    const width = window.innerWidth;
    const casesGrid = document.querySelector('.cases-grid');
    
    if (casesGrid) {
        if (width <= 768) {
            casesGrid.style.gridTemplateColumns = '1fr';
        } else if (width <= 1024) {
            casesGrid.style.gridTemplateColumns = 'repeat(2, 1fr)';
        } else {
            casesGrid.style.gridTemplateColumns = 'repeat(3, 1fr)';
        }
    }
}

// Listen for resize events
window.addEventListener('resize', handleResize);

// Initialize on load
document.addEventListener('DOMContentLoaded', handleResize);