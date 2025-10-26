<?php

namespace App\Controllers\Backend;

use App\Models\Backend\TestimonialModel;

use CodeIgniter\Controller;

class Testimonial extends Controller
{
	protected $testimonialModel;

	protected $session;

	public function __construct()
	{
		helper(['form', 'text']);

		$this->testimonialModel = new TestimonialModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['data'] = $this->testimonialModel->getTestimonial();
		return view('Backend/v_testimonial', $data);
	}

	public function insert()
	{
		$nama = htmlspecialchars($this->request->getPost('nama', FILTER_SANITIZE_STRING), ENT_QUOTES);
		$content = htmlspecialchars($this->request->getPost('content', FILTER_SANITIZE_STRING), ENT_QUOTES);

		$file = $this->request->getFile('filefoto');
		if ($file && $file->isValid() && !$file->hasMoved()) {
			$fileName = $file->getRandomName();
			$file->move('assets/images', $fileName);

			\Config\Services::image()
				->withFile('assets/images/' . $fileName)
				->resize(100, 100, true, 'height')
				->save('assets/images/' . $fileName, 60);

			$this->testimonialModel->insertTestimonial($nama, $content, $fileName);
			session()->setFlashdata('msg', 'success');
			return redirect()->to('Backend/testimonial');
		} else {
			session()->setFlashdata('msg', 'error-img');
			return redirect()->to('Backend/testimonial');
		}
	}

	public function update()
	{
		$id = htmlspecialchars($this->request->getPost('testimonial_id', FILTER_SANITIZE_STRING), ENT_QUOTES);
		$nama = htmlspecialchars($this->request->getPost('nama', FILTER_SANITIZE_STRING), ENT_QUOTES);
		$content = htmlspecialchars($this->request->getPost('content', FILTER_SANITIZE_STRING), ENT_QUOTES);

		$file = $this->request->getFile('filefoto');
		if ($file && $file->isValid() && !$file->hasMoved()) {
			$fileName = $file->getRandomName();
			$file->move('assets/images', $fileName);

			\Config\Services::image()
				->withFile('assets/images/' . $fileName)
				->resize(100, 100, true, 'height')
				->save('assets/images/' . $fileName, 60);

			$this->testimonialModel->updateTestimonial($id, $nama, $content, $fileName);
			session()->setFlashdata('msg', 'info');
			return redirect()->to('Backend/testimonial');
		} else {
			$this->testimonialModel->updateTestimonialNoimg($id, $nama, $content);
			session()->setFlashdata('msg', 'info');
			return redirect()->to('Backend/testimonial');
		}
	}

	public function delete()
	{
		$testimonial_id = $this->request->getPost('kode', FILTER_SANITIZE_STRING);
		$this->testimonialModel->deleteTestimonial($testimonial_id);
		session()->setFlashdata('msg', 'success-hapus');
		return redirect()->to('Backend/testimonial');
	}
}
