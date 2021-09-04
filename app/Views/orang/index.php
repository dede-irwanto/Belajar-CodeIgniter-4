<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
        <div class="row">
                <div class="col">
                        <?php if (session()->getFlashData('pesan')) : ?>
                                <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashData('pesan') ?>
                                </div>
                        <?php endif ?>

                        <h1 class="my-3">Daftar Orang</h1>
                        <form action="" method="POST">
                                <div class="input-group mb-3">
                                        <input type="text" name="keyword" class="form-control" placeholder="Masukkan keyword pencarian" aria-label="Masukkan keyword pencarian" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                                </div>
                        </form>
                        <table class="table mt-3">
                                <thead>
                                        <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Alamat</th>
                                                <th scope="col">Aksi</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php $no = 1 + ($perHalaman * ($currentPage - 1)) ?>
                                        <?php foreach ($orang as $c) : ?>
                                                <tr>
                                                        <th scope="row"><?= $no++ ?></th>
                                                        <td><?= $c['nama'] ?></td>
                                                        <td><?= $c['alamat'] ?></td>
                                                        <td><a href="" class="btn btn-success">Detail</a></td>
                                                </tr>
                                        <?php endforeach ?>
                                </tbody>
                        </table>
                        <?= $pager->links('orang', 'orang_pagination') ?>
                </div>
        </div>
</div>

<?= $this->endSection() ?>