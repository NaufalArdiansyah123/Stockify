import './bootstrap';
import 'flowbite';

// Dark mode toggle (persist with localStorage)
document.addEventListener('DOMContentLoaded', () => {
  const html = document.documentElement;
  const saved = localStorage.getItem('theme');
  if (saved === 'dark') html.classList.add('dark');
  if (saved === 'light') html.classList.remove('dark');

  const toggles = document.querySelectorAll('[data-toggle-theme]');
  toggles.forEach(btn => btn.addEventListener('click', () => {
    html.classList.toggle('dark');
    localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
  }));
});
