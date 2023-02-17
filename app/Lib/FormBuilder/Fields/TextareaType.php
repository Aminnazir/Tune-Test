<?php

namespace App\Lib\FormBuilder\Fields;

class TextareaType extends FormField
{

    /**
     * @inheritdoc
     */
    protected function getTemplate()
    {
        return 'textarea';
    }
}
