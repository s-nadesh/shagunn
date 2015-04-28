<?php

App::uses('AppController', 'Controller');

/**
 * Login Controller
 *
 * @property RequestHandlerComponent $RequestHandler
 * @property SessionComponent $Session
 */
class LoginController extends AppController {

    /**
     * This model is used in site for login
     *
     * @var array
     * @access public
     */
    public $uses = array('Adminuser', 'Emailcontent');

    /**
     * This layout is used for login
     *
     * @var array
     * @access public
     */
    public $layout = 'adminlogin';

    /**
     * admin_index method
     * Login for admin
     *
     * @return void
     */
    public function admin_index() {
        $this->admin_logincheck();
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['email'])) {
                $check = $this->Adminuser->find('first', array('conditions' => array('email' => $this->request->data['email'], 'status' => 'Active')));
                if (!empty($check)) {
                    $pass = $this->str_rand();
                    $password = sha1($pass);
                    $emailcontent = $this->Emailcontent->find('first', array('conditions' => array('eid' => '1')));
                    $name = $check['Adminuser']['admin_name'];
                    $subject = $emailcontent['Emailcontent']['subject'];
                    $link = BASE_URL . "admin/login";
                    $message = str_replace(array('{username}', '{password}', '{link}'), array($check['Adminuser']['username'], $pass, $link), $emailcontent['Emailcontent']['content']);
                    $this->mailsend($emailcontent['Emailcontent']['fromname'], $emailcontent['Emailcontent']['fromemail'], $this->request->data['email'], $subject, $message);

                    $check['Adminuser']['password'] = $password;
                    $check['Adminuser']['modify_date '] = date("Y-m-d H:i:s", mktime(date("H"), date("i") + 30, date("s"), date("m"), date("d"), date("Y")));
                    $this->Adminuser->save($check);
                    $this->Session->setFlash("<div class='success msg'>" . __('Your password details sent to your email address') . ".</div>", '');
                    $this->redirect(array('controller' => 'login', 'action' => 'index'));
                } else
                    $this->Session->setFlash("<div class='error msg'>" . __('Invalid email address') . ".</div>", '');
                $this->set('result', 'forgot');
            }
            else {
                $check = $this->Adminuser->find('first', array('conditions' => array('username' => $this->request->data['username'])));
                if (!empty($check)) {
                    if ($check['Adminuser']['password'] == sha1($this->request->data['password'])) {
                        if ($check['Adminuser']['status'] == 'Active') {
                            $this->Session->write($check);
                            $this->redirect(array('controller' => 'Dashboard', 'action' => 'index'));
                        } else
                            $this->Session->setFlash("<div class='error msg'>" . __('Username and password mismatch') . ".</div>", '');
                    } else
                        $this->Session->setFlash("<div class='error msg'>" . __('Username and password mismatch') . ".</div>", '');
                } else
                    $this->Session->setFlash("<div class='error msg'>" . __('Username and password mismatch') . ".</div>", '');
                $this->set('result', '');
            }
        }
    }

}
