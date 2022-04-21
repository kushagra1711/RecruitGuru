<!DOCTYPE html>

<div class="navbarz">
    <nav class="navbar navbar-expand-lg navbar-light navbarz">
        <a class="navbar-brand" href="index.php"> <span class="mainlogoname"> RecruitGuru</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li><a class="nav-link nav-item" href="index.php">HOME <span class="sr-only">(current)</span></a></li>
                <li><a class="nav-link nav-item"><?php include "./auth-stub.php"; ?></a></li>
            </ul>
        </div>
    </nav>
</div>