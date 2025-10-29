const ghostImages = [
    '/img/fantasma.png',
    '/img/ghost.png',
    '/img/bats.png',
];

const maxGhosts = 3;
const ghosts = [];
let mouseX = window.innerWidth / 2;
let mouseY = window.innerHeight / 2;
let chasingGhost = null;
let lastChaseTime = 0; // track last time a ghost chased the cursor
const chaseCooldown = 30 * 1000; // 30 seconds cooldown

// Track mouse position
document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
});

function spawnGhost() {
    if (ghosts.length >= maxGhosts) return;

    const ghost = document.createElement('img');
    ghost.src = ghostImages[Math.floor(Math.random() * ghostImages.length)];
    ghost.className = 'ghost';

    // Fixed size
    ghost.style.width = '50px';
    ghost.style.height = '50px';

    // Random start position
    let posX = Math.random() * window.innerWidth;
    let posY = Math.random() * window.innerHeight;
    ghost.style.left = posX + 'px';
    ghost.style.top = posY + 'px';

    document.body.appendChild(ghost);
    ghosts.push(ghost);

    // Normal floating movement
    const floatSpeed = 0.5 + Math.random(); // px per frame
    let angle = Math.random() * Math.PI * 2;
    let chasing = false;

    const chaseSpeed = 0.03; // slow chase

    const moveGhost = () => {
        if (!chasing) {
            // Float in slow circular motion
            angle += 0.02;
            posX += Math.cos(angle) * floatSpeed;
            posY += Math.sin(angle) * floatSpeed;
        } else {
            // Move toward cursor slowly
            const dx = mouseX - posX;
            const dy = mouseY - posY;
            const distance = Math.sqrt(dx * dx + dy * dy);

            if (distance > 1) {
                posX += dx * chaseSpeed;
                posY += dy * chaseSpeed;
            }
        }

        ghost.style.left = posX + 'px';
        ghost.style.top = posY + 'px';
        ghost._animationFrame = requestAnimationFrame(moveGhost);
    };
    moveGhost();

    // Assign chase only if cooldown passed and no one else is chasing
    const chaseDelay = 3000 + Math.random() * 3000;
    setTimeout(() => {
        const now = Date.now();
        if (!chasingGhost && now - lastChaseTime >= chaseCooldown) {
            chasing = true;
            chasingGhost = ghost;
            lastChaseTime = now; // update last chase time
        }
    }, chaseDelay);

    // Remove ghost after 12 seconds max
    setTimeout(() => {
        cancelAnimationFrame(ghost._animationFrame);
        if (ghost.parentElement) ghost.remove();
        const index = ghosts.indexOf(ghost);
        if (index > -1) ghosts.splice(index, 1);
        if (chasingGhost === ghost) chasingGhost = null;
    }, 12 * 1000);
}

// Spawn ghosts every 3–6 seconds
setInterval(spawnGhost, 3000 + Math.random() * 3000);
