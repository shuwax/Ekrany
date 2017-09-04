<?php
App::uses('AppController', 'Controller');


class DepartmentsController extends AppController {

    var $uses = array('ExEvent', 'User','Screen','Department');


    public function getDepName($id=null)
    {
        $dapartment = $this->Department->findByid($id);
        return $dapartment;
    }
    public function getDep()
    {
        $dapartment = $this->Department->find('all');
        return $dapartment;
    }


    public function index() {
		$this->set('departments',$this->Department->find('all'));
        $this->set('screens',$this->Screen->find('all'));
	}

//Dodane nowego konkursu
	public function add() {
        if ($this->request->is('post')) {
            $this->Department->create();
            if ($this->Department->save($this->request->data)) {

                $id = $this->Department->id;

                CakeLog::write('debug', 'myArray -- '.print_r( $id, true) );
                $dane = $this->Department->findByid($id);
                $dlugosc = strlen($dane['Department']['google']);
                $link = 0;
                if($dlugosc>3)
                {
                    $link = 1;
                }
                $tablica = array('Department' => array('id'=>$id, 'link' => $link));
                $this->Department->save($tablica);

                $this->requestAction(array('controller'=>'screens','action'=>'ZapisTygodniowy'));
                $this->requestAction(array('controller'=>'screens','action'=>'ZapisDzienny'));
                $this->Flash->success(__('Oddział Został dodany'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Błąd podczas dodawania Oddziału.'));
            }
        }
	}

	public function edit($id = null) {
        $staredane = $this->Department->findByid($id);
        if($this->request->is(array('post','put')))
        {
             $this->Department->id = $id;
             $dane = $this->request->data;
             $dlugosc = strlen($dane['Department']['google']);
             $link = 0;
             if($dlugosc>3)
             {
                 $link = 1;
             }
             $tablica = array('Department'=>array('id'=>$id,'google'=>$dane['Department']['google'],'link'=>$link));
            if($this->Department->save($tablica))
            {
                $this->Flash->success('Oddział zedytowany.');
                $this->redirect('index');
            }
            else
                $this->Flash->error('Brak możliwości edycji Oddziału.');
        }
        $this->request->data = $staredane;
	}


	public function delete($id = null) {
		$this->Department->id = $id;
		$this->request->allowMethod('post', 'delete');
		if ($this->Department->delete()) {
			$this->Flash->success(__('Oddział został usunięty'));
		} else {
			$this->Flash->error(__('Błąd podczas przetwarzania danych'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
