// =============================
// 👻 GHOST SPAWNING LOGIC
// =============================
const ghostImages = [
    '/img/fantasma.png',
    '/img/ghost.png',
    '/img/bats.png',
]

const maxGhosts = 3
const ghosts = []
const ghostTimeouts = []
let mouseX = window.innerWidth / 2
let mouseY = window.innerHeight / 2
let chasingGhost = null
let lastChaseTime = 0
const chaseCooldown = 30 * 1000

document.addEventListener('mousemove', e => {
    mouseX = e.clientX
    mouseY = e.clientY
})

export function spawnGhost() {
    if (ghosts.length >= maxGhosts) return

    const ghost = document.createElement('img')
    ghost.src = ghostImages[Math.floor(Math.random() * ghostImages.length)]
    ghost.className = 'ghost'
    ghost.style.width = '50px'
    ghost.style.height = '50px'

    let posX = Math.random() * window.innerWidth
    let posY = Math.random() * window.innerHeight
    ghost.style.left = posX + 'px'
    ghost.style.top = posY + 'px'
    document.body.appendChild(ghost)
    ghosts.push(ghost)

    let angle = Math.random() * Math.PI * 2
    let chasing = false
    const floatSpeed = 0.5 + Math.random()
    const chaseSpeed = 0.03

    const moveGhost = () => {
        if (!chasing) {
            angle += 0.02
            posX += Math.cos(angle) * floatSpeed
            posY += Math.sin(angle) * floatSpeed
        } else {
            const dx = mouseX - posX
            const dy = mouseY - posY
            const distance = Math.sqrt(dx*dx + dy*dy)
            if (distance > 1) {
                posX += dx * chaseSpeed
                posY += dy * chaseSpeed
            }
        }
        ghost.style.left = posX + 'px'
        ghost.style.top = posY + 'px'
        ghost._animationFrame = requestAnimationFrame(moveGhost)
    }
    moveGhost()

    const chaseDelay = 3000 + Math.random() * 3000
    const chaseTimeout = setTimeout(() => {
        const now = Date.now()
        if (!chasingGhost && now - lastChaseTime >= chaseCooldown) {
            chasing = true
            chasingGhost = ghost
            lastChaseTime = now
        }
    }, chaseDelay)
    ghostTimeouts.push(chaseTimeout)

    const removeTimeout = setTimeout(() => {
        cancelAnimationFrame(ghost._animationFrame)
        if (ghost.parentElement) ghost.remove()
        const index = ghosts.indexOf(ghost)
        if (index > -1) ghosts.splice(index, 1)
        if (chasingGhost === ghost) chasingGhost = null
    }, 12*1000)
    ghostTimeouts.push(removeTimeout)
}

// =============================
// 🛑 Cancel all ghosts
// =============================
export function cancelGhosts() {
    ghosts.forEach(g => {
        if (g._animationFrame) cancelAnimationFrame(g._animationFrame)
        if (g.parentElement) g.remove()
    })
    ghosts.length = 0

    ghostTimeouts.forEach(t => clearTimeout(t))
    ghostTimeouts.length = 0

    chasingGhost = null
}
