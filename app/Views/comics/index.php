<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/comics/create" class="btn btn-primary my-3">Tambah Komik</a>

            <?php if (session()->getFlashData('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashData('pesan') ?>
                </div>
            <?php endif ?>

            <h1 class="my-3">Daftar Komik</h1>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($comics as $c) : ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><img src="/img/<?= $c['sampul'] ?>" class="sampul"></td>
                            <td><?= $c['judul'] ?></td>
                            <td><a href="/comics/<?= $c['slug'] ?>" class="btn btn-success">Detail</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?= $this->endSection() ?>