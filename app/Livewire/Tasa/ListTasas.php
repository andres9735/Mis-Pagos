<?php

namespace App\Livewire\Tasa;

use Livewire\Component;
use App\Models\Tasa;

class ListTasas extends Component
{
    public $tasas, $nombre, $descripcion, $porcentaje, $estado = true, $tasaId;
    public $isOpen = false;
    

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->resetInputFields();
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->porcentaje = '';
        $this->estado = true;
        $this->tasaId = null;
    }

    public function store()
    {
        // Validación de los campos
        $this->validate([
            'nombre' => 'required|string|max:255',
            'porcentaje' => 'required|numeric|min:0',
            'estado' => 'required|boolean',
        ]);

        // Crear o actualizar una tasa en la base de datos
        Tasa::updateOrCreate(['id' => $this->tasaId], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'porcentaje' => $this->porcentaje,
            'estado' => $this->estado,
        ]);

        // Mostrar mensaje de éxito
        session()->flash('message', $this->tasaId ? 'Tasa actualizada correctamente.' : 'Tasa creada correctamente.');

        // Cerrar el modal y resetear los campos
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        // Buscar la tasa y asignar sus valores a las propiedades del componente
        $tasa = Tasa::findOrFail($id);
        $this->tasaId = $id;
        $this->nombre = $tasa->nombre;
        $this->descripcion = $tasa->descripcion;
        $this->porcentaje = $tasa->porcentaje;
        $this->estado = $tasa->estado;

        $this->openModal();
    }

    public function delete($id)
    {
        $tasa = Tasa::find($id); // Busca la tasa por su ID
    
        if ($tasa) {
            $tasa->delete(); // Elimina la tasa si se encuentra
            session()->flash('message', 'Tasa eliminada correctamente.');
        } else {
            session()->flash('error', 'La tasa no se encontró o ya fue eliminada.');
        }
    }
    

    public function render()
    {
        $this->tasas = \App\Models\Tasa::all(); // Carga todas las tasas desde la base de datos
        return view('livewire.tasa.list-tasas');
    }
}
