<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="application-name" content="Too Long To Read"/>
    <meta name="author" content="<?=$author?>"/>
    <meta name="description" content="<?=$description?>"/>
    <meta name="keywords" content="<?=$keywords?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?=htmlspecialchars($title)?> | Too Long To Read</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css"/>
</head>
<body>
    <header>
        <a href="/"><img src="" alt="Logo de Too Long To Read" title="Revenir à l'accueil"/></a>
        <nav>
            <ul>
                <li><a href="trends">Tendances</a></li>
                <li><a href="recommendations">Suggestions</a></li>
                <li><a href="team">L'équipe</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <?=$content?>
    </main>
    <footer>
        <div>
            <?php if (isset($lastBookId)): ?>
                <a href="/book/<?=$lastBookId?>">Accéder au dernier livre consulté sur le site</a>
            <?php endif; ?>
            <a href="https://www.cyu.fr/" title="CY Cergy Paris Université - S'ouvre dans un nouvel onglet">
                <img src="/images/logo_cy.png" alt="Logo de CY Cergy Paris Université"/>
            </a>
            <span>Auteurs : Thomas REMY, Andrea DE ARAUJO</span>
        </div>
    </footer>
</body>
</html>