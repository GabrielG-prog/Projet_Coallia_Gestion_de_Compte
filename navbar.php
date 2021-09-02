<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">
        <img src="./images/coallia-squarelogo-1408465071664.png" width="30" height="30" class="d-inline-block align-top"
            alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Comptes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="history.php">Historiques</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><span data-feather="filter"></a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="filterAll.php">Tous les comptes</a>
                    <a class="dropdown-item" href="filterNot.php">Aucun comptes</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="filterOscar.php">OSCAR</a>
                    <a class="dropdown-item" href="filterGraal.php">GRAAL</a>
                    <a class="dropdown-item" href="filterBap.php">BAP</a>
                    <a class="dropdown-item" href="filterIgloo.php">IGLOO</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html"><span data-feather="power"></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Matricule, Nom ou Prenom" name="search"
                aria-label="Search">
            <input class="btn btn-outline-default my-2 my-sm-0 click" name="sub" type="submit" value="Rechercher">
        </form>
    </div>
</nav>