<?php

App::uses('AppController', 'Controller');

/**
 * Vendors Controller
 *
 * @property Vendor $Vendor
 * @property PaginatorComponent $Paginator
 */
class ShoppingcartsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session', 'Image');
    public $uses = array('Shoppingcart', 'Product','Order','Discounthistory', 'User');
    public $layout = 'webpage';
	/*List Shopping Carts in User Login */
    public function shopping_cart() {
        if ($this->Session->read('cart_process') == '') {
            $this->redirect(array('action' => 'jewellery', 'controller' => 'webpages'));
        }
        if ($this->request->is('post')) {
            if (!empty($this->request->data['cartid'])) {
                $i = 0;
                foreach ($this->request->data['cartid'] as $cartid) {
                    $this->request->data['Shoppingcart']['cart_id'] = $cartid;
                    $this->request->data['Shoppingcart']['quantity'] = $this->request->data['quantity'][$i];
                    $this->Shoppingcart->saveAll($this->request->data['Shoppingcart']);
                    $i++;
                }
                $this->redirect(array('action' => 'shopping_cart'));
            }
        }

        $cart_product = $this->Shoppingcart->find('all', array('conditions' => array('cart_session' => $this->Session->read('cart_process'))));
        if (empty($cart_product)) {
            $this->redirect(array('action' => 'jewellery', 'controller' => 'webpages'));
        } else {

            $this->set('cart_products', $cart_product);
        }
    }
    
    public function minicart() {
        $this->layout = '';
        if (isset($this->request->data['Shopping']['shoppingsubmit'])) {
            if ($this->Session->read('cart_process') == '') {
                $this->Session->write('cart_process');
                $cart_session = $this->str_rand(15);
            } else {
                $cart_session = $this->Session->read('cart_process');
            }
            $carts = $this->Shoppingcart->find('first', array('conditions' => array('size' => $this->request->data['Shoppingcart']['size'], 'purity' => $this->request->data['Shoppingcart']['purity'], 'color' => $this->request->data['Shoppingcart']['color'], 'clarity' => $this->request->data['Shoppingcart']['clarity'], 'product_id' => $this->request->data['Shoppingcart']['product_id'], 'cart_session' => $cart_session)));

            if (empty($carts)) {
                $this->request->data['Shoppingcart']['cart_session'] = $cart_session;
                $this->request->data['Shoppingcart']['stoneamount'] = str_replace(",", '', $this->request->data['Shoppingcart']['stoneamount']);
                $this->request->data['Shoppingcart']['goldamount'] = str_replace(",", '', $this->request->data['Shoppingcart']['goldamount']);
                $this->request->data['Shoppingcart']['vat'] = str_replace(",", '', $this->request->data['Shoppingcart']['vat']);
                $this->request->data['Shoppingcart']['making_charge'] = str_replace(",", '', $this->request->data['Shoppingcart']['making_charge']);
                $this->request->data['Shoppingcart']['total'] = str_replace(",", '', $this->request->data['Shoppingcart']['total']);
                $this->request->data['Shoppingcart']['goldprice'] = str_replace(",", '', $this->request->data['Shoppingcart']['goldprice']);
                $this->request->data['Shoppingcart']['stoneprice'] = str_replace(",", '', $this->request->data['Shoppingcart']['stoneprice']);
                $this->request->data['Shoppingcart']['gemstoneamount'] = str_replace(",", '', $this->request->data['Shoppingcart']['gemstoneamount']);
                $this->request->data['Shoppingcart']['created_date'] = date('Y-m-d H:i:s');
                $this->Shoppingcart->save($this->request->data);
            } else {
               // $this->request->data['Shoppingcart']['cart_id'] = $carts['Shoppingcart']['cart_id'];
                $carts['Shoppingcart']['quantity']= $carts['Shoppingcart']['quantity'] + 1;
                $this->Shoppingcart->save($carts);
            }
			if($this->Session->read('discount')!=''){
				$this->Order->updateAll(array('discount_per'=>NULL,'discount_amount'=>0),array('order_id'=>$this->Session->read('Order')));
				$this->Discounthistory->deleteAll(array('order_id'=>$this->Session->read('Order')),false,false,false);
				$this->Session->delete('discount');
			}
            $this->Session->write('cart_process', $cart_session);
        }
    
        if ($this->Session->read('cart_process') == '') {
            $this->redirect(array('action' => 'jewellery', 'controller' => 'webpages'));
        }

        $cart_product = $this->Shoppingcart->find('all', array('conditions' => array('cart_session' => $this->Session->read('cart_process'))));
        if (empty($cart_product)) {
            $this->redirect(array('action' => 'jewellery', 'controller' => 'webpages'));
        } else {

            $this->set('cart_products', $cart_product);
        }
    }
	/*Add Shopping Carts */
    public function addcart() {
        if (isset($this->request->data['Shopping']['shoppingsubmit'])) {
            if ($this->Session->read('cart_process') == '') {
                $this->Session->write('cart_process');
                $cart_session = $this->str_rand(15);
            } else {
                $cart_session = $this->Session->read('cart_process');
            }
            $carts = $this->Shoppingcart->find('first', array('conditions' => array('size' => $this->request->data['Shoppingcart']['size'], 'purity' => $this->request->data['Shoppingcart']['purity'], 'color' => $this->request->data['Shoppingcart']['color'], 'clarity' => $this->request->data['Shoppingcart']['clarity'], 'product_id' => $this->request->data['Shoppingcart']['product_id'], 'cart_session' => $cart_session)));

            if (empty($carts)) {
                $this->request->data['Shoppingcart']['cart_session'] = $cart_session;
                $this->request->data['Shoppingcart']['stoneamount'] = str_replace(",", '', $this->request->data['Shoppingcart']['stoneamount']);
                $this->request->data['Shoppingcart']['goldamount'] = str_replace(",", '', $this->request->data['Shoppingcart']['goldamount']);
                $this->request->data['Shoppingcart']['vat'] = str_replace(",", '', $this->request->data['Shoppingcart']['vat']);
                $this->request->data['Shoppingcart']['making_charge'] = str_replace(",", '', $this->request->data['Shoppingcart']['making_charge']);
                $this->request->data['Shoppingcart']['total'] = str_replace(",", '', $this->request->data['Shoppingcart']['total']);
                $this->request->data['Shoppingcart']['goldprice'] = str_replace(",", '', $this->request->data['Shoppingcart']['goldprice']);
                $this->request->data['Shoppingcart']['stoneprice'] = str_replace(",", '', $this->request->data['Shoppingcart']['stoneprice']);
                $this->request->data['Shoppingcart']['gemstoneamount'] = str_replace(",", '', $this->request->data['Shoppingcart']['gemstoneamount']);
                $this->request->data['Shoppingcart']['created_date'] = date('Y-m-d H:i:s');
                $this->Shoppingcart->save($this->request->data);
            } else {
               // $this->request->data['Shoppingcart']['cart_id'] = $carts['Shoppingcart']['cart_id'];
                $carts['Shoppingcart']['quantity']= $carts['Shoppingcart']['quantity'] + 1;
                $this->Shoppingcart->save($carts);
            }
			if($this->Session->read('discount')!=''){
				$this->Order->updateAll(array('discount_per'=>NULL,'discount_amount'=>0),array('order_id'=>$this->Session->read('Order')));
				$this->Discounthistory->deleteAll(array('order_id'=>$this->Session->read('Order')),false,false,false);
				$this->Session->delete('discount');
			}
            $this->Session->write('cart_process', $cart_session);
            
            if($this->Session->check('User.user_id')){
                $this->User->id = $this->Session->read('User.user_id');
                $this->User->saveField('cart_session', $cart_session);
            }
        }
        $this->redirect(array('action' => 'shopping_cart'));
    }
	/*Remove Shopping Carts */
    public function remove() {
        $this->layout = '';
        $this->render(false);
        $cart = $this->Shoppingcart->find('first', array('conditions' => array('product_id' => $this->params['pass']['0'])));
        $this->Shoppingcart->delete(array('product_id' => $this->params['pass']['0']));
        $this->redirect(array('action' => 'shopping_cart'));
    }

}
