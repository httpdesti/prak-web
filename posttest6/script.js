const modeToggle = document.getElementById('mode-toggle');
const body = document.body;
const nav = document.querySelector('nav');

function toggleMode() {
    if (body.classList.contains('light-mode')) {
        body.classList.remove('light-mode');
        body.classList.add('dark-mode');
        modeToggle.textContent = 'Mode Terang';

        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            card.classList.remove('light-mode');
            card.classList.add('dark-mode');
        });

        nav.classList.remove('light-mode');
        nav.classList.add('dark-mode');

        const navItems = document.querySelectorAll('.nav-items a');
        navItems.forEach(item => {
            item.classList.remove('light-mode');
            item.classList.add('dark-mode');
        });

        const elementsToModify = document.querySelectorAll('.custom-style');
        elementsToModify.forEach(element => {
            element.style.fontSize = '16px';
            element.style.padding = '12px';
        });
    } else {
        body.classList.remove('dark-mode');
        body.classList.add('light-mode');
        modeToggle.textContent = 'Mode Gelap';

        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            card.classList.remove('dark-mode');
            card.classList.add('light-mode');
        });

        nav.classList.remove('dark-mode');
        nav.classList.add('light-mode');

        const navItems = document.querySelectorAll('.nav-items a');
        navItems.forEach(item => {
            item.classList.remove('dark-mode');
            item.classList.add('light-mode');
        });

        const elementsToModify = document.querySelectorAll('.custom-style');
        elementsToModify.forEach(element => {
            element.style.fontSize = 'initial';
            element.style.padding = 'initial';
        });
    }
}

modeToggle.addEventListener('click', toggleMode);