<!DOCTYPE html>

<nav class="navbar navbar-expand-lg navbar-light navbarz">
    <a class="navbar-brand mainlogoname" href="index.php">RecruitGuru</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"><?php include "./auth-stub.php"; ?></a>
            </li>
        </ul>
    </div>
</nav>