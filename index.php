<?php
include('functions/db.php');
include('functions/create.func.php');
include('functions/read.func.php');
include('functions/update.func.php');
include('functions/delete.func.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Boostrap</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/bootstrap-icons/bootstrap-icons.css" />
</head>

<body>
    <main>
        <div class="container mt-5">
            <?php if (isset($message)): ?>
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="alert alert-warning bg-primary alert-dismissible fade show text-center text-white" role="alert">
                            <i class="bi bi-star"></i> <strong><?= $message ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            <?php endif ?>


            <div class="row">
                <div class="col-md-4">
                    <!-- Bouton pour ouvrir le modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#playerModal">
                        Ajouter un étudiant <i class="bi bi-person-circle"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="playerModal" tabindex="-1" aria-labelledby="playerModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="playerModalLabel">Ajouter un étudiant</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" enctype='multipart/form-data'>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                                <input type="text" class="form-control" name="nom_etudiant" id="playerName" placeholder="Nom Etudiant">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                <input type="text" class="form-control" name="prenom_etudiant" id="playerEmail" placeholder="Prenom Etudiant">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                                <input type="tel" class="form-control" name="matricule_etudiant" id="playerPhone" placeholder="Matricule Etudiant">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                                <input type="date" class="form-control" name="date_naissance_etudiant" id="playerDate" placeholder="Date Naissance Etudiant">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-image"></i></span>
                                                <input type="file" class="form-control" name="image_etudiant" id="playerDate">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-book"></i></span>
                                                <select class="form-control" name="id_promotion" required>
                                                    <?php foreach ($promotions as $promotion) : ?>
                                                        <option value="<?= $promotion->id_promotion ?>"><?= $promotion->faculte ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                                            <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form role="search">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-search"></i>
                                </span>
                            </div>
                            <input type="search" class="form-control" placeholder="Rechercher" aria-label="Search" aria-describedby="basic-addon1">
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-striped mt-4">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Nom Étudiant</th>
                                <th>Prénom</th>
                                <th>Matricule Étudiant</th>
                                <th>Promotion Étudiant</th>
                                <th>Date de Naissance</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($etudiants as $etudiant): ?>
                                <tr>
                                    <td><?= $etudiant->id_etudiant ?></td>
                                    <td><img src="assets/images/etudiants/<?= $etudiant->image_etudiant ?>" alt="<?= $etudiant->nom_etudiant ?>" style="max-width: 40px; max-height: 40px;" data-toggle="modal" data-target="#clientModal1"></td>
                                    <td><?= $etudiant->nom_etudiant ?></td>
                                    <td><?= $etudiant->prenom_etudiant ?></td>
                                    <td><?= $etudiant->matricule_etudiant ?></td>
                                    <td><?= $etudiant->id_promotion ?></td>
                                    <td><?= $etudiant->date_naissance_etudiant ?></td>
                                    <td>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#voirplayer-<?= $etudiant->id_etudiant ?>"><i class="bi bi-file-image"></i></button>
                                        <div class="modal fade" id="voirplayer-<?= $etudiant->id_etudiant ?>" tabindex="-1" aria-labelledby="playerModalLabel" aria-hidden="true">
                                            <div class="container">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="playerModalLabel">Voir un étudiant</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <img src="assets/images/etudiants/<?= $etudiant->image_etudiant ?>" alt="<?= $etudiant->nom_etudiant ?>" class="img img-thumbnail">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <!-- Voir un étudiant  -->
                                                                    <span><strong>Nom :</strong> <?= $etudiant->nom_etudiant ?></span><br>
                                                                    <span><strong>Prénom :</strong> <?= $etudiant->prenom_etudiant ?></span><br>
                                                                    <span><strong>Matricule :</strong> <?= $etudiant->matricule_etudiant ?></span><br>
                                                                    <span><strong>Date de Naissance :</strong> <?= $etudiant->date_naissance_etudiant ?></span><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                                                            <button type="button" class="btn btn-primary"><i class="bi bi-check-lg"></i> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editerplayer-<?= $etudiant->id_etudiant ?>"><i class="bi bi-pen"></i></button>
                                        <!-- Modal pen-->
                                        <div class="modal fade" id="editerplayer-<?= $etudiant->id_etudiant ?>" tabindex="-1" aria-labelledby="playerModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="playerModalLabel">Éditer un étudiant</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="id_etudiant" value="<?= $etudiant->id_etudiant ?>">
                                                            <div class="mb-3">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                                                    <input type="text" name="nom_etudiant" class="form-control" id="playerName" value="<?= $etudiant->nom_etudiant ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                                    <input type="text" name="prenom_etudiant" class="form-control" id="playerEmail" value="<?= $etudiant->prenom_etudiant ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                                                    <input type="tel" name="matricule_etudiant" class="form-control" id="playerPhone" value="<?= $etudiant->matricule_etudiant ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                                                    <input type="date" name="date_naissance_etudiant" class="form-control" value="<?= $etudiant->date_naissance_etudiant ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="bi bi-image"></i></span>
                                                                    <input type="file" class="form-control" name="image_etudiant" id="playerDate">
                                                                    <small class="form-text text-muted">
                                                                        <img src="assets/images/etudiants/<?= $etudiant->image_etudiant ?>" style="max-width: 110px; max-height: 30px;"></small>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="bi bi-book"></i></span>
                                                                    <select class="form-control" name="id_promotion" required>
                                                                        <?php foreach ($promotions as $promotion) : ?>
                                                                            <option value="<?= $promotion->id_promotion ?>" <?= ($promotion->id_promotion == $etudiant->id_promotion) ? 'selected' : '' ?>><?= $promotion->faculte ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                                                                <button type="submit" name="submitUpdate" class="btn btn-primary"><i class="bi bi-check-lg"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteplayer-<?= $etudiant->id_etudiant ?>"><i class="bi bi-trash"></i></button>
                                        <!-- Modal pen-->
                                        <div class="modal fade" id="deleteplayer-<?= $etudiant->id_etudiant ?>" tabindex="-1" aria-labelledby="playerModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="playerModalLabel">Supprimer un étudiant </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST">
                                                            <input type="hidden" name="id_etudiant" value="<?= $etudiant->id_etudiant ?>">
                                                            <div class="mb-3">
                                                                <h5>Etes-vous sûre de supprmer cet étudiant ? <i class="bi bi-exclamation-triangle-fill"></i> </h5>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                                                                <button type="submit" name="submitDelete" class="btn btn-primary"><i class="bi bi-check-lg"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>


</html>