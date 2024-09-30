{{-- resources/views/producto/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Listado de Productos')

@section('content')
    <style>
        /* Estilos CSS directamente en el archivo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            color: white;
            text-decoration: none;
        }

        .btn-info {
            background-color: #17a2b8;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-danger {
            background-color: #dc3545;
        }
    </style>

    <h1>Producto - Index</h1>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Iterar sobre los productos y mostrarlos en la tabla --}}
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>
                            <a href="{{ route('producto.show', $producto->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('producto.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('producto.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
