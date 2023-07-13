<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Database\Migrations\PeliculaEtiqueta;
use App\Database\Migrations\PeliculaImagen;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use App\Models\PeliculaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

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
        $peliculaModel = new PeliculaModel();
        if ($this->validate('pelicula')) {        
            $peliculaModel->update($id,[
            'titulo' => $this->request->getPost('Titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'categoria_id' => $this->request->getPost('categoria_id')
            ]);

            $this->asignar_imagen($id);
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
    public function descargar_imagen($imagenId)
    {
        $imagenModel = new ImagenModel();
        $imagen = $imagenModel->find($imagenId);
        if($imagen== null){
            return 'No hay, no existe';
        }
        //$imageRuta = WRITEPATH . 'uploads/peliculas/' . $imagen->imagen;
        $imageRuta = 'uploads/peliculas/' . $imagen->imagen;

        return $this->response->download($imageRuta,null)->setFileName('imagen.png');
        
    }
    public function borrar_imagen($peliculaId,$imagenId)
    {
        $imagenModel = new ImagenModel();
        $peliculaModel  = new PeliculaModel();
        $peliculaImagenModel = new PeliculaImagenModel();
        
        $imagen = $imagenModel->find($imagenId);
        //
        if($imagen== null){
            return 'No hay, no existe';
        }

        //$imageRuta = WRITEPATH . 'uploads/peliculas/' . $imagen->imagen;
        $imageRuta = 'uploads/peliculas/' . $imagen->imagen;
        
        //Eliminar Archivo unilateral
        $peliculaImagenModel->where('imagen_id',$imagenId)->where('pelicula_id',$peliculaId)->delete();
        
        if($peliculaImagenModel->where('imagen_id',$imagenId)->countAllResults() == 0){
            //Eliminar toda
            unlink($imageRuta);
            $imagenModel->delete($imagenId);
        }
        
        return redirect()->back()->with('mensaje','Imagen Eliminada');
    }


    private function asignar_imagen($peliculaId)
    {
        if($imagefile = $this->request->getFile('imagen')){
            if($imagefile->isValid()){
                $validated = $this->validate([
                    'uploaded[imagen]',
                    'mime_in[imagen,image/jpg,image/png,image/gif]',
                    'max_size[imagen,4096]'
                ]);

                //http://codeigniter.test/uploads/peliculas/1689113886_02056d8cfcd8e14dbf7e
                if($validated){
                    $imageNombre = $imagefile->getName();
                    $ext = $imagefile->guessExtension();

                    //$imagefile = $imagefile->move(WRITEPATH  . 'uploads/peliculas', $imageNombre);
                    $imagefile = $imagefile->move('../public/uploads/peliculas', $imageNombre);

                    $imagenModel = new ImagenModel();
                    $imagenId = $imagenModel->insert([
                        'imagen' =>  $imageNombre,
                        'extension' => $ext,
                        'data' => 'Pendiente'
                    ]);
                    $peliculaImagenModel = new PeliculaImagenModel();
                        $peliculaImagenModel->insert([
                            'imagen_id' => $imagenId,
                            'pelicula_id' => $peliculaId,
                        ]);
                }
                return $this->validator->listErrors();
            }
        }
    }
    public function etiqueta_delete($id,$etiqueta_id)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta->where('etiqueta_id',$etiqueta_id)
        ->where('pelicula_id',$id)->delete();
        echo '{"mensaje":"Eliminado"}';
        //return redirect()->back()->with('mensaje','Etiqueta Eliminada');
    }

    function image($image)
    {
        if (!$image) {
            $image = $this->request->getGet('image');
        }
        $name = WRITEPATH . 'uploads/peliculas/' . $image;

        if (!file_exists($name)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $fp = fopen($name, 'rb');

        header("Content-Type: image/png");
        header("Content-Length: " . filesize($name));

        fpassthru($fp);
        exit;
    }
}
