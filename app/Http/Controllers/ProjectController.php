<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return response()->json(['projects' => $projects], 200);
    }

     public function create()
    {
          // Puedes retornar un mensaje de error ya que la creación de proyectos no se realiza a través de vistas en una API
          return response()->json(['error' => 'No se permite crear proyectos a través de esta ruta.'], 405);
    }

  public function store(Request $request)
{
    try {
        $request->validate([
            'link' => 'required|url',
            'category' => 'required|array|max:2',
            'description' => 'required|string|max:380',
        ]);

        $project = new Project([
            'link' => $request->input('link'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
        ]);

        $project->save();

        return response()->json(['message' => 'Proyecto creado exitosamente'], 201);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Captura la excepción de validación y retorna un mensaje personalizado
        return response()->json(['error' => 'Complete los campos obligatorios. Ej. URL: http://...'], 422);
    }
}

     public function show($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['error' => 'Proyecto no encontrado'], 404);
        }

        return response()->json(['project' => $project], 200);
    }


    public function edit($id)
    {
        // Puedes retornar un mensaje de error ya que la edición de proyectos no se realiza a través de vistas en una API
        return response()->json(['error' => 'No se permite editar proyectos a través de esta ruta.'], 405);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'link' => 'required|url',
            'category' => 'required|array|max:2',
            'description' => 'required|string|max:380',
        ]);

        $project = Project::find($id);

        if (!$project) {
            return response()->json(['error' => 'Proyecto no encontrado'], 404);
        }

        $project->link = $request->input('link');
        $project->category = $request->input('category');
        $project->description = $request->input('description');
        $project->save();

        return response()->json(['message' => 'Proyecto actualizado exitosamente'], 200);
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['error' => 'Proyecto no encontrado'], 404);
        }

        $project->delete();

        return response()->json(['message' => 'Proyecto eliminado exitosamente'], 200);
    }
}
