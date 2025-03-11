<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Http\Response;
use Cake\Http\Session;


/**
 * Product Controller
 *
 * @property \App\Model\Table\ProductTable $Product
 */
class ProductController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();

    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Product->find();
        $product = $this->paginate($query);



        $this->set(compact('product'));
    }



    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Product->get($id, contain: ['Orders']);
        $this->set(compact('product'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Product->newEmptyEntity();
        $products = $this->Product->find()->select(['id', 'name', 'price', 'availability', 'dietary_type', 'image_path'])->all();

        if ($this->request->is(['post', 'put'])) {
            $productData = $this->request->getData();
            $fileObject = $this->request->getUploadedFile('image_path');

            if ($fileObject->getError() === UPLOAD_ERR_OK) {
                $fileName = $fileObject->getClientFilename(); // Sanitize or format filename as needed
                $targetPath = WWW_ROOT . 'img' . DS . 'product_images';

                // Ensure the target directory exists
                if (!file_exists($targetPath)) {
                    mkdir($targetPath, 0777, true);
                }

                $targetPath .= DS . $fileName;

                if ($fileObject->moveTo($targetPath)) {
                    $productData['image_path'] = 'product_images' . DS . $fileName;
                } else {
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                    return; // Stop execution if the file move fails
                }
            } elseif ($fileObject->getError() === UPLOAD_ERR_NO_FILE) {
                unset($productData['image_path']); // Do not modify the image_path if no file was uploaded
            } else {
                $this->Flash->error(__('Error uploading file. Please, try again.'));
                return; // Handle other file upload errors
            }

            $product = $this->Product->patchEntity($product, $productData);
            if ($this->Product->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product', 'products'));
    }







    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    public function edit($id = null)
    {
        $product = $this->Product->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $productData = $this->request->getData();


            $fileObject = $this->request->getUploadedFile('image_path');
            if ($fileObject && $fileObject->getError() === UPLOAD_ERR_OK) {
                $fileName = $fileObject->getClientFilename();
                $targetPath = WWW_ROOT . 'img' . DS . 'product_images' . DS . $fileName;


                $fileObject->moveTo($targetPath);
                $productData['image_path'] = $fileName;
            } elseif ($fileObject->getError() !== UPLOAD_ERR_OK && !$fileObject->getError() === UPLOAD_ERR_NO_FILE) {

                $this->Flash->error(__('File could not be uploaded. Please, try again.'));
                return;
            }

            $product = $this->Product->patchEntity($product, $productData);
            if ($this->Product->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }

        $this->set(compact('product'));
    }






    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Product->get($id);
        if ($this->Product->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index']);
    }
}
