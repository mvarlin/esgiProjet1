# Projet Streemi - Plateforme de Streaming  

## **Résumé de l'application**  
Streemi est un site de streaming en ligne offrant un catalogue varié de films et séries accessible via un abonnement payant. Inspiré de plateformes comme Netflix et Prime Vidéo, Streemi propose une interface moderne, une expérience utilisateur fluide, et un système de paiement sécurisé via Stripe. Le projet intègre une gestion avancée des contenus et vise à offrir une expérience complète à ses utilisateurs.  

---

## **Architecture Docker**  

### **Dockerfile**  
Le fichier `Dockerfile` configure un environnement PHP 8.3 optimisé pour exécuter l’application Symfony.

### **Docker Compose**  
Le fichier `docker-compose.yml` orchestre trois services : Symfony, MySQL, et Nginx.  

### **Nginx**  
Le dossier `nginx` \ `default.conf` contient la configuration Nginx.

---

## **Variables d’environnement**  
Ajoutez la variable suivante dans un fichier .env à la racine du projet pour configurer les services :  

```env
MYSQL_ROOT_PASSWORD=votremotdepasse
```

---

## **Installation et initialisation**  

### **Étape 1 : Construire et démarrer les conteneurs**  
Exécutez les commandes suivantes :  

```bash
docker-compose up -d --build
```

### **Étape 2 : Installer les dépendances Symfony**  
Une fois les conteneurs démarrés, accédez au conteneur Symfony et installez les dépendances :  

```bash
docker exec -it <nom_du_conteneur_symfony> bash
composer install
```

### **Étape 3 : Créer et initialiser la base de données**  
Exécutez les commandes suivantes pour créer la base de données et y charger les données initiales :  

```bash
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console hautelook:fixtures:load
```

---

## **Accès à l'application**  

- **Interface utilisateur :** L’application est accessible sur `http://localhost:8080`.  
- **MySQL :** Disponible sur le port `3306` (`localhost` pour les connexions locales).  
---