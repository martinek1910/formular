<?php

namespace App\Controllers;

class MainController extends BaseController
{
	public function index()
	{
		$view = 'Main/view';
		if (!is_file(APPPATH . '/Views/' . $view . '.php')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($view);
        }

        helper(['form', 'url']);

        $rolesModel = new \App\Models\RolesModel();

        $data['roles'] = $rolesModel->findAll();;
        $data['title'] = "Registrace projektu";

        echo view('templates/header', $data);
        echo view($view);
        echo view('templates/footer');
	}
	public function validateIndex()
    {
        helper(['form', 'url']);

        $userModel = new \App\Models\UserModel();
        $rolesModel = new \App\Models\RolesModel();

        $data['roles'] = $rolesModel->findAll();;
        $data['title'] = 'Registrace projektu';
        
        $input = $this->validate([
            'username' => 'required|min_length[5]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[7]',
            'age' => 'required|numeric|max_length[3]',
            'role' => 'required'
        ]);

        if (!$input) {
            echo view('templates/header', $data);
            echo view('Main/view', [
                'validation' => $this->validator
            ]);
            echo view('templates/footer');
        } else {
            $userModel->save([
                'username' => $this->request->getVar('username'),
                'email'  => $this->request->getVar('email'), 
                'password'  => $this->request->getVar('password'),
                'age' => $this->request->getVar('age'),
                'role' => $this->request->getVar('role')
            ]);

            $_SESSION['success'] = 'User has been saved successfully';
            $session = session();
            $session->markAsFlashdata('success');

            return redirect()->to('/index.php');
        }
	}
}
