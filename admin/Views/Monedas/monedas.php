<?php
    headerAdmin($data);
    getModal('modalMonedas',$data);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa-solid fa-coins"></i> <?= $data['page_title']; ?>
                <button class="btn btn-primary" onclick="openModal()" type="button"><i class="fas fa-plus-circle"></i> Nuevo</button>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url() ?>/usuarios"><?= $data['page_title']; ?></a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableMonedas">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Valor monetario</th>
                                    <th>Familia</th>
                                    <th>Presentación</th>
                                    <th>Decreto</th>
                                    <th>Fecha de circulación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php
    footerAdmin($data);
?>