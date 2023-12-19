import preset from './vendor/filament/filament/tailwind.config.preset'
import defaultConfig from './tailwind.config'

export default {
  presets: [preset, defaultConfig],
  content: [
    './app/Filament/**/*.php',
    './resources/views/filament/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
  ],
}
