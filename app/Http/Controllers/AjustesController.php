<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;

class AjustesController extends Controller
{

    public function index()
    {
        $ajustes = Ajuste::latest()->get();
        return view('panel.ajuste')->with('ajustes', $ajustes);
    }

    public function store(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'nombre_software' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'discord' => 'nullable|string|max:255',
            'precio_membresia' => 'nullable|numeric|min:0',
            'precio_membresia_descripcion' => 'nullable|string',
            'metodo_pago_1' => 'nullable|string|max:255',
            'imagen_metodo_pago_1' => 'nullable|image|max:2048',
            'metodo_pago_2' => 'nullable|string|max:255',
            'imagen_metodo_pago_2' => 'nullable|image|max:2048',
            'metodo_pago_3' => 'nullable|string|max:255',
            'imagen_metodo_pago_3' => 'nullable|image|max:2048',
            'metodo_pago_4' => 'nullable|string|max:255',
            'imagen_metodo_pago_4' => 'nullable|image|max:2048',
        ]);
    
        // Subir las imágenes y almacenar las rutas
        $imageFields = [
            'imagen_metodo_pago_1',
            'imagen_metodo_pago_2',
            'imagen_metodo_pago_3',
            'imagen_metodo_pago_4',
        ];
        $destinationPath = 'images/pagos/';
    
        foreach ($imageFields as $imageField) {
            if ($request->hasFile($imageField)) {
                $file = $request->file($imageField);
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path($destinationPath), $filename);
                $validated[$imageField] = $destinationPath . $filename;
            }
        }
    
        // Crear el ajuste con los datos validados
        $ajuste = Ajuste::create($validated);
    
        return redirect()->route('admin.ajustes')->with('success', 'Ajuste creado exitosamente.');
    }
    
  

    
    public function edit(Ajuste $ajuste)
    {
        return view('panel.ajuste_edit')->with('ajuste', $ajuste);
    }

   
    public function update(Request $request, Ajuste $ajuste)
    {
        // Validar los datos
        $validated = $request->validate([
            'nombre_software' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'discord' => 'nullable|string|max:255',
            'precio_membresia' => 'nullable|numeric|min:0',
            'precio_membresia_descripcion' => 'nullable|string',
            'metodo_pago_1' => 'nullable|string|max:255',
            'imagen_metodo_pago_1' => 'nullable|image|max:2048',
            'metodo_pago_2' => 'nullable|string|max:255',
            'imagen_metodo_pago_2' => 'nullable|image|max:2048',
            'metodo_pago_3' => 'nullable|string|max:255',
            'imagen_metodo_pago_3' => 'nullable|image|max:2048',
            'metodo_pago_4' => 'nullable|string|max:255',
            'imagen_metodo_pago_4' => 'nullable|image|max:2048',
        ]);
    
        // Directorio de imágenes
        $destinationPath = 'images/pagos/';
    
        // Manejar imágenes dinámicamente
        $imageFields = [
            'imagen_metodo_pago_1',
            'imagen_metodo_pago_2',
            'imagen_metodo_pago_3',
            'imagen_metodo_pago_4',
        ];
    
        foreach ($imageFields as $imageField) {
            if ($request->hasFile($imageField)) {
                // Eliminar imagen anterior si existe
                if ($ajuste->$imageField && file_exists(public_path($ajuste->$imageField))) {
                    unlink(public_path($ajuste->$imageField));
                }
    
                // Guardar nueva imagen
                $file = $request->file($imageField);
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path($destinationPath), $filename);
    
                // Actualizar la ruta en el campo correspondiente
                $validated[$imageField] = $destinationPath . $filename;
            }
        }
    
        // Actualizar los datos del ajuste
        $ajuste->update($validated);
    
        return redirect()->route('admin.ajustes')->with('success', 'Ajuste actualizado exitosamente.');
    }
    

   
    public function destroy(Ajuste $ajuste)
    {
        $ajuste->delete();
        return redirect()->route('admin.ajustes')->with('success', 'Ajuste eliminado exitosamente.');
    }
}
