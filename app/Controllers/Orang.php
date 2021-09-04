<?php

namespace App\Controllers;

use App\Models\OrangModel as OrangModel;

class Orang extends BaseController
{
        public function index()
        {
                $orangModel = new OrangModel();

                $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;

                $perHalaman = 10;

                $keyword = $this->request->getVar('keyword');
                if ($keyword) {
                        $orang = $orangModel->search($keyword);
                } else {
                        $orang = $orangModel;
                }

                $data = [
                        'title' => 'Daftar Orang',
                        'orang' => $orang->paginate($perHalaman, 'orang'),
                        'perHalaman' => $perHalaman,
                        'pager' => $orang->pager,
                        'currentPage' => $currentPage
                ];

                return view('orang/index', $data);
        }
}
