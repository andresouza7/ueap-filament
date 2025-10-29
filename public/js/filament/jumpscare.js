const jumpscareVideos = [
  '/video/jumpscare1.mp4',
  '/video/jumpscare2.mp4',
  '/video/jumpscare3.mp4',
  '/video/jumpscare4.mp4',
];

let isJumpscareActive = false;
let userInteracted = false;

// Wait for first user click before enabling jumpscares
document.addEventListener('click', () => {
  if (!userInteracted) {
    userInteracted = true;
    console.log('User interaction registered — jumpscares enabled');
    scheduleJumpscare(); // Start scheduling only after user interaction
  }
}, { once: true });

function playJumpscare() {
  if (!userInteracted || isJumpscareActive) return;
  isJumpscareActive = true;

  const video = document.createElement('video');
  video.src = jumpscareVideos[Math.floor(Math.random() * jumpscareVideos.length)];
  video.className = 'jumpscare-video';
  video.autoplay = true;
  video.playsInline = true;
  video.style.position = 'fixed';
  video.style.top = 0;
  video.style.left = 0;
  video.style.width = '100vw';
  video.style.height = '100vh';
  video.style.objectFit = 'cover';
  video.style.zIndex = 999999;
  video.style.background = 'black';
  video.style.display = 'none';

  document.body.appendChild(video);

  // Start muted, then unmute a bit later (so autoplay isn’t blocked)
  video.muted = true;
  video.play().then(() => {
    video.style.display = 'block';
    setTimeout(() => (video.muted = false), 500);
  }).catch(err => console.warn('Video playback blocked:', err));

  // Remove video after playback
  video.addEventListener('ended', () => {
    video.classList.add('fade-out');
    setTimeout(() => {
      video.remove();
      isJumpscareActive = false;
    }, 1000);
  });
}

// Trigger randomly between 40–90 seconds
function scheduleJumpscare() {
  const delay = 40000 + Math.random() * 50000;
  setTimeout(() => {
    playJumpscare();
    scheduleJumpscare(); // Schedule next one recursively
  }, delay);
}
