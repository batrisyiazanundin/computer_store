<?php

namespace App\Controller;

class CompController extends AppController
{
	
	public function index()
    {
		$this->viewBuilder()->setLayout('comp');
    }
	
	public function about()
	{
		$this->viewBuilder()->setLayout('comp');
	}
	
	public function contact()
	{
		$this->viewBuilder()->setLayout('comp');
	}
	public function login()
	{
		$this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'email' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
          

  'loginAction' => [
                'controller' => 'users',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => $this->referer()
        ]);

        $this->Auth->allow(['display', 'view', 'index']);
	}
}