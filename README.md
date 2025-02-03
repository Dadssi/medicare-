# Medicare - Gestion de Cabinet Médical

## 📌 Description

**Medicare** est une application web développée en **PHP** avec une architecture **MVC** et une base de données **PostgreSQL**. Elle permet la gestion efficace des patients, médecins et rendez-vous dans un cabinet médical.

## 🚀 Fonctionnalités Principales

### 🔹 **Front Office**
- Inscription et connexion des patients et médecins
- Prise de rendez-vous en ligne
- Consultation de l'historique des consultations

### 🔹 **Back Office**
- Gestion des utilisateurs (patients, médecins, administrateurs)
- Gestion des rendez-vous (confirmation, annulation)
- Tableau de bord avec statistiques

### 🔹 **Autres Fonctionnalités**
- Sécurité renforcée (validation côté serveur, protection contre XSS et CSRF)
- Notifications par email pour les rappels de rendez-vous
- Génération de certificats de suivi médical
- Intégration d'un calendrier interactif

## 🛠️ Stack Technique
- **Langage** : PHP (OOP)
- **Base de données** : PostgreSQL
- **Architecture** : MVC
- **Gestion des dépendances** : Composer
- **Moteur de templates** : Twig
- **Système de routage dynamique**
- **Sécurité** : Protection contre injections SQL, XSS, CSRF

## 📂 Structure du Projet

```
medical-cabinet/
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Services/
│   ├── Repositories/
│   ├── Middleware/
│   └── Helpers/
├── config/
├── public/
│   ├── assets/
│   └── index.php
├── resources/
│   ├── views/
│   └── templates/
├── routes/
├── storage/
│   ├── logs/
│   └── uploads/
├── tests/
├── .htaccess
├── composer.json
└── docker-compose.yml
```

## 🚀 Installation

### 📌 Prérequis
- PHP 8+
- PostgreSQL
- Composer
- Serveur Apache avec mod_rewrite activé

### 📥 Étapes d'installation

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/votre-utilisateur/medicare.git
   cd medicare
   ```
2. **Installer les dépendances**
   ```bash
   composer install
   ```
3. **Configurer la base de données**
   - Créer une base de données PostgreSQL
   - Mettre à jour `config/database.php`

4. **Lancer le serveur**
   ```bash
   php -S localhost:8000 -t public
   ```

## 🛡️ Sécurité
- Utilisation de requêtes préparées pour éviter les injections SQL
- Validation des entrées utilisateur (côté client et serveur)
- Gestion des sessions sécurisées


## ✨ Contribuer
Les contributions sont les bienvenues !
1. Forker le projet
2. Créer une branche (`feature/amélioration`)
3. Committer vos modifications
4. Ouvrir une pull request

## 📬 Contact
- **Développeur** : [Dadssi Mohamed Abdelhak](https://github.com/Dadssi)
- **Email** : d4dssi@gmail.com

