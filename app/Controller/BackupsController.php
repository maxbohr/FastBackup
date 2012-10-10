<?php
App::uses('AppController', 'Controller');
/**
 * Backups Controller
 *
 * @property Backup $Backup
 */
class BackupsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Backup->recursive = 0;
		$this->set('backups', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Backup->id = $id;
		if (!$this->Backup->exists()) {
			throw new NotFoundException(__('Invalid backup'));
		}
        $backup = $this->Backup->get_backups($id);
		$this->set('backup', $backup);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Backup->create();
			if ($this->Backup->save($this->request->data)) {
				$this->Session->setFlash(__('The backup has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The backup could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Backup->id = $id;
		if (!$this->Backup->exists()) {
			throw new NotFoundException(__('Invalid backup'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Backup->save($this->request->data)) {
				$this->Session->setFlash(__('The backup has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The backup could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Backup->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Backup->id = $id;
		if (!$this->Backup->exists()) {
			throw new NotFoundException(__('Invalid backup'));
		}
		if ($this->Backup->delete()) {
			$this->Session->setFlash(__('Backup deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Backup was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
    
    public function run($key = null) {
        $this->uses = array('Option');
        $db_key = $this->Option->find('first');
        if($this->Auth->user('id')==null && $key!=$db_key['Option']['backup_key']){
            $this->Session->setFlash('Invalid Key or please login.');
            return $this->redirect('/');
        }
        
        if(!$this->Backup->validate_env()) {
            $this->Session->setFlash('Runs only on Linux and with exec() function enabled.');
            return $this->redirect('index');
        }
        $backup_results = $this->Backup->backup_all();
        $this->set(compact('backup_results'));
    }
    
    public function create_backup($id = null) {
        if(!$this->Backup->validate_env()) {
            $this->Session->setFlash('Runs only on Linux and with exec() function enabled.');
            return $this->redirect('index');
        }
        if(!$this->request->is('post')) {
    		$this->Session->setFlash(__('Direct access not allowed'));
			$this->redirect(array('action' => 'index'));
        }
		$this->Backup->id = $id;
		if (!$this->Backup->exists()) {
			throw new NotFoundException(__('Invalid backup'));
		}
        $backup = $this->Backup->read(null, $id);
        $backup_result = $this->Backup->create_backup($backup, false);
		if ($backup_result['Backup']['status'] == 'Success') {
			$this->Session->setFlash(__('Backup created'));
		}
        else {
    		$this->Session->setFlash($backup_result['Backup']['status']  . ': ' . $backup_result['Backup']['message']);
        }
		$this->redirect(array('action' => 'view', $id));
    }
    
    public function beforeFilter(){
        $this->uses = array('Option');
        $option = $this->Option->find('first');
        $this->Backup->setup_env($option);
        $this->Auth->allow('run');
    }
}
