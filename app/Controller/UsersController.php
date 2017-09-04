<?php
App::uses('AppController', 'Controller');


class UsersController extends AppController {

	var $uses = array('Reservation', 'Service', 'User', 'Salon','Employee');
	
	public $components = array('Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add','view');
	}

	public function login() {
		$this->layout = 'login';
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect(array('controller' => 'Pages','action' => 'display'));
			}
			$this->Flash->error(__('Invalid username or password, try again'));
			$this->redirect(array('controller' => 'Users','action' => 'login'));
		}
	}

	public function logout() {
			$this->Auth->logout();
			$this->redirect(array('controller' => 'Pages','action' => 'display'));
	}





	public function admin_index() {
		$this->set('users',$this->User->find('all'));
	}


	public function view($id = null) {
		$this->set('user', $this->User->findByid($id));
	}


	public function admin_add() {
            
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('Uzytkownik został dodany'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Uzytkownik nie został dodany.'));
			}
		}
	}

	public function add() {
		$this->layout = 'login';
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('controller' => 'Pages','action' => 'display'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}
	
	public function admin_edit($id = null) {

		$dane = $this->User->findByid($id);
		$this->set('employees',$this->Employee->find('list'));
		$this->set('dane',$dane);
		if($this->request->is(array('post','put')))
		{
			$this->User->id = $id;
			if($this->data['User']['employees_id'] == "")
			{
				$data = array('username' => $this->data['User']['username'],'first_name' => $this->request->data['User']['first_name'],'last_name' =>
					$this->request->data['User']['last_name'],'email' => $this->request->data['User']['email'],'tel' => $this->request->data['User']['tel']
				,'role' => $this->request->data['User']['role'],'employees_id' => 0);
//				CakeLog::write('debug', 'myArray22222'.print_r( $data, true) );
				if($this->User->save($data)) {
					$this->Flash->success('Uzytkownik zedytowany.');
					$this->redirect('index');
				}
			}


			if($this->User->save($this->request->data))
			{
				$this->Flash->success('Uzytkownik zedytowany.');
				$this->redirect('index');
			}
			else
				$this->Flash->error('Brak możliwości edycji uzytkownika.');
		}
		$this->request->data = $dane;
	}



	public function admin_delete($id = null) {
		$this->User->id = $id;
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('Uzytkownik został usunięty'));
		} else {
			$this->Flash->error(__('Uzytkownik nie został usunięty'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function delete($id = null) {
		$this->User->id = $id;
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('Uzytkownik został usunięty'));
		} else {
			$this->Flash->error(__('Uzytkownik nie został usunięty'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
