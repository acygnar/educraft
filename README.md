# Educraft Boilerplate (WordPress)

Boilerplate motywu WordPress z:
- SCSS (`_src/scss`) i strukturą Atomic Design (`atoms`, `molecules`, `organisms`)
- wspólnym plikiem `style.scss` z importami (`@use`)
- JS modułowym (`_src/js/main.js` + importy)
- katalogiem `_src/img` na grafiki dev
- BrowserSync live reload

## Start

1. Wejdź do katalogu motywu:
   `cd wp-content/themes/educraft-boilerplate`
2. Zainstaluj zależności:
   `npm install`
3. Skopiuj `.env.example` do `.env` i ustaw `WP_URL` (adres lokalnej strony WP).
4. Tryb dev (watch + BrowserSync):
   `npm run dev`
5. Build produkcyjny:
   `npm run build`

## Struktura

_src/
- scss/
  - style.scss
  - abstracts/
  - base/
  - atoms/
  - molecules/
  - organisms/
- js/
  - main.js
  - modules/
- img/

assets/
- css/style.css
- js/main.js
- img/
