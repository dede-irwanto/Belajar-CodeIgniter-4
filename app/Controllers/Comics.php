<?php

namespace App\Controllers;

use App\Models\ComicModel;

use CodeIgniter\Exceptions\PageNotFoundException as pageNotFound;

class Comics extends BaseController
{
    protected $comicModel;

    private $rule_judul;

    public function __construct()
    {
        $this->comicModel = new ComicModel();
    }

    public function index()
    {
        $comic = $this->comicModel->findAll();

        $data = [
            'title' => 'Daftar Komik',
            'comics' => $comic,
        ];

        return view('comics/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'comic' => $this->comicModel->getComic($slug)
        ];

        if (empty($data['comic'])) {
            throw new pageNotFound('Judul komik ' . $slug . ' tidak ditemukan!');
        }

        return view('comics/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik',
            'validation' => \Config\Services::validation()
        ];

        return view('comics/create', $data);
    }

    public function save()
    {
        // validasi input
        $this->rule_judul = 'required|is_unique[comics.judul]';
        if (!$this->validasi()) {
            return redirect()->to('/comics/create')->withInput();
        }

        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {
            // generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            // upload gambar
            $fileSampul->move('img', $namaSampul);
        }


        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->comicModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashData('pesan', 'Data berhasil ditambahkan!');

        return redirect()->to('/comics');
    }

    public function delete($id)
    {
        // cari file berdasarkan id
        $comic = $this->comicModel->find($id);

        // cek gambar default.png
        if ($comic['sampul'] != 'default.png') {
            // hapus gambar
            unlink('img/' . $comic['sampul']);
        }

        $this->comicModel->delete($id);
        session()->setFlashData('pesan', 'Data berhasil dihapus!');
        return redirect()->to('/comics');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Data Komik',
            'validation' => \Config\Services::validation(),
            'comic' => $this->comicModel->getComic($slug)
        ];

        return view('comics/edit', $data);
    }

    public function update($id)
    {
        // Validasi Edit
        $komikLama = $this->comicModel->getComic($this->request->getVar('slug'));

        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $this->rule_judul = 'required';
        } else {
            $this->rule_judul = 'required|is_unique[comics.judul]';
        }

        if (!$this->validasi()) {
            return redirect()->to('/comics/edit/' . $this->request->getVar('slug'))->withInput();
        }

        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        $sampulLama = $this->request->getVar('sampulLama');

        // cek gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $sampulLama;
        } else {
            // generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            // upload gambar
            $fileSampul->move('img', $namaSampul);
            // hapus gambar lama
            unlink('img/' . $sampulLama);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->comicModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashData('pesan', 'Data berhasil diubah!');

        return redirect()->to('/comics');
    }

    private function validasi()
    {
        return $this->validate([
            'judul' => [
                'rules' => $this->rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                ]
            ],

            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ]);
    }
}
