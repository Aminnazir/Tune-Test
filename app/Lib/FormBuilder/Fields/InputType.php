<?php

namespace  App\Lib\FormBuilder\Fields;

class InputType extends FormField
{

    /**
     * @inheritdoc
     */
    protected function getTemplate()
    {
        return 'text';
    }

}
