<?php

App::uses('AppController', 'Controller');

/**
 * Ads Controller
 *
 * @property Ad $Ad
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OrderstatusController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Order', 'Orderstatus');
    public $layout = 'admin';

    /**
     * admin_index method
     *
     * @return void
     */
    
    public function admin_index() {
        $this->checkadmin();
        $this->Orderstatus->recursive = 0;
        $this->Paginator->settings = array(
//            'order' => array('Orderstatus.order_status' => 'asc')
        );
        $this->set('orderstatus', $this->Paginator->paginate('Orderstatus'));
    }
    
    public function admin_add() {
        $this->checkadmin();
        if ($this->request->is('post')) {
            $this->Orderstatus->save($this->request->data);
            $this->Session->setFlash('<div class="success msg">Successfully Created</div>');
            $this->redirect(array('action' => 'index'));
        }
    }
    
    public function admin_edit($id = NULL) {
        $this->checkadmin();
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Orderstatus->save($this->request->data);
            $this->Session->setFlash('<div class="success msg">Successfully Updated</div>');
            $this->redirect(array('action' => 'index'));
        }else{
            $orderstatus = $this->Orderstatus->findByOrderStsId($id);
            if(empty($orderstatus))
                $this->redirect(array('action' => 'index'));
            $this->request->data = $orderstatus;
        }
    }
    
    public function admin_delete($id = NULL) {
        $this->checkadmin();
        $orderstatus = $this->Orderstatus->read(null, $id);
        if(empty($orderstatus))
            $this->redirect(array('action' => 'index'));

        $check_orders = $this->Order->find('count', array('conditions' => array('Order.order_status_id' => $id)));
        if($check_orders > 0){
            $this->Session->setFlash('<div class="error msg">This order status is used in order. Failed to delete</div>');
        }else{
            $this->Orderstatus->delete($id);
            $this->Session->setFlash('<div class="success msg">Successfully Deleted</div>');
        }
        $this->redirect(array('action' => 'index'));
    }
}
