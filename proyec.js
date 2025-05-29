// Inicializar animaciones AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
});

const applyCssBtn = document.getElementById('apply-css');
const cssInput = document.getElementById('css-input');
const styleTag = document.getElementById('custom-style');

applyCssBtn.addEventListener('click', () => {
    const css = cssInput.value;
    styleTag.textContent = css;
    alert('CSS personalizado aplicado');
});