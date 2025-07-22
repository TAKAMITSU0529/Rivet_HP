// DOM読み込み完了後に実行
document.addEventListener('DOMContentLoaded', function() {
    
    // ナビゲーション関連
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');
    const header = document.querySelector('.header');

    // ハンバーガーメニューの開閉
    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
        document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
    });

    // ナビゲーションリンククリック時の処理
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // モバイルメニューを閉じる
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.style.overflow = '';

            // スムーススクロール（念のため手動実装）
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const headerHeight = header.offsetHeight;
                const targetPosition = targetSection.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // スクロール時のヘッダー処理
    let lastScrollTop = 0;
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // ヘッダーの背景透明度調整
        if (scrollTop > 50) {
            header.style.background = 'rgba(255, 255, 255, 0.95)';
            header.style.backdropFilter = 'blur(10px)';
        } else {
            header.style.background = '#FFFFFF';
            header.style.backdropFilter = 'none';
        }

        lastScrollTop = scrollTop;
    });

    // スクロールアニメーション
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // アニメーション対象要素を監視
    const animateElements = document.querySelectorAll(
        '.section-header, .philosophy-main, .philosophy-text, .value-item, ' +
        '.business-row, .message-content, .company-table, .contact-content'
    );

    animateElements.forEach(el => {
        el.classList.add('fade-in');
        observer.observe(el);
    });

    // 段階的アニメーション（グリッドアイテム）
    const staggerElements = document.querySelectorAll('.philosophy-values .value-item, .business-list .business-row');
    staggerElements.forEach((el, index) => {
        el.style.transitionDelay = `${index * 0.1}s`;
    });

    // CTAボタンのホバー効果強化
    const ctaButtons = document.querySelectorAll('.cta-button, .submit-button');
    ctaButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.02)';
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // パララックス効果（軽微）
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const heroContent = document.querySelector('.hero-content');
        
        if (heroContent && scrolled < window.innerHeight) {
            heroContent.style.transform = `translateY(${scrolled * 0.3}px)`;
        }
    });

    // フォーム送信処理
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // 送信ボタンのローディング状態
            const submitButton = this.querySelector('.submit-button');
            const originalText = submitButton.textContent;
            
            submitButton.textContent = '送信中...';
            submitButton.disabled = true;
            
            // 実際の送信処理をここに実装
            // この例では2秒後に完了とする
            setTimeout(() => {
                submitButton.textContent = '送信完了';
                submitButton.style.background = '#28a745';
                
                // 3秒後に元に戻す
                setTimeout(() => {
                    submitButton.textContent = originalText;
                    submitButton.disabled = false;
                    submitButton.style.background = '';
                    this.reset(); // フォームをリセット
                }, 3000);
            }, 2000);
        });
    }

    // フォーム入力時のリアルタイムバリデーション
    const formInputs = document.querySelectorAll('.form-group input, .form-group textarea');
    formInputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.style.borderColor = '#dc3545';
                this.style.boxShadow = '0 0 0 0.2rem rgba(220, 53, 69, 0.25)';
            } else {
                this.style.borderColor = '#28a745';
                this.style.boxShadow = '0 0 0 0.2rem rgba(40, 167, 69, 0.25)';
            }
        });

        input.addEventListener('focus', function() {
            this.style.borderColor = '#7A9BB8';
            this.style.boxShadow = '0 0 0 0.2rem rgba(122, 155, 184, 0.25)';
        });
    });

    // ホバー時の要素アニメーション強化
    const hoverElements = document.querySelectorAll('.value-item, .business-row');
    hoverElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });

        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // スクロール進捗インジケーター
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(90deg, #1B3B5C, #7A9BB8);
        z-index: 9999;
        transition: width 0.1s ease;
    `;
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', function() {
        const windowHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrolled = (window.scrollY / windowHeight) * 100;
        progressBar.style.width = scrolled + '%';
    });



    // ページ読み込み完了時のロードアニメーション
    window.addEventListener('load', function() {
        document.body.classList.add('loaded');
        
        // ヒーローセクションの要素を順次表示
        const heroElements = document.querySelectorAll('.hero-title, .hero-subtitle, .cta-button');
        heroElements.forEach((el, index) => {
            setTimeout(() => {
                el.style.animationPlayState = 'running';
            }, index * 200);
        });
    });

    // リサイズ時の処理
    window.addEventListener('resize', function() {
        // モバイルメニューが開いている場合は閉じる
        if (window.innerWidth > 768) {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // タブレット・PC時のホバー効果無効化（タッチデバイス）
    if ('ontouchstart' in window) {
        document.body.classList.add('touch-device');
    }

    console.log('株式会社JTS コーポレートサイト - JavaScript初期化完了');
});

// ユーティリティ関数
function throttle(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// スクロール処理の最適化
const optimizedScrollHandler = throttle(() => {
    // スクロール関連の処理をここに集約
}, 16); // 60fps

window.addEventListener('scroll', optimizedScrollHandler);
