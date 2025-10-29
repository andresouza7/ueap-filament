const ghostImages = [
    '/img/fantasma.png',
    '/img/ghost.png',
    '/img/bats.png',
];

const maxGhosts = 3; // Maximum ghosts visible at once
const ghosts = []; // Track current ghosts

function spawnGhost() {
    // Don't spawn if max ghosts already present
    if (ghosts.length >= maxGhosts) return;

    const ghost = document.createElement('img');
    ghost.src = ghostImages[Math.floor(Math.random() * ghostImages.length)];
    ghost.className = 'ghost';

    // Random start position
    ghost.style.top = Math.random() * window.innerHeight + 'px';
    ghost.style.left = Math.random() * window.innerWidth + 'px';

    // Animation duration between 8-12 seconds for variety
    const duration = 10 + Math.random() * 2; 
    ghost.style.animationDuration = duration + 's';

    // Optional: random scale for variety
    const scale = 0.7 + Math.random() * 0.6;
    ghost.style.transform = `scale(${scale})`;

    document.body.appendChild(ghost);
    ghosts.push(ghost); // Add to tracking array

    // Remove ghost after animation
    setTimeout(() => {
        ghost.remove();
        const index = ghosts.indexOf(ghost);
        if (index > -1) ghosts.splice(index, 1);
    }, duration * 1000);
}

// Spawn a ghost every 2–5 seconds (fewer overall)
setInterval(spawnGhost, 2000 + Math.random() * 3000);
