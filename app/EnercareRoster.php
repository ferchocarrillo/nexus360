<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnercareRoster extends Model
{
    protected $connection = 'sqlsrvenercare';
    protected $table = 'tbrosterenercare';

}
