# ♟️ Les Cavaliers de l'Apocalypse — Site Web du Club d'Échecs

Plateforme web dynamique développée pour la gestion et la valorisation du club d'échecs associatif **Les Cavaliers de l'Apocalypse** (fondé en 1994 et affilié FFE).

Projet d'application web dynamique développé avec PHP 8, MySQL et requêtes sécurisées PDO.

---

## 🎯 Fonctionnalités principales

### 1. Espace Vitrine & Communication
- **Page d'accueil (`index.html`)** : Présentation du club, citation inspirante et flux d'actualités récentes sous forme de cartes d'articles.
- **Pages d'articles détaillés (`page/articles/`)** : Couverture complète des événements (Tournoi d'Automne, stages, championnats, cours débutants).
- **Page Club & Membres (`page/club-member.html`)** : Historique associatif et tableau statique des membres fondateurs.
- **Formulaire de contact (`page/contact.html`)** : Formulaire responsive avec case à cocher conforme RGPD.
- **Pages légales & RGPD (`page/legal/`)** : Mentions légales et politique de confidentialité.

### 2. Gestion Dynamique des Membres (Back-end)
- **Consultation de la liste des membres (`membres.php`)** : Affichage dynamique des adhérents depuis la base MySQL avec leur identifiant FFE, classement ELO, classement Rapide et libellé de catégorie via une jointure SQL (`LEFT JOIN`).
- **Ajout d'un membre (`ajouter.php`)** : Formulaire dynamique avec liste déroulante alimentée par les catégories de la BDD, validation des champs et insertion sécurisée.

---

## 🛠️ Technologies & Outils

* **Front-end :** HTML5 sémantique, CSS3 (variables CSS, Flexbox, responsive design mobile/desktop).
* **Back-end :** PHP 8 (architecture modulaire procédurale avec `header.php`, `footer.php` et utilitaires).
* **Base de données :** MySQL / MariaDB avec connecteur **PDO**.
* **Sécurité :** Requêtes préparées systématiques contre les injections SQL (`PDO::prepare`) et assainissement des entrées (`htmlspecialchars`).
* **Environnement de test :** WampServer / XAMPP, phpMyAdmin.

---

## 🚀 Installation et Lancement en local

1. **Cloner le projet :**
   ```bash
   git clone https://github.com/TomVernierFetu/cavaliers-apocalypse-web.git
   ```
2. **Déplacer le dossier dans votre serveur local :**
   - WAMP : `C:\wamp64\www\cavaliers-apocalypse-web\`
   - XAMPP : `C:\xampp\htdocs\cavaliers-apocalypse-web\`
3. **Importer la base de données :**
   - Ouvrir phpMyAdmin (`http://localhost/phpmyadmin`).
   - Créer une base de données nommée `tvernierfetu` (ou adapter selon votre configuration).
   - Importer le fichier `bdd/bdd.sql` (ou `bdd/Sauvegarde/bdd_avec_donnees.sql`).
4. **Configurer les accès à la BDD :**
   - Vérifier le fichier `utils/settings.php` avec vos identifiants MySQL locaux :
     ```php
     return [
         "host" => "localhost",
         "dbname" => "tvernierfetu",
         "user" => "root",
         "password" => ""
     ];
     ```
5. **Accéder au site :**
   - Ouvrir votre navigateur sur `http://localhost/cavaliers-apocalypse-web/index.html` ou `http://localhost/cavaliers-apocalypse-web/membres.php`.

---

## 👤 Auteur

* **Tom Vernier-Fétu** — Développeur junior en recherche d'alternance.
