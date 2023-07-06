<?php

namespace App\Controllers\Dashboard;
use App\Models\CategoriaModel;
use App\Controllers\BaseController;
class Categoria extends BaseController
{
    public function show($id)
    {
        
        $categoriaModel = new CategoriaModel();        
        echo view('dashboard/categoria/show',[
            'dashboard/categoria' => $categoriaModel ->find($id)
        ]);
    }
    public function create() 
    {

        $categoriaModel = new CategoriaModel();
        $categoriaModel->insert([
            'titulos' =>$this->request->getPost('Titulo')
        ]);
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
        $categoriaModel = new CategoriaModel();
        $categoriaModel->update($id,[
            'titulos' => $this->request->getPost('Titulo')
        ]);
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
            'categoria'=>[
                'titulos'=>''
            ]
        ]);
        
    }
    public function index()
    {
        //session()->set('key',array('k','c'));
        $categoriaModel = new CategoriaModel();

        echo view('dashboard/categoria/index',[
            'categoria' => $categoriaModel->findAll()
        ]);
    }
}
