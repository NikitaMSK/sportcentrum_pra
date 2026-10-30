# Sportcentrum De Linde

Sportcentrum De Linde is een webapplicatie voor het bekijken van sportlessen en het beheren van reserveringen. De applicatie is gebouwd met Laravel.

## Benodigdheden

- PHP 8.3 of hoger
- Composer
- Node.js en npm
- MySQL

## Installatie

1. Open PowerShell in de projectmap en installeer de PHP-afhankelijkheden:

   ```powershell
   composer install
   ```

2. Maak het lokale configuratiebestand:

   ```powershell
   Copy-Item .env.example .env
   ```

3. Maak in MySQL een database aan, bijvoorbeeld `sportcentrumlinde`. Pas daarna de database-instellingen in `.env` aan:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sportcentrumlinde
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Vul bij `DB_USERNAME` en `DB_PASSWORD` de gegevens van je eigen MySQL-installatie in.

4. Genereer de applicatiesleutel en maak de tabellen met voorbeeldgegevens aan:

   ```powershell
   php artisan key:generate
   php artisan migrate --seed
   ```

5. Installeer de frontend-afhankelijkheden en bouw de bestanden:

   ```powershell
   npm install
   npm run build
   ```

6. Start de lokale webserver:

   ```powershell
   php artisan serve
   ```

   Open vervolgens [http://localhost:8000](http://localhost:8000) in je browser.

## De applicatie gebruiken

### Bezoekers en leden

- Op de startpagina (`/`) kun je het lesaanbod bekijken. Bij lessen met een video kun je op **Bekijk** klikken.
- Kies **Account aanmaken** om een account te registreren. Met een bestaand account kun je via **Inloggen** aanmelden.
- Via **Mijn reserveringen** kun je je reserveringen bekijken en annuleren.
- Gebruik **Uitloggen** om je account veilig af te sluiten.

### Trainers en beheerders

- Een trainer met een gekoppeld account kan via `/trainer/lessen` het rooster bekijken en deelnemers per les bekijken.
- Een beheerder met een geautoriseerd account kan via `/beheerder` het overzicht van komende lessen en deelnemers bekijken.
- Deze pagina's zijn alleen toegankelijk voor accounts die vooraf als trainer of beheerder zijn ingesteld. Er zijn geen standaard inloggegevens meegeleverd.

## Let op

De database-seeder voegt voorbeeldlessen toe. De pagina **Lessen** (`/lessen`) is momenteel nog niet gekoppeld aan de database en toont daarom geen lessen. Daardoor kan aanmelden voor een les via de website op dit moment nog niet worden afgerond.
