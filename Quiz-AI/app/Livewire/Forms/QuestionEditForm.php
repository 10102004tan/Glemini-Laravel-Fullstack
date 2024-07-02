<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class QuestionEditForm extends Form
{
    //
    public $excerpt = '';
    public $answers = [];

    public $corrects = [];
    public $image;
}
