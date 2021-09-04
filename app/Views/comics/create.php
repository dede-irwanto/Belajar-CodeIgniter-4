<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-8 my-3">
            <h2 my-3>Form Tambah Data Komik</h2>

            <form action="/comics/save" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : '' ?>" name="judul" value="<?= old('judul') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('judul') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : '' ?>" name="penulis" value="<?= old('penulis') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('penulis') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : '' ?>" name="penerbit" value="<?= old('penerbit') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('penerbit') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/default.png" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : '' ?>" id="sampul" name="sampul" onchange="previewImg()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('sampul') ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>