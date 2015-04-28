<?php

App::uses('AppController', 'Controller');

/**
 * Adminusers Controller
 *
 * @property Adminuser $Adminuser
 * @property PaginatorComponent $Paginator
 * @property nComponent $n
 * @property SessionComponent $Session
 */
class AdminusersController extends AppController {

    //public $components = array('Paginator', 'N', 'Session');
    public $layout = 'admin';
    public $uses = array('Adminuser', 'Emailcontent');

    public function admin_profile() {
        $this->checkadmin();
        $id = $this->Session->read('Adminuser.admin_id');
        if (!$this->Adminuser->exists($id)) {
            throw new NotFoundException(__('Invalid adminuser'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $checkemail = $this->Adminuser->find('first', array('conditions' => array('email' => $this->request->data['Adminuser']['email'], 'admin_id !=' => $id, 'status !=' => 'Trash')));
            if (empty($checkemail)) {
                $this->request->data['Adminuser']['admin_id'] = $id;
                $this->Adminuser->save($this->request->data);
                $this->Session->setFlash("<div class='success msg'>" . __('The admin user detail has been updated successfully') . "</div>", '');
                $this->redirect(array('action' => 'profile'));
            } else {
                $this->Session->setFlash("<div class='error msg'>" . __('Email already exists') . "</div>", '');
            }
        } else {
            $options = array('conditions' => array('Adminuser.' . $this->Adminuser->primaryKey => $id));
            $this->request->data = $this->Adminuser->find('first', $options);
        }
    }

    public function admin_changepass() {
        $this->checkadmin();
        $id = $this->Session->read('Adminuser.admin_id');
        if (!$this->Adminuser->exists($id)) {
            throw new NotFoundException(__('Invalid adminuser'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $checkpass = $this->Adminuser->find('first', array('conditions' => array('password' => sha1($this->request->data['Adminuser']['oldpassword']), 'admin_id' => $id)));
            if (!empty($checkpass)) {
                if ($this->request->data['Adminuser']['passwords'] == $this->request->data['Adminuser']['cpassword']) {
                    $this->request->data['Adminuser']['password'] = sha1($this->request->data['Adminuser']['passwords']);
                    $this->request->data['Adminuser']['admin_id'] = $id;
                    $this->Adminuser->save($this->request->data);
                    $this->Session->setFlash("<div class='success msg'>" . __('The admin user detail has been updated successfully') . "</div>", '');
                    $this->redirect(array('action' => 'changepass'));
                } else {
                    $this->Session->setFlash("<div class='error msg'>" . __('New password and confirm password did not match') . "</div>", '');
                }
            } else {
                $this->Session->setFlash("<div class='error msg'>" . __('Old Password is incorrect') . "</div>", '');
            }
        }
    }

    public function admin_changenewpass($id = NULL) {
        $this->checkadmin();
        $this->superadmin();
        if (!$this->Adminuser->exists($id)) {
            throw new NotFoundException(__('Invalid adminuser'));
        }
        $check = $this->Adminuser->find('first', array('conditions' => array('admin_id' => $this->params->pass['0'], 'status !=' => 'Trash')));
        if (!empty($check)) {
            $checkemail = $this->Adminuser->find('first', array('conditions' => array('admin_id' => $this->params->pass['0'], 'status !=' => 'Trash')));
            $password = $this->str_rand();
            $this->request->data['Adminuser']['admin_id'] = $id;
            $this->request->data['Adminuser']['password'] = sha1($password);
            $this->request->data['Adminuser']['status'] = 'Active';
            $this->Adminuser->save($this->request->data);
            /* $emaillist=$this->Emaillist->find('first',array('conditions'=>array('eid'=>'3')));
              $emailcontent=$this->Emailcontent->find('first',array('conditions'=>array('eid'=>'3','lan'=>'en'))); */
            $emailcontent = $this->Emailcontent->find('first', array('conditions' => array('eid' => '3')));
            $link = BASE_URL . "admin/";
            $message = str_replace(array('{username}', '{password}', '{link}'), array($checkemail['Adminuser']['username'], $password, $link), $emailcontent['Emailcontent']['emailcontent']);
            $this->mailsend($emaillist['Emaillist']['fromname'], $emaillist['Emaillist']['fromemail'], $checkemail['Adminuser']['email'], $emailcontent['Emailcontent']['subject'], $message);
            $this->Session->setFlash("<div class='success msg'>" . __('The admin user password has been changed successfully') . "</div>", '');
            $this->redirect(array('action' => 'edit', $id));
        } else {
            $this->Session->setFlash("<div class='error msg'>" . __('Admin User not found') . "</div>", '');
        }
    }

    private function superadmin() {
        $id = $this->Session->read('Adminuser.admin_id');
        if ($id > 1) {
            $this->Session->setFlash("<div class='warning msg'>" . __('Sorry, You have not permission to vist this page') . "</div>", '');
            $this->redirect(array('action' => 'profile'));
        }
    }

}
