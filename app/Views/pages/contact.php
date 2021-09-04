<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container">
  <div class="row">
    <div class="col">
      <?php foreach($contact as $contact): ?>
        <ul>
          <li><?= $contact['hp'] ?></li>
          <li><?= $contact['email'] ?></li>
          <li><?= $contact['facebook'] ?></li>
        </ul>
        <?php endforeach ?>
      </div>
    </div>
</div>

<?= $this->endSection() ?>