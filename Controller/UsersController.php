<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

    public function login() {
        if(AuthComponent::user()) {
            $this->redirect('/users');
        }
        if($this->request->is('post')) {
            if($this->Auth->login()) {
                $this->Session->setFlash('Login Succeeded..!');
                $this->redirect('/');
            }
            else {
                $this->Session->setFlash('Login Failed. Please Try Again..!','default',array('class'=>'error'));
            }
        }
    }
    
    public function logout() {
        $this->Auth->logout();
        $this->Session->setFlash('You are logged out!','default',array('class'=>'success'));
        $this->redirect('/users/login');
    }
    
    public function change_password() {
        $this->User->id = AuthComponent::user('id');
		if (!$this->User->exists()) {
			$this->Session->setFlash(__('Please login to proceed.'));
			$this->redirect(array('action' => 'login'));
		}
        if($this->request->is('post')) {
            if($this->User->change_password($this->request->data)) {
                $this->Session->setFlash(__('Password Successfully Changed.'));
                return $this->redirect('/');
            }
            else {
                $this->Session->setFlash(__('Password change failed. Please try again.'));
            }
        }
    }
    

}
