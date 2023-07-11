<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Database\Migrations\PeliculaEtiqueta;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use App\Models\PeliculaModel;
class Pelicula extends BaseController
{
    
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();
        //var_dump($peliculaModel->asArray()->find($id));
        //var_dump($peliculaModel->asObject()->find($id));
        //var_dump($peliculaModel->getImagesById($id));
        //var_dump($imagenModel->getPeliculasById(2));

        echo view('dashboard/pelicula/show',[
            'pelicula' => $peliculaModel->find($id),
            'imagenes' => $peliculaModel->getImagesById($id),
            'etiquetas' => $peliculaModel->getEtiquetasById($id),
        ]);
    }
    public function new() 
    {
        $categoriaModel = new  CategoriaModel();
        echo view('dashboard/pelicula/new',[
            'pelicula'=> new PeliculaModel(),
            'categorias' => $categoriaModel->find()
        ]);
        
    }
    public function create() 
    {
        $peliculaModel = new PeliculaModel();
        if ($this->validate('pelicula')) {
            $peliculaModel->insert([
                'titulo' =>$this->request->getPost('Titulo'),
                'descripcion' =>$this->request->getPost('descripcion'),
                'categoria_id' =>$this->request->getPost('categoria_id')
            ]);
        }else
        {
            session()->setFlashdata([
                'validation' =>$this->validator
            ]);
            return redirect()->back()->withInput();
        }
        
        return redirect()->to('/dashboard/pelicula')->with('Mensaje','Registro Gestiondo de manera exitosa');
    }
    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new  CategoriaModel();

        echo view('dashboard/pelicula/edit',[
            'pelicula'=> $peliculaModel->asObject()->find($id),
            'categorias' => $categoriaModel->find()
        ]);
    }
    public function update($id)
    {
        
        if ($this->validate('pelicula')) {        
            $peliculaModel = new PeliculaModel();
            $peliculaModel->update($id,[
            'titulo' => $this->request->getPost('Titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'categoria_id' => $this->request->getPost('categoria_id')
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
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);
         session()->setFlashdata('Mensaje','Registro eliminado de manera exitosa');
        return redirect()->back();
        //return redirect()->back()->with('Mensaje','Registro Gestiondo de manera exitosa');
    }    
    public function index()
    {
        $peliculaModel = new PeliculaModel();

        //$this->generar_imagen();
        $this->asignar_imagen();
         

        
        $data = [
            'pelicula' => $peliculaModel->select('peliculas.*, categorias.titulos as categoria')->join('categorias','categorias.id = peliculas.categoria_id')->find()
            
        ];
        
        echo view('dashboard/pelicula/index',$data);
    }

    public function etiquetas($id)
    {
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        $peliculaModel = new PeliculaModel();

        $etiquetas = [];
        if ($this->request->getGet('categoria_id')) {
            $etiquetas = $etiquetaModel
            ->where('categoria_id', $this->request->getGet('categoria_id'))
            ->findAll();
        }
        echo view('dashboard/pelicula/etiquetas',[
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->findAll(),
            'categoria_id' => $this->request->getGet('categoria_id'),
            'etiquetas' => $etiquetas,
        ]);
    }
    public function etiquetas_post($id)
    {
        $peliculaEtiquetaModel = new  PeliculaEtiquetaModel();
        
        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModel->where('etiqueta_id',$etiquetaId)->where('pelicula_id',$peliculaId)->first();

        if(!$peliculaEtiqueta){
            $peliculaEtiquetaModel->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId
            ]);
        }
        return redirect()->back();

    }
    private function generar_imagen()
    {
        $imagenModel = new ImagenModel();
        $imagenModel->insert([
            'imagen' => date('Y-m-d H:m:s'),
            'extension' => 'Pendiente',
            'data' => 'Pendiente'
        ]);
    }
    private function asignar_imagen()
    {
        $peliculaImagenModel = new PeliculaImagenModel();
        $peliculaImagenModel->insert([
            'imagen_id' => 2,
            'pelicula_id' => 7,
        ]);
    }
    public function etiqueta_delete($id,$etiqueta_id)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta->where('etiqueta_id',$etiqueta_id)
        ->where('pelicula_id',$id)->delete();
        echo '{"mensaje":"Eliminado"}';
        //return redirect()->back()->with('mensaje','Etiqueta Eliminada');
    }
}
