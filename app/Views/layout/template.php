<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <!-- My CSS -->
  <link rel="stylesheet" href="/css/style.css">

  <!-- Font -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

    * {font-family: 'Roboto', sans-serif;}
  </style>

  <title><?= $title ?> | Belajar CodeIgniter 4</title>
</head>

<?= $this->include('layout/navbar') ?>

<?= $this->renderSection('content') ?>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script>
  function previewImg() {
    const sampul = document.querySelector('#sampul');
    const imgPreview = document.querySelector('.img-preview');

    const fileSampul = new FileReader();
    fileSampul.readAsDataURL(sampul.files[0]);

    fileSampul.onload = function(e) {
      imgPreview.src = e.target.result;
    }
  }
</script>
</body>

</html>