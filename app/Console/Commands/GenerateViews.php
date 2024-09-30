<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateViews extends Command
{
    protected $signature = 'make:views';
    protected $description = 'Generar vistas para los modelos de la aplicación';

    public function handle()
    {
        $models = ['Usuario', 'Producto', 'Carrito', 'Pedido', 'Categoria', 'Pago'];

        foreach ($models as $model) {
            $this->createView($model);
        }

        $this->info('Vistas generadas exitosamente.');
    }

    protected function createView($model)
    {
        $viewPath = resource_path("views/{$model}");
        
        // Crear el directorio si no existe
        if (!File::exists($viewPath)) {
            File::makeDirectory($viewPath, 0755, true);
        }

        // Crear las vistas básicas
        $views = ['index', 'create', 'edit', 'show'];

        foreach ($views as $view) {
            $filePath = "{$viewPath}/{$view}.blade.php";
            if (!File::exists($filePath)) {
                File::put($filePath, $this->getViewContent($model, $view));
            }
        }

        $this->info("Vistas para $model creadas.");
    }

    protected function getViewContent($model, $view)
    {
        return <<<EOT
{{-- Vista para $model - $view --}}
@extends('layouts.app')

@section('content')
    <h1>{$model} - $view</h1>
    {{-- Contenido para la vista de $view --}}
@endsection
EOT;
    }
}
