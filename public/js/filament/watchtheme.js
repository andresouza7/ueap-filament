// =============================
// 🎃 DARK THEME HALLOWEEN EFFECTS CONTROLLER
// =============================

import { spawnGhost, cancelGhosts } from './phantom.js'
import { playJumpscare, scheduleJumpscare as originalScheduleJumpscare, cancelJumpscare } from './jumpscare.js'

// =============================
// 🎃 Global State
// =============================
let ghostsInterval = null
let pumpkinButton = null
let lightThemePumpkin = null
let userInteracted = false
let jumpscareTimeout = null

// =============================
// 🔍 Observe Theme Changes
// =============================
const htmlEl = document.documentElement
const observer = new MutationObserver(() => {
    const isDark = htmlEl.classList.contains('dark')
    if (isDark) {
        enableHalloweenEffects()
    } else {
        disableHalloweenEffects()
    }
})
observer.observe(htmlEl, { attributes: true, attributeFilter: ['class'] })

// =============================
// 🧙‍♂️ Styles
// =============================
const style = document.createElement('style')
style.textContent = `
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
  text-align: center;
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
`
document.head.appendChild(style)

// =============================
// 🎃 Pumpkin Buttons
// =============================
function createDarkPumpkin() {
    pumpkinButton = document.createElement('div')
    pumpkinButton.className = 'pumpkin-button'
    pumpkinButton.innerHTML = `
        <div class="pumpkin-wrapper">
            <img src="/img/pumpkin.png" alt="Gift Pumpkin" class="pumpkin-img" />
            <div class="pumpkin-text">🎁 Clique para um<br>presente misterioso!</div>
        </div>
    `
    document.body.appendChild(pumpkinButton)

    pumpkinButton.addEventListener('click', () => {
        playJumpscare()
    })
}

function createLightPumpkin() {
    lightThemePumpkin = document.createElement('div')
    lightThemePumpkin.className = 'pumpkin-button'
    lightThemePumpkin.innerHTML = `
        <div class="pumpkin-wrapper" style="position: relative;">
            <button class="close-pumpkin" style="
                position: absolute;
                top: -10px;
                right: -10px;
                background: rgba(0,0,0,0.6);
                color: #fff;
                border: none;
                border-radius: 50%;
                width: 24px;
                height: 24px;
                cursor: pointer;
                font-weight: bold;
            ">×</button>
            <img src="/img/pumpkin.png" alt="Halloween Theme" class="pumpkin-img" />
            <div class="pumpkin-text">É tempo de Halloween<br>👻 Ative o tema! 👾</div>
        </div>
    `
    document.body.appendChild(lightThemePumpkin)

    // Close button
    const closeBtn = lightThemePumpkin.querySelector('.close-pumpkin')
    closeBtn.addEventListener('click', (e) => {
        e.stopPropagation() // evita disparar o clique do pumpkin
        lightThemePumpkin.remove()
    })

    // Click on pumpkin itself triggers dark mode
    lightThemePumpkin.addEventListener('click', () => {
        const darkBtn = document.querySelector('.fi-theme-switcher-btn[x-on\\:click*="dark"]')
        if (darkBtn) darkBtn.click()
        lightThemePumpkin.style.display = 'none'
    })
}


// =============================
// 🕯️ Effects Controller
// =============================
function enableHalloweenEffects() {
    console.log('🎃 Halloween mode enabled')

    // if (!pumpkinButton) createDarkPumpkin()
    // pumpkinButton.style.display = 'block'
    if (lightThemePumpkin) lightThemePumpkin.style.display = 'none'

    if (!ghostsInterval) ghostsInterval = setInterval(spawnGhost, 3000)

    // if (!userInteracted) {
    //     userInteracted = true
    //     jumpscareTimeout = scheduleJumpscare()
    // }
}

function disableHalloweenEffects() {
    console.log('💡 Halloween mode disabled')

    if (ghostsInterval) {
        clearInterval(ghostsInterval)
        ghostsInterval = null
    }

    cancelGhosts()

    if (pumpkinButton) pumpkinButton.style.display = 'none'
    if (!lightThemePumpkin) createLightPumpkin()
    lightThemePumpkin.style.display = 'block'

    if (jumpscareTimeout) {
        clearTimeout(jumpscareTimeout)
        jumpscareTimeout = null
    }

    cancelJumpscare()
    userInteracted = false
}

// =============================
// 🧠 Jumpscare Wrapper
// =============================
function scheduleJumpscare() {
    return originalScheduleJumpscare()
}

// =============================
// 🚀 Initialization
// =============================
if (htmlEl.classList.contains('dark')) {
    enableHalloweenEffects()
} else {
    if (!lightThemePumpkin) createLightPumpkin()
    lightThemePumpkin.style.display = 'block'
}

export { enableHalloweenEffects, disableHalloweenEffects }
