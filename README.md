# Too Long To Read

Too Long To Read est un projet réalisé en binôme dans le cadre de l'UE de développement web en L2 Informatique à [CY Cergy Paris Université](https://www.cyu.fr/formation/trouver-sa-formation/catalogue-des-formations/licence-informatique) durant l'année 2022/2023. Le but de ce projet est la validation des compétences acquises durant l'UE, soit la conception et le développement d'un site web en [PHP](https://www.php.net/) utilisant une ou plusieurs API(s).

## Technologies utilisées

Too Long To Read est ainsi un site web permettant la recherche d'informations sur des livres et auteurs. Le site s'appuie sur l'utilisation des APIs de [Google Books](https://developers.google.com/books) et [Open Library](https://openlibrary.org/).

Le site web est développé en PHP et utilise le microframework [Slim](https://www.slimframework.com/). De petits wrappers ont été développés afin de faciliter l'utilisation des APIs précédemment mentionnées.

## Installation

Afin de faciliter le test de l'application, cette dernière a été conteneurisée et les images sont disponibles [ici](https://github.com/GzIrYsz/too-long-to-read/pkgs/container/too-long-to-read).

La dernière image disponible peut être récupérée via un client docker avec la commande suivante :

```bash
docker pull ghcr.io/gzirysz/too-long-to-read:latest
```

Un conteneur exécutant l'application peut être lancé avec la commande suivante :

```bash
docker run --rm -d \
  -p 80:80 \
  -e GOOGLEAPI_TOKEN="your_token" \
  ghcr.io/gzirysz/too-long-to-read:latest
```

Un conteneur peut également être créé grâce à Docker Compose. Voici un exemple de configuration :

```yaml
services:
  tltr:
    image: ghcr.io/gzirysz/too-long-to-read:latest
    container_name: too-long-to-read
    ports:
      - "80:80"
    environment:
      GOOGLEAPI_TOKEN: 'your_token'
```

La commande suivante doit ensuite être exécutée depuis le répertoire contenant le fichier `docker-compose.yml` afin de démarrer le conteneur.

```bash
docker compose up -d
```

### Environnement

Les variables d'environnement présentées ci-dessous sont toutes obligatoires pour un bon fonctionnement de l'application.

| Variable          | Default    | Description                                      |
|-------------------|------------|--------------------------------------------------|
| `NASA_TOKEN`      | `DEMO_KEY` | La clé d'API utilisée pour l'affichage de l'APOD |
| `GOOGLEAPI_TOKEN` | non défini | La clé d'API utilisée par Google Books           |

## Auteurs

[@Thomas REMY](https://github.com/gzirysz), [@Andrea DE ARAUJO](https://github.com/AndreaDeAraujo)