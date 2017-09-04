<?php
App::uses('AppController', 'Controller');


class EmployeesController extends AppController {

    var $uses = array('ExEvent', 'User','Screen','Employee','DW_AggregatedStatisticPerDayFromBranch','Department');

	public function index() {
		$this->set('employees',$this->Employee->find('all',array(
            'conditions' => array('Employee.user_id =' => AuthComponent::user('id')))));
		$this->set('users',$this->User->find('all'));
        //$department = $this->Employee->find('all',array('conditions' =>(array('Employee'.'depid =' =>AuthComponent::user('id') ))));
//        $this->set('systell',$this->DW_AggregatedStatisticPerDayFromBranch->find('all',array(
//            'conditions' => array('DW_AggregatedStatisticPerDayFromBranch.Branch =' => 'Lublin'))));
	}

    public function selekcja($tablica)
    {
        $employee = $this->Employee->find('all',array('conditions' =>(array('Employee.depid =' =>AuthComponent::user('depid'),'Employee.depid !='-1))));
        CakeLog::write('debug', 'myArray' . print_r($employee, true));
        return $employee;
    }
	public function add() {
         $newTime = date("Y-m-d",strtotime(date("Y-m-d")." -7 days"));
         $department = $this->Department->findByid(AuthComponent::user('depid'));
	     $this->set('systell',$this->DW_AggregatedStatisticPerDayFromBranch->find('all',array(
                    'conditions' => array('DW_AggregatedStatisticPerDayFromBranch.Branch =' => $department['Department']['name'], 'DayDate =' => $newTime),array('fields'=>array('DISTINCT AgentName')))));
        $tab = $this->DW_AggregatedStatisticPerDayFromBranch->find('all',array(
            'conditions' => array('DW_AggregatedStatisticPerDayFromBranch.Branch =' => $department['Department']['name'], 'DayDate =' => $newTime,''),array('fields'=>array('DISTINCT AgentName'))));
        CakeLog::write('debug', 'myArray' . print_r($tab, true));
        $this->selekcja($tab);

        if ($this->request->is('post')) {
            $dane = $this->request->data;
            $pom = array();
            foreach ($dane['Employee'] as $item) {
                $id = $this->Employee->find('all',array('conditions' =>(array('Employee.agent =' =>$item))));
                if(!empty($id))
                    $p = array('Employee' => array('id'=>$id[0]['Employee']['id'],'user_id' => AuthComponent::user('id'), 'agent' => $item,'depid'=>AuthComponent::user('depid')));
                else
                    $p = array('Employee' => array('user_id' => AuthComponent::user('id'), 'agent' => $item,'depid'=>AuthComponent::user('depid')));
                array_push($pom, $p);
            }
            if ($this->Employee->saveall($pom)) {
              //  CakeLog::write('debug', 'myArray' . print_r($pom, true));
            }
            $this->Flash->success(__('Lista zaktualizowana dodany'));
            return $this->redirect(array('action' => 'index'));
        }
	}

    public function edit($id = null) {

        $staredane = $this->Employee->findByid($id);
        if($this->request->is(array('post','put')))
        {
            $dane = $this->request->data;
            $this->Employee->id = $id;
            if($this->Employee->save($this->request->data))
            {
                $this->Flash->success('Numer został zmieniony.');
                $this->redirect('index');
            }
            else
                $this->Flash->error('Problem ze zmianą numeru.');
        }
        $this->request->data = $staredane;
    }

	public function delete($id = null) {
		$this->Employee->id = $id;
		$this->request->allowMethod('post', 'delete');
        $p = array('Employee' => array('id'=>$id,'user_id' => -1));
		if ($this->Employee->save($p)) {
			$this->Flash->success(__('Wiadomość została usunięta'));
		} else {
			$this->Flash->error(__('Wiadomość nie została usunięta'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
