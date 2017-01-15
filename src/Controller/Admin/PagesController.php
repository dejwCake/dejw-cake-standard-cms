<?php
namespace DejwCake\StandardCMS\Controller\Admin;

use DejwCake\StandardCMS\Controller\Admin\AppController;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\ConflictException;
use Cake\Routing\Router;
use Cake\Event\Event;
use Cake\Log\Log;

/**
 * Pages Controller
 *
 * @property \DejwCake\StandardCMS\Model\Table\PagesTable $Pages
 */
class PagesController extends AppController
{

    //TODO add metaitem to views
    //TODO add created_by also to metaitems


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
        $this->paginate = [
            'contain' => ['Users']
        ];
        $pages = $this->paginate($this->Pages);

        $views = $this->getViews();
        $this->set(compact('pages'));
        $this->set(compact('views'));
        $this->set('_serialize', ['pages', 'views']);
    }

    /**
     * View method
     *
     * @param string|null $id Page id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $page = $this->Pages->find('translations', [
            'contain' => ['Users', 'MetaItems']
        ])->where(['Pages.id' => $id])->firstOrFail();

        $this->set('page', $page);
        $this->set('_serialize', ['page']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $page = $this->Pages->newEntity();
        if ($this->request->is('post')) {
            $this->request->data('created_by', $this->Auth->user('id'));
            $page = $this->Pages->patchEntity($page, $this->request->data, [
                'translations' => true
            ]);
            debug($page);
            if ($this->Pages->save($page)) {
                $this->Flash->success(__('The page has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                Log::error('Entity could not be saved. Entity: '.var_export($page, true));
                $this->Flash->error(__('The page could not be saved. Please, try again.'));
            }
        }
        $views = $this->getViews();
        $this->set(compact('page'));
        $this->set(compact('views'));
        $this->set('_serialize', ['page', 'views']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Page id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $page = $this->Pages->find('translations', [
            'contain' => ['MetaItems' => ['finder' => 'translations']]
        ])->where(['Pages.id' => $id])->firstOrFail();
//        debug($page);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $page = $this->Pages->patchEntity($page, $this->request->data, [
                'translations' => true
            ]);
//            debug($page);
            if ($this->Pages->save($page)) {
                $this->Flash->success(__('The page has been saved.'));

//                return $this->redirect(['action' => 'index']);
            } else {
                Log::error('Entity could not be saved. Entity: '.var_export($page, true));
                $this->Flash->error(__('The page could not be saved. Please, try again.'));
            }
        }
        $views = $this->getViews();
        $this->set(compact('page'));
        $this->set(compact('views'));
        $this->set('_serialize', ['page', 'views']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $page = $this->Pages->get($id);
        if ($this->Pages->delete($page)) {
            $this->Flash->success(__('The page has been deleted.'));
        } else {
            $this->Flash->error(__('The page could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Enable method
     *
     * @param string|null $id Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enable($id = null)
    {
        $this->request->allowMethod(['post']);
        $page = $this->Pages->get($id);

        $page->changeEnableStatus();
        if ($this->Pages->save($page)) {
            $this->Flash->success(__('The page status has been changed.'));
        } else {
            $this->Flash->error(__('The page status could not be changed. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    protected function getViews() {
        return array('default' => __('Default'), 'view_contact' => __('Contact'));
    }
}
