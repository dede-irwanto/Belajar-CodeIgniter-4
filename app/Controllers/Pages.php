<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Home'
		];

		return view('pages/index', $data);
	}

	public function about()
	{
		$data = [
			'title' => 'Tentang Kami'
		];

		return view('pages/about', $data);
	}

	public function contact()
	{
		$data = [
			'title' => 'Kontak Person',
			'contact' => [
				[
					'hp' => '082348366034',
					'email' => 'id.dedeirwanto@gmail.com',
					'facebook' => 'dede.irwanto'
				],
				[
					'hp' => '082348366035',
					'email' => 'eka.potabuga@gmail.com',
					'facebook' => 'eka.potabuga'
				]
			]
		];
		
		return view('pages/contact', $data);
	}
}
