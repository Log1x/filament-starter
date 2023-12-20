import preset from './vendor/filament/filament/tailwind.config.preset'
import defaultConfig from './tailwind.config'

export default {
  presets: [preset, defaultConfig],
  content: [
    './app/Filament/**/*.php',
    './resources/views/filament/**/*.blade.php',
    './vendor/awcodes/filament-curator/resources/**/*.blade.php',
    './vendor/bezhansalleh/filament-exceptions/resources/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
    './vendor/jeffgreco13/filament-breezy/resources/**/*.blade.php',
    './vendor/pboivin/filament-peek/resources/views/**/*.blade.php',
  ],
}
