<?php

class Filme extends TRecord
{
    const TABLENAME  = 'filme';
    const PRIMARYKEY = 'id';
    const IDPOLICY   = 'max'; 

    public function __construct ($id = null)
    {
        parent::__construct($id);
        parent::addAttribute('titulo');
        parent::addAttribute('diretor');
        parent::addAttribute('id_suporte');
        parent::addAttribute('id_genero');
        parent::addAttribute('dt_lcto');
        parent::addAttribute('duracao');
    }
}

?>
<!-- 
create table filme
(
        id integer primary key not null,
        titulo text,
        diretor text,
        id_suporte integer,
        id_genero integer,
        dt_lcto date,
        duracao int
);
-->