<?php

namespace App\Classe;

use App\Entity\Auteur;
use App\Entity\Genre;

class  Search
{
    /**
     * @var string
     */
    public  $string = '';

    /**
     * @var Genre[]
     */
    public $genres = [];

    /**
     * @var Auteur[]
     */
    public $auteurs = [];
}