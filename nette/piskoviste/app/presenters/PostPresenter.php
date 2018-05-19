<?php

namespace App;

use Nette,
    Model;

/**
 * prezenter pro post
 *
 * @package unstable
 * @author geniv
 * @version 1.00
 */
class PostPresenter extends BasePresenter
{
    /** @var Nette\Database\Context */
    private $database;

    // konstruktor tridy s kontextem
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }



    // tovarna formulare
    protected function createComponentFormFactory() {
        $form = new Nette\Application\UI\Form;
        $form->addText('name', 'Jméno:')
            ->setRequired();

        $form->addText('email', 'Email:');

        $form->addTextArea('content', 'Komentář:')
            ->setRequired();

        $form->addSubmit('send', 'Publikovat komenntář');

        $form->onSuccess[] = $this->formSuccessCallback;

        return $form;
    }

    // callback
    public function formSuccessCallback($form) {
        $values = $form->getValues();
        $postId = $this->getParameter('postId');

        $this->database->table('comments')->insert(array(
            'post_id' => $postId,
            'name' => $values->name,
            'email' => $values->email,
            'content' => $values->content,
        ));

        $this->flashMessage('Děkuji za stížnost!, si tě najdu! počky!', 'success');
        $this->redirect('this');    // presmerovani na sebe sama
    }



    // vytvareni postu
    public function createComponentPostForm() {
        $form = new Nette\Application\UI\Form;

        $form->addText('title', 'Titulek:')
            ->setRequired();
        $form->addTextArea('content', 'Obsah:')
            ->setRequired();

        $form->addSubmit('send', 'Uložit a warezit');
        $form->onSuccess[] = $this->addPostCallback;

        return $form;
    }

    public function addPostCallback($form) {
        $values = $form->getValues();
        $postId = $this->getParameter('postId');

        $post = $this->database->table('posts')->insert($values);

        $this->flashMessage("Příspěvek byl publikován.a delej!", 'success');
        $this->redirect('show', $post->id);
    }

    // kliknuti na: create
    public function actionCreate() {
        if (!$this->user->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
    }


    //editace, klikuti na: edit
    public function actionEdit($postId) {
        if (!$this->user->isLoggedIn()) {
            $this->redirect('Sign:in');
        }

        $post = $this->database->table('posts')->get($postId);
        if (!$post) {
            $this->error('Příspěvek nebyl nalezen');
        }
        $this['postForm']->setDefaults($post->toArray());
    }

    public function postFormSucceeded($form) {
        if (!$this->user->isLoggedIn()) {
            $this->error('Pro vytvoření, nebo editování příspěvku se musíte přihlásit.');
        }

        $values = $form->getValues();
        $postId = $this->getParameter('postId');

        if ($postId) {
            $post = $this->database->table('posts')->get($postId);
            $post->update($values);
        } else {
            $post = $this->database->table('posts')->insert($values);
        }

        $this->flashMessage('Příspěvek byl úspěšně publikován.', 'success');
        $this->redirect('show', $post->id);
    }



    // renderovani
    public function renderShow($postId) {
        $post = $this->database->table('posts')->get($postId);
        if (!$post) {
            // $this->error('stranka neexistuje, zobrazit relevantni nebo posledni funkceni nebo redirect');

            $this->redirect('Homepage:default');
        }
        $this->template->post = $post;

        $this->template->comments = $post->related('comment')->order('created_at');
    }
}