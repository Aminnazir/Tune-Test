<?php
namespace App\Forms;

use App\Lib\FormBuilder\Field;
use App\Lib\FormBuilder\Form;

class ImporterForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|min:5',
                'label' => 'Name'
            ])
            ->add('type', Field::SELECT, [
                'rules' => 'required',
                'choices' => ['file' => 'File', 'url' => 'URL']
            ])
            ->add('file', Field::FILE, [
                'rules' => 'required_if:type,file|mimes:csv,txt',
                'conditions' => [
                    [
                        'field' => 'type',
                        'value' => 'file',
                        'op' => '=='
                    ]]
            ])
            ->add('url', Field::TEXT, [
                'rules' => 'required_if:type,url',
                'conditions' => [
                    [
                        'field' => 'type',
                        'value' => 'url',
                        'op' => '=='
                    ]]
            ])
            ->add('submit', Field::BUTTON_SUBMIT,['attr' => ['class'=> 'btn btn-primary']] );
    }
}
