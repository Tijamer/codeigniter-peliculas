<?php

namespace App\Controllers\Dashboard;
use App\Models\CategoriaModel;
use App\Controllers\BaseController;
class Categoria extends BaseController
{
    public function show($id)
    {
        
        $categoriaModel = new CategoriaModel();
        
        //var_dump($peliculaModel->asArray()->find($id));
        //var_dump($peliculaModel->asObject()->find($id));        
        echo view('dashboard/categoria/show',[
            'dashboard/categoria' => $categoriaModel ->find($id)
        ]);
    }
    public function create() 
    {
        $categoriaModel = new CategoriaModel();
        if ($this->validate('categorias')) {
            $categoriaModel->insert([
                'Titulos' =>$this->request->getPost('Titulo')
            ]);
        }else
        {
            session()->setFlashdata([
                'validation' =>$this->validator
            ]);
            return redirect()->back()->withInput();
        }
        return redirect()->to('/dashboard/categoria')->with('Mensaje','Registro Gestiondo de manera exitosa');
    }
    public function edit($id)
    {
        $categoriaModel = new CategoriaModel();

        echo view('dashboard/categoria/edit', [
            'categoria' => $categoriaModel->find($id)
        ]);
    }
    public function update($id)
    {
        if ($this->validate('categorias')) {
            $categoriaModel = new CategoriaModel();
            $categoriaModel->update($id,[
                'Titulos' => $this->request->getPost('Titulo')
            ]);
        }else
        {
            session()->setFlashdata([
                'validation' =>$this->validator
            ]);
            return redirect()->back()->withInput();
        }
        return redirect()->back()->with('Mensaje','Registro Gestiondo de manera exitosa');
    }
    public function delete($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->delete($id);
        session()->setFlashdata('Mensaje','Registro eliminado de manera exitosa');
        return redirect()->back();
        //return redirect()->back()->with('Mensaje','Registro Gestiondo de manera exitosa');
    }
    public function new() 
    {
        
        //var_dump(session()->destroy());
        echo view('dashboard/categoria/new',[
            'categoria'=>new CategoriaModel()
        ]);
        
    }
    public function index()
    {
        session()->set('key',array('k','c'));
         $categoriaModel = new CategoriaModel();

         echo view('dashboard/categoria/index',[
        'categoria' => $categoriaModel->findAll()
         ]);

        //echo 'aaa';
    }
}
