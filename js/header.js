
    window.addEventListener('scroll', function() {
        const header = document.getElementById('nav');
        const scrollPosition = window.scrollY;

        if (scrollPosition > 50) { 
            header.style.backgroundColor = '#1d1e1e'; 
            header.style.transition = 'all 0.2s ease'; 
            header.style.opacity = '0.9';
        } else {
            header.style.backgroundColor = 'transparent'; 
        }
    });

