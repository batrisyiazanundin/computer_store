<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * users Controller
 *
 * @property \App\Model\Table\usersTable $users
 * @method \App\Model\Entity\users[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class usersController extends AppController
{
    public function login()
    {        
        if ($this->request->is('post')) {
            $users = $this->Auth->identify();
            if ($users) {
                $this->Auth->setusers($users);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your usersname or password is incorrect.');
        }
    }

     


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id users id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $users = $this->users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('users'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $users = $this->users->newEmptyEntity();
        if ($this->request->is('post')) {
            $users = $this->users->patchEntity($users, $this->request->getData());
            if ($this->users->save($users)) {
                $this->Flash->success(__('The users has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users could not be saved. Please, try again.'));
        }
        $this->set(compact('users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id users id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $users = $this->users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $users = $this->users->patchEntity($users, $this->request->getData());
            if ($this->users->save($users)) {
                $this->Flash->success(__('The users has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users could not be saved. Please, try again.'));
        }
        $this->set(compact('users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id users id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $users = $this->users->get($id);
        if ($this->users->delete($users)) {
            $this->Flash->success(__('The users has been deleted.'));
        } else {
            $this->Flash->error(__('The users could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
