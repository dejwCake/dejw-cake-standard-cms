<?php
namespace DejwCake\StandardCMS\Controller\Admin;

use DejwCake\StandardCMS\Controller\Admin\AppController;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\ConflictException;
use Cake\Routing\Router;
use Cake\Event\Event;
use Cake\Log\Log;

/**
 * MetaItems Controller
 *
 * @property \DejwCake\StandardCMS\Model\Table\MetaItemsTable $MetaItems
 */
class MetaItemsController extends AppController
{

    /**
     * Before filter callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * Check if the provided user is authorized for the request.
     *
     * @param array|\ArrayAccess|null $user The user to check the authorization of.
     *   If empty the user fetched from storage will be used.
     * @param \Cake\Network\Request|null $request The request to authenticate for.
     *   If empty, the current request will be used.
     * @return bool True if $user is authorized, otherwise false
     */
    public function isAuthorized($user = null) {
        return parent::isAuthorized($user);;
    }

        /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $metaItems = $this->paginate($this->MetaItems);

        $this->set(compact('metaItems'));
        $this->set('_serialize', ['metaItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Meta Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $metaItem = $this->MetaItems->find('translations', [
            'contain' => []
        ])->where(['id' => $id])->firstOrFail();

        $this->set('metaItem', $metaItem);
        $this->set('_serialize', ['metaItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $metaItem = $this->MetaItems->newEntity();
        if ($this->request->is('post')) {
            $metaItem = $this->MetaItems->patchEntity($metaItem, $this->request->data, [
                'translations' => true
            ]);
            if ($this->MetaItems->save($metaItem)) {
                $this->Flash->success(__('The meta item has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                Log::error('Entity could not be saved. Entity: '.var_export($metaItem, true));
                $this->Flash->error(__('The meta item could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('metaItem'));
        $this->set('_serialize', ['metaItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Meta Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $metaItem = $this->MetaItems->find('translations', [
            'contain' => []
        ])->where(['id' => $id])->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $metaItem = $this->MetaItems->patchEntity($metaItem, $this->request->data, [
                'translations' => true
            ]);
            if ($this->MetaItems->save($metaItem)) {
                $this->Flash->success(__('The meta item has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                Log::error('Entity could not be saved. Entity: '.var_export($metaItem, true));
                $this->Flash->error(__('The meta item could not be saved. Please, try again.'));
            }
        }
        $metaItem = $this->editTranslated($metaItem);
        $this->set(compact('metaItem'));
        $this->set('_serialize', ['metaItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Meta Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $metaItem = $this->MetaItems->get($id);
        if ($this->MetaItems->delete($metaItem)) {
            $this->Flash->success(__('The meta item has been deleted.'));
        } else {
            $this->Flash->error(__('The meta item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Enable method
     *
     * @param string|null $id Meta Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enable($id = null)
    {
        $this->request->allowMethod(['post']);
        $metaItem = $this->MetaItems->get($id);

        $metaItem->changeEnableStatus();
        if ($this->MetaItems->save($metaItem)) {
            $this->Flash->success(__('The meta item status has been changed.'));
        } else {
            $this->Flash->error(__('The meta item status could not be changed. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
