<?php
App::uses('AppController', 'Controller');


class ExEventsController extends AppController {

    var $uses = array('ExEvent', 'User','Screen');

	public function index() {
		$this->set('exevents',$this->ExEvent->find('all'));
		$this->set('users',$this->User->find('all'));
	}

// wyświetlenie ekranu z konkursem
	public function view($id = null) {
		$dane =  $this->Event->findByid($id);
		$this->set('event', $dane);
		$this->set('user',$this->User->findByid($dane['Event']['author']));
	}

//Dodane nowego konkursu
	public function add() {
		if ($this->request->is('post')) {
            $dane = $this->request->data;
            $ekran = $dane['ExEvent']['Wybierz ekran'];
            if($ekran == 0)
            {
                $nowatablica = array('Screen' => (array('id' => 1,'conntentnumber'=>2)));
                $this->Screen->save($nowatablica);
            }else if($ekran == 1)
            {
                $nowatablica = array('Screen' => (array('id' => 2,'conntentnumber'=>2)));
                $this->Screen->save($nowatablica);
            }else{
                $nowatablica = array('Screen' => (array('id' => 1,'conntentnumber'=>2)));
                $this->Screen->save($nowatablica);
                $nowatablica = array('Screen' => (array('id' => 2,'conntentnumber'=>2)));
                $this->Screen->save($nowatablica);
            }
			$this->ExEvent->create();
            $tab = array('ExEvent' => array('author' => AuthComponent::user('id'),'status'=>0,'info' =>$this->request->data['ExEvent']['info']));
            //CakeLog::write('debug', 'myArray'.print_r($tab, true) );
            if ($this->ExEvent->save($tab)) {
				$this->Flash->success(__('Informacja dodany'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Informacja nie została dodana. Błąd podczas przetwarzania.'));
			}
		}
	}

	public function edit($id = null) {

		$dane = $this->ExEvent->findByid($id);
		if($this->request->is(array('post','put')))
		{
            $tab = array('ExEvent' => array('author' => AuthComponent::user('id'),'status'=>0,'info' =>$this->request->data['ExEvent']['info']));
            $this->ExEvent->id = $id;
			if($this->ExEvent->save($tab))
			{
				$this->Flash->success('Informacja zedytowany.');
				$this->redirect('index');
			}
			else
				$this->Flash->error('Brak możliwości edycji wiadomość.');
		}
		$this->request->data = $dane;
	}


	public function delete($id = null) {
		$this->ExEvent->id = $id;
		$this->request->allowMethod('post', 'delete');
		if ($this->ExEvent->delete()) {
			$this->Flash->success(__('Wiadomość została usunięta'));
		} else {
			$this->Flash->error(__('Wiadomość nie została usunięta'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
