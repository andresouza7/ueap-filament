import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/PortalTransparencia/**/*.php',
        './resources/views/filament/portal-transparencia/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
