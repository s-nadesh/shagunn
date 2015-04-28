<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array('Cookie', 'Session');
    public $helpers = array('Session');

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('Adminuser', 'Emaillist', 'Emailcontent', 'Shoppingcart');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Cookie->name = 'view';
        $this->Cookie->time = 3600;  // or '1 hour'
        $this->Cookie->path = '/';
        $this->Cookie->domain = 'runnable.com';
        $this->Cookie->secure = false;
        $this->Cookie->key = '39lbkutg1i2l0kta6785d8qki5';
        $this->Cookie->httpOnly = true;
    }

    protected function str_rand($length = 8, $output = 'alphanum') {
        // Possible seeds
        $outputs['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
        $outputs['numeric'] = '0123456789';
        $outputs['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
        $outputs['hexadec'] = '0123456789abcdef';

        // Choose seed
        if (isset($outputs[$output])) {
            $output = $outputs[$output];
        }

        // Seed generator
        list($usec, $sec) = explode(' ', microtime());
        $seed = (float) $sec + ((float) $usec * 100000);
        mt_srand($seed);

        // Generate
        $str = '';
        $output_count = strlen($output);
        for ($i = 0; $length > $i; $i++) {
            $str .= $output{mt_rand(0, $output_count - 1)};
        }

        return $str;
    }

    public function admin_logincheck() {
        if ($this->Session->read('Adminuser'))
            $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
    }

    public function dateformat() {
        $da = $this->Dformate->find('list', array('conditions' => array('status' => 'Active'), 'fields' => array('did', 'php')));
        $date = array();
        foreach ($da as $val => $key) {
            $date = $date + array($val => date($key));
        }
        $this->set('dformat', $date);
    }

    public function checkadmin() {
        if (!$this->Session->read('Adminuser')) {
            $this->redirect(array('controller' => 'login', 'action' => 'index'));
        } else {
            $admindetails = $this->Adminuser->find('first', array('conditions' => array('admin_id' => $this->Session->read('Adminuser.admin_id'), 'status' => 'Active')));
            if (!empty($admindetails)) {
                $this->set('sessionadmin', $admindetails);
            } else {
                $this->redirect(array('action' => 'logout'));
            }
        }
    }

    public function logout() {
        $this->Session->delete('loginid');
        $this->Session->delete('User');
        $this->Session->delete('Order');
        $this->Session->delete('cart_process');

        $sesuser = $this->Session->read('socialsite');
        if ($sesuser == "facebook") {
            App::import('Vendor', 'Facebook', array('file' => 'Fb/facebook.php'));
            $facebook = new Facebook(array(
                'appId' => FACEBOOK_API_KEY,
                'secret' => FACEBOOK_API_SECRET,
            ));
            $accesstocken = $facebook->getAccessToken();
            $params = array('next' => BASE_URL, 'access_token' => $accesstocken);
            $logoutUrl = $facebook->getLogoutUrl($params); // $params is optional.	
            $facebook->destroySession();
            $this->redirect($logoutUrl);
        }
        $this->redirect(array('controller' => 'signin', 'action' => 'index'));
    }

    public function admin_logout() {

        $this->Session->delete('Adminuser');
        $this->redirect(array('controller' => 'login', 'action' => 'index'));
    }

    protected function mailsend($fromname, $from, $to, $subject, $message, $cc = NULL, $attachment = 0, $attachmentsfiles = '', $template = 'default', $layout = 'default') {
        App::uses('CakeEmail', 'Network/Email');
        $email = new CakeEmail();
        if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.1.3') {
            $email->config('smtp');
        }
        $email->emailFormat('html');
        $email->from(array(trim($from) => $fromname));
        if ($attachment == 1) {
            $attach = explode(",", $attachmentsfiles);
            foreach ($attach as $attach) {
                $attachment[] = $attachmentfolder . $attach;
            }
            $email->attachments($attachment);
        }
        $email->template($template, $layout);
        $email->to(trim($to));
        if ($cc != '' || $cc != NULL) {
            $email->cc($cc);
        }
        $email->subject($subject);
		$email->layout=$layout;
        $email->send($message);
        $email->reset();
    }

    // Function to get the client ip address
    protected function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    public function usercheck() {
        $check = $this->Session->read('loginid');
        if (empty($check) && $check != 'True') {
            $this->redirect(array('controller' => 'signin', 'action' => 'index'));
        }
        $user = $this->User->find('first', array('conditions' => array('user_id' => $this->Session->read('User.user_id'), 'status' => 'Active')));
        if (!empty($user)) {
            $this->set('user', $user);
        } else {
            $this->redirect(array('action' => 'logout'));
        }
    }

    public function format($date) {
        return date("Y-m-d", strtotime(str_replace(array("/", ","), array("-", " "), $date)));
    }

    public function getFileExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    public function download($name) {
        $ext = explode('.', $name);
        $this->viewClass = 'Media';
        // Download app/outside_webroot_dir/example.zip
        $params = array(
            'id' => $name,
            'name' => $ext[0],
            'download' => true,
            'extension' => end($ext),
            'path' => 'webroot/img/shoppingrates' . DS
        );
        $this->set($params);
    }

}
