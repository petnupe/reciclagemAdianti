<?php

class FilmeForm extends TPage 
{
    private $form;
    
    public function __construct()
    {
        parent::__construct();
        $this->form = new TQuickForm('form_filme');
        $this->form->setFormTitle('Filme');
        $this->form->class = 'tform';
        
        $id = new TEntry('id');
        $titulo = new TEntry('titulo');
        $diretor = new TEntry('diretor');
        $id_suporte = new TCombo('id_suporte');
        $id_genero = new TCombo('id_genero');
        $dt_lcto = new TDate('dt_lcto');
        $duracao = new TEntry('duracao');
        
        $id->setEditable(false);
        $duracao->setMask('999');
        $id_suporte->addItems([1 => 'DVD', 2 => 'Blu Ray', 3 => 'VHS', 4 => 'Betamax']);
        $id_genero->addItems([1 => 'Romance', 2 => 'Comédia', 3 => 'Ficção']);
        
        $this->form->addQuickField('ID', $id, 100);
        $this->form->addQuickField('Titulo', $titulo, 200);
        $this->form->addQuickField('Diretor', $diretor, 200);
        $this->form->addQuickField('Suporte', $id_suporte, 100);
        $this->form->addQuickField('Genero', $id_genero, 100);
        $this->form->addQuickField('Lancamento', $dt_lcto, 100);
        $this->form->addQuickField('Duração', $duracao, 100);
        
        $save = new TAction(array($this, 'onSave'));
        $this->form->addQuickAction('Salvar', $save, 'ico_save.png');

        $clear = new TAction(array($this, 'onClear'));
        $this->form->addQuickAction('Limpar', $clear, 'ico_clear.png');
        parent::add($this->form);
    }
    
    public function onSave()
    {
        try {
            TTransaction::open('teste');
            $object = $this->form->getData('Filme');
            $object->store();
            TTransaction::close();
            new TMessage('info', 'Registro salvo com sucesso!');
            $object = $this->form->setData($object);
            
        } catch(Exception $e) {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    public function onClear() 
    {
        $this->form->clear();
    }
    
    public function onEdit($param) 
    {
        try {
            TTransaction::open('teste');
            $key = $param['key'];
            $obj = new Filme($key);
            $this->form->setData($obj);
            TTransaction::close();
        } catch(Exception $e) {
            new TMessage('error', $e->getMessage());
        }
    }
}