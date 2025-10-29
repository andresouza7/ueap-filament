// =============================
// 😱 JUMPSCARE LOGIC
// =============================
const jumpscareVideos = [
  '/video/jumpscare1.mp4',
  '/video/jumpscare2.mp4',
  '/video/jumpscare3.mp4',
  '/video/jumpscare4.mp4',
];

let isJumpscareActive = false;
let jumpscareTimeoutId = null;

// Play a jumpscare immediately
export function playJumpscare() {
  if (isJumpscareActive) return;
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
    setTimeout(() => video.muted = false, 500);
  }).catch(err => console.warn('Playback blocked:', err));

  video.addEventListener('ended', () => {
    video.classList.add('fade-out');
    setTimeout(() => {
      video.remove();
      isJumpscareActive = false;
    }, 1000);
  });
}

// Schedule repeated jumpscares
export function scheduleJumpscare() {
  cancelJumpscare(); // clear any previous
  const delay = 40000 + Math.random() * 50000;
  jumpscareTimeoutId = setTimeout(() => {
    playJumpscare();
    scheduleJumpscare(); // schedule next
  }, delay);
}

// Cancel scheduled jumpscares
export function cancelJumpscare() {
  if (jumpscareTimeoutId) {
    clearTimeout(jumpscareTimeoutId);
    jumpscareTimeoutId = null;
  }
}

// Styles
const style = document.createElement('style');
style.textContent = `
.jumpscare-video {
  position: fixed;
  top:0; left:0;
  width:100vw; height:100vh;
  object-fit: cover;
  z-index: 9999999;
  background: black;
}
.fade-out {
  opacity:0;
  transition: opacity 1s ease-out;
}`;
document.head.appendChild(style);
