# Symfony CRUD Application

Questa è una semplice applicazione CRUD (Create, Read, Update, Delete) sviluppata con il framework Symfony. L'applicazione permette di creare, visualizzare, aggiornare e cancellare post.

## Requisiti

- PHP >= 7.4
- Composer
- Symfony CLI
- Un database (es. MySQL)

## Installazione

1. Clona il repository

```bash
git clone https://github.com/tuo-username/tuo-repo.git
cd tuo-repo

```
## 2 Installa le dipendenze
```bash
composer install

```
## 3 Configura il database
Modifica il file .env per configurare la connessione al tuo database:
```bash
DATABASE_URL="mysql://username:password@127.0.0.1:3306/nome_database?serverVersion=5.7"

```
## 4 Esegui le migrazioni del database
```bash
php bin/console doctrine:migrations:migrate

```
## 5 Avvia il server di sviluppo
```bash
symfony server:start

```
# Struttura del Progetto
- src/Controller/MainController.php: Contiene i controller per gestire le operazioni CRUD sui post.
- src/Entity/Post.php: Entità Post che rappresenta un post nel database.
- src/Form/PostType.php: Definisce il form per creare e aggiornare i post.
- templates/base.html.twig: Template di base per il layout dell'applicazione.
- templates/main/index.html.twig: Template per la visualizzazione della lista dei post.
- templates/main/post.html.twig: Template per il form di creazione e aggiornamento dei post.

# Utilizzo
## Visualizzare i Post
Visita l'URL principale dell'applicazione (es. http://localhost:8000/) per vedere la lista dei post.

## Creare un Post
Visita l'URL http://localhost:8000/create-post per creare un nuovo post.

## Aggiornare un Post
Visita l'URL http://localhost:8000/edit-post/{id} dove {id} è l'ID del post che vuoi aggiornare.

## Cancellare un Post
Visita l'URL http://localhost:8000/delete-post/{id} dove {id} è l'ID del post che vuoi cancellare.

## Contributi
Le richieste di pull sono benvenute. Per modifiche maggiori, apri prima un issue per discutere cosa vorresti cambiare.

Assicurati di aggiornare i test se necessario.

