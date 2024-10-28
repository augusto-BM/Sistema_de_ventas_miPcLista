import './bootstrap';
import 'preline'

// Import Alpine JS para solucionar problema de wire:navigate falta inicializar en responsivo
document.addEventListener('livewire:navigated', () => {
  window.HSStaticMethods.autoInit();
});