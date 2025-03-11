<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Payment Controller
 *
 * @property \App\Model\Table\PaymentTable $Payment
 */
class PaymentController extends AppController
{


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function initialize(): void
    {

        parent::initialize();
        //$this->loadComponent('RequestHandler');
        $this->Authentication->addUnauthenticatedActions(['payment','index','add']);

    }










    public function index()
    {
        $query = $this->Payment->find()
            ->contain(['Customer']);
        $payment = $this->paginate($query);

        $this->set(compact('payment'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payment = $this->Payment->get($id, contain: ['Customer']);
        $this->set(compact('payment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $payment = $this->Payment->newEmptyEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payment->patchEntity($payment, $this->request->getData());
            if ($this->Payment->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));


                unset($_SESSION['cart']);


                return $this->redirect(['action' => 'add']);
            }

        }
        $customer = $this->Payment->Customer->find('list', ['limit' => 200])->all();
        $this->set(compact('payment', 'customer'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payment = $this->Payment->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payment->patchEntity($payment, $this->request->getData());
            if ($this->Payment->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $customer = $this->Payment->Customer->find('list', limit: 200)->all();
        $this->set(compact('payment', 'customer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payment->get($id);
        if ($this->Payment->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function saveOrder()
    {
        $this->request->allowMethod(['post']);

        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            $this->Flash->error(__('Your cart is empty.'));
            return $this->redirect(['controller' => 'Products', 'action' => 'index']);
        }

        foreach ($_SESSION['cart'] as $item) {
            $payment = $this->Payments->newEmptyEntity();
            $paymentData = [
                'product_id' => $item['id'],
                'customer_id' => $this->Authentication->getIdentity()->getIdentifier(),
                'status' => 1,  // Assuming status 1 means "processed"
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'delivery_type' => $item['name']  // Storing product name in 'delivery_type'
            ];

            $payment = $this->Payments->patchEntity($payment, $paymentData);
            if (!$this->Payments->save($payment)) {
                $this->Flash->error(__('Failed to save some items. Please, try again.'));
                return $this->redirect(['controller' => 'Cart', 'action' => 'index']);
            }
        }

        $this->Flash->success(__('All items have been successfully saved.'));
        unset($_SESSION['cart']); // Clear the cart after saving
        return $this->redirect(['controller' => 'Products', 'action' => 'index']);  // Or to a confirmation page
    }



}
