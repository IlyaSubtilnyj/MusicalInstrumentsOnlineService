<?php

namespace App\DBAL;

class EnumNationType extends EnumType
{
    protected $name = 'enumnation';
    protected $values = array('country', 'sovereign state', 'dependent territory', 'region', 'other');
}