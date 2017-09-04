<?php
App::uses('AppController', 'Controller');


class EventsController extends AppController {

    var $uses = array('Event', 'User','Screen');

	public function index() {

        $ekrany = $this->Screen->find('list', array(
            'fields' => array('Screen.id'),
            'conditions' => array('Screen.depid =' => AuthComponent::user('depid'))));
        $pom = array();
        foreach ($ekrany as $item)
        {
            array_push($pom,$item);
        }
        $pom2 = array_flip($pom);
        $this->set('states2',$pom2);
        $this->set('states',$pom);
        //CakeLog::write('debug', 'myArray22222'.print_r($pom2, true) );

		$this->set('events',$this->Event->find('all'));
		$this->set('users',$this->User->find('all'));
	}

// wyświetlenie ekranu z konkursem
	public function view($id = null) {
        $this->layout = 'konkurs';
		$dane =  $this->Event->findByid($id);
		$this->set('event', $dane);
		$this->set('user',$this->User->findByid($dane['Event']['author']));
	}

//Dodane nowego konkursu
	public function add() {

        $ekrany = $this->Screen->find('list', array(
            'fields' => array('Screen.id'),
            'conditions' => array('Screen.depid =' => AuthComponent::user('depid'))));
        $pom = array();
        foreach ($ekrany as $item)
        {
            array_push($pom,$item);
        }
        $pom2 = array_flip($pom);
        $this->set('states',$pom2);

		if ($this->request->is('post')) {
			$this->Event->create();
            $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +2 minutes")); // konkurs na dwie minuty
            $dane = $this->request->data;
            $ekran = $dane['Event']['Wybierz ekran nr:'];
            $tab = array('Event' => array('author' => AuthComponent::user('id'),'depid'=> AuthComponent::user('depid'),'status'=>0,'czas' => $newTime,'ekran'=>$ekran,
                'filename' => $dane['Event']['filename'],'dir'=>$dane['Event']['dir']));

            if ($this->Event->save($tab)) {
                    $nowatablica = array('Screen' => (array('id' => $ekran,'conntentnumber'=>1,'idevent' => $this->Event->id)));
                    $this->Screen->save($nowatablica);
				$this->Flash->success(__('Konkurs został dodany'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Konkurs nie został dodany. Błąd podczas przetwarzania.'));
			}
		}
	}

	public function edit($id = null) {

		$staredane = $this->Event->findByid($id);
        $ekrany = $this->Screen->find('list', array(
            'fields' => array('Screen.id'),
            'conditions' => array('Screen.depid =' => AuthComponent::user('depid'))));
        $pom = array();
        foreach ($ekrany as $item)
        {
            array_push($pom,$item);
        }
        $pom2 = array_flip($pom);
        $this->set('states',$pom2);
		if($this->request->is(array('post','put')))
		{
		    $dane = $this->request->data;
            $ekran = $dane['Event']['Wybierz ekran'];
            $tab = array('Event' => array('id'=>$id,'author' => AuthComponent::user('id'),'status'=>0,'czas' => $staredane['Event']['czas'],'ekran'=>$ekran));
            $this->Event->id = $id;
			if($this->Event->save($tab))
			{
				$this->Flash->success('Konkurs zedytowany.');
				$this->redirect('index');
			}
			else
				$this->Flash->error('Brak możliwości edycji konkursu.');
		}
		$this->request->data = $staredane;
	}

	public function delete($id = null) {
		$this->Event->id = $id;
		$event = $this->Event->findByid($id);
		$screen = $this->Screen->findByid($event['Event']['ekran']);
		$this->request->allowMethod('post', 'delete');
        $tabica = array('Screen'=>array('id'=>$screen['Screen']['id'],'conntentnumber' => 2));
		if ($this->Event->delete()) {
            $this->Screen->save($tabica);
			$this->Flash->success(__('Konkurs został usunięty'));
		} else {
			$this->Flash->error(__('konkurs nie został usunięty'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function reboot($id = null) {
        $dane = $this->Event->findByid($id);
        $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +2 minutes"));
        $tab = array('Event' => array('id'=>$dane['Event']['id'],'author' => $dane['Event']['author'],'status'=>$dane['Event']['status'],'content' =>$dane['Event']['content'],'stuff' =>$dane['Event']['stuff'],'czas'=>$newTime,'ekran'=>$dane['Event']['ekran']));
        $this->request->allowMethod('post', 'delete');
        $ekran = $dane['Event']['ekran'];
        if ($this->Event->save($tab)) {
                $nowatablica = array('Screen' => (array('id' => $ekran,'conntentnumber'=>1,'idevent' => $this->Event->id)));
                $this->Screen->save($nowatablica);

            $this->Flash->success(__('Konkurs został uruchomiony ponownie'));


        } else {
            $this->Flash->error(__('Błąd podczas uruchamiania konkursu'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
