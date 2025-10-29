// =============================
// 🎃 DARK THEME HALLOWEEN EFFECTS CONTROLLER
// =============================

import { spawnGhost } from './phantom.js';
import { playJumpscare, scheduleJumpscare } from './jumpscare.js';

// Global state
let halloweenEnabled = false;
let ghostsInterval = null;
let pumpkinButton = null;
let userInteracted = false;

// Observe changes to the <html> class attribute
const htmlEl = document.documentElement;
const observer = new MutationObserver(() => {
  const isDark = htmlEl.classList.contains('dark');
  if (isDark && !halloweenEnabled) {
    enableHalloweenEffects();
    halloweenEnabled = true;
  } else if (!isDark && halloweenEnabled) {
    disableHalloweenEffects();
    halloweenEnabled = false;
  }
});
observer.observe(htmlEl, { attributes: true, attributeFilter: ['class'] });

// =============================
// 🧙‍♂️ Style Definitions
// =============================
const style = document.createElement('style');
style.textContent = `
/* Bouncing + glowing pumpkin */
.pumpkin-button {
  position: fixed;
  bottom: 30px;
  right: 30px;
  z-index: 1000;
  cursor: pointer;
  text-align: center;
  user-select: none;
  display: none;
}

.pumpkin-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  animation: floaty-bounce 2s infinite ease-in-out, glow-flicker 3s infinite alternate;
  filter: drop-shadow(0 0 6px rgba(255,140,0,0.7));
}

.pumpkin-img {
  width: 140px;
  height: 70px;
  transition: transform 0.2s ease;
}

.pumpkin-button:hover .pumpkin-img {
  transform: scale(1.1) rotate(-3deg);
}

.pumpkin-text {
  font-family: 'Creepster', sans-serif;
  font-weight: bold;
  font-size: 0.8rem !important;
  color: #ffa93a;
  text-shadow: 0 0 6px rgba(255,150,0,0.8);
  background: rgba(20, 10, 0, 0.6);
  padding: 4px 10px;
  border-radius: 6px;
  border: 1px solid rgba(255,140,0,0.3);
  box-shadow: 0 0 6px rgba(255, 90, 0, 0.4);
}

@keyframes floaty-bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

@keyframes glow-flicker {
  0%, 100% { filter: drop-shadow(0 0 6px rgba(255,120,0,0.6)); }
  50% { filter: drop-shadow(0 0 12px rgba(255,180,0,0.9)); }
}
`;
document.head.appendChild(style);


// =============================
// 🎃 Pumpkin Button Setup
// =============================
function createPumpkinButton() {
  pumpkinButton = document.createElement('div');
  pumpkinButton.className = 'pumpkin-button';
  pumpkinButton.innerHTML = `
    <div class="pumpkin-wrapper">
      <img src="/img/pumpkin.png" alt="Gift Pumpkin" class="pumpkin-img" />
      <div class="pumpkin-text">🎁 Clique para um<br>presente misterioso!</div>
    </div>
  `;
  document.body.appendChild(pumpkinButton);

  pumpkinButton.addEventListener('click', () => {
    if (!userInteracted) {
      userInteracted = true;
      scheduleJumpscare(); // start auto jumpscares
    }
    playJumpscare(); // immediate jumpscare
  });
}

// =============================
// 🕯️ Activate / Deactivate Effects
// =============================
function enableHalloweenEffects() {
  console.log('🎃 Halloween mode enabled');
  
  if (!pumpkinButton) createPumpkinButton();
  pumpkinButton.style.display = 'block';

  // Spawn ghosts every 3–6 seconds
  ghostsInterval = setInterval(spawnGhost, 3000 + Math.random() * 3000);
}

function disableHalloweenEffects() {
  console.log('💡 Halloween mode disabled');

  // Stop ghost spawning
  clearInterval(ghostsInterval);
  ghostsInterval = null;

  // Hide pumpkin
  if (pumpkinButton) pumpkinButton.style.display = 'none';

  // Remove all ghosts
  document.querySelectorAll('.ghost').forEach(g => g.remove());
}

export { enableHalloweenEffects, disableHalloweenEffects };
