<?php

namespace App\Lib\FormBuilder\Events;

use App\Lib\FormBuilder\Form;

class AfterFormCreation
{
    /**
     * The form instance.
     *
     * @var Form
     */
    protected $form;

    /**
     * Create a new after form creation instance.
     *
     * @param  Form $form
     * @return void
     */
    public function __construct(Form $form) {
        $this->form = $form;
    }

    /**
     * Return the event's form.
     *
     * @return Form
     */
    public function getForm() {
        return $this->form;
    }
}
