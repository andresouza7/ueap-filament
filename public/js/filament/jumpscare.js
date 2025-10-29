const jumpscareVideos = [
  '/video/jumpscare1.mp4',
  '/video/jumpscare2.mp4',
  '/video/jumpscare3.mp4',
];

let isJumpscareActive = false;
let userInteracted = false;

// =============================
// 🎃 Floating “Gift Pumpkin” Button
// =============================
const pumpkinButton = document.createElement('div');
pumpkinButton.className = 'pumpkin-button';
pumpkinButton.innerHTML = `
  <div class="pumpkin-wrapper">
    <img src="/img/pumpkin.png" alt="Gift Pumpkin" class="pumpkin-img" />
    <div class="pumpkin-text">🎁 Clique para um<br>presente misterioso!</div>
  </div>
`;
document.body.appendChild(pumpkinButton);

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
  font-size: 15px;
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

/* ============================= */
/* 😱 Jumpscare Video Styles     */
/* ============================= */
.jumpscare-video {
  position: fixed;
  top: 0; left: 0;
  width: 100vw; height: 100vh;
  object-fit: cover;
  z-index: 9999;
  background: black;
}

.fade-out {
  opacity: 0;
  transition: opacity 1s ease-out;
}
`;
document.head.appendChild(style);

// =============================
// 😱 Jumpscare Logic
// =============================
function playJumpscare() {
  if (!userInteracted || isJumpscareActive) return;
  isJumpscareActive = true;

  const video = document.createElement('video');
  video.src = jumpscareVideos[Math.floor(Math.random() * jumpscareVideos.length)];
  video.className = 'jumpscare-video';
  video.autoplay = true;
  video.playsInline = true;
  video.muted = true;
  video.style.display = 'none';

  document.body.appendChild(video);

  video.play().then(() => {
    video.style.display = 'block';
    setTimeout(() => (video.muted = false), 500);
  }).catch(err => console.warn('Playback blocked:', err));

  video.addEventListener('ended', () => {
    video.classList.add('fade-out');
    setTimeout(() => {
      video.remove();
      isJumpscareActive = false;
    }, 1000);
  });
}

// =============================
// ⏰ Random Automatic Jumpscares
// =============================
function scheduleJumpscare() {
  const delay = 40000 + Math.random() * 50000;
  setTimeout(() => {
    playJumpscare();
    scheduleJumpscare();
  }, delay);
}

// Enable system after user interacts
document.addEventListener('click', () => {
  if (!userInteracted) {
    userInteracted = true;
    scheduleJumpscare();
  }
}, { once: true });

// 🎃 Clicking pumpkin triggers instant jumpscare
pumpkinButton.addEventListener('click', () => {
  if (!userInteracted) {
    userInteracted = true;
    scheduleJumpscare();
  }
  playJumpscare();
});
