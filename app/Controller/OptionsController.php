<?php
App::uses('AppController', 'Controller');
/**
 * Options Controller
 *
 * @property Option $Option
 */
class OptionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Option->recursive = 0;
        $options = $this->Option->find('all',array('limit'=>1));   
		$this->set('options', $options);
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Option->id = $id;
		if (!$this->Option->exists()) {
			throw new NotFoundException(__('Invalid option'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Option->save($this->request->data)) {
				$this->Session->setFlash(__('The option has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The option could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Option->read(null, $id);
		}
	}
}
