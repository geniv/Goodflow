<?php

namespace App\Presenters;

// use Nette,
//     App\Model;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
    private $aa;

    public function startup() {
        parent::startup();

        $this->aa = array(
            array('ot1', 'ot2', 'ot3'),
            array('ot4', 'ot5', 'ot6'),
            array('ot7', 'ot8', 'ot9'),
            array('ot10', 'ot11', 'ot12'),
            array('ot13', 'ot14', 'ot15'),
            array('ot16', 'ot17', 'ot18'),
            array('ot19', 'ot20', 'ot21'),
            array('ot22', 'ot23', 'ot24'),
            array('ot25', 'ot26', 'ot27'),
            array('ot28', 'ot29', 'ot30'),
            );

        // $this->aa = array(
        //     rand() => 'a',
        //     rand() => 'b',
        //     rand() => 'c',
        //     );
    }

    public function renderDefault()
    {
        $this->template->anyVariable = 'any value';
    }

    public function createComponentPokusForm($name) {
        $f = new \Nette\Application\UI\Form($this, $name);

        $nahoda = array_rand($this->aa);

// dump('nahoda: '.$nahoda);
// dump($this);
// dump($this->getHttpRequest()->getHeaders());
// $n = $this->getSession()->getSection('nudla');
// dump($n);

        $f->addText('aa', 'lol');
        $f->addHidden('bbid', $nahoda);
        // pokud neni odeslano generuje nahodne, pokud se odesle bere id otazky!!
        $f->addRadioList('bb', 'super otazka', $f->isSubmitted() ? $this->aa[$f->getValues()['bbid']] : $this->aa[$nahoda])
                // ->setDefaultValue(isset($_POST['bb']) ? $o_POST['bb'] : null)
                // ->addRule(Nette\Forms\Form::FILLED, 'je povinnee!!!');
                ->setRequired('toto radio je povinne!!');

        $f->addSubmit('send', 'frr');

        $f->onSuccess[] = function(\Nette\Application\UI\Form $form, $values) {
            dump('odeslano!!', $values);
        };

        return $f;
    }

}
