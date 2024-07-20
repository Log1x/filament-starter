/** @type {import('tailwindcss').Config} */

module.exports = {
  presets: [
    require('./tailwind.config'),
    require('./vendor/filament/filament/tailwind.config.preset'),
  ],
  content: [
    './app/Filament/**/*.php',
    './resources/views/components/logo.blade.php',
    './resources/views/filament/**/*.blade.php',
    './vendor/awcodes/filament-curator/resources/**/*.blade.php',
    './vendor/bezhansalleh/filament-exceptions/resources/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
    './vendor/jeffgreco13/filament-breezy/resources/**/*.blade.php',
    './vendor/pboivin/filament-peek/resources/views/**/*.blade.php',
  ],
}
