import './bootstrap';

// Prevenir conflictos entre Alpine.js y Livewire
window.deferLoadingAlpine = true;

document.addEventListener('livewire:load', () => {
    Alpine.start();
});

