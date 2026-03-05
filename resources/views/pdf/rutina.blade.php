<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rutina - {{ $rutina->nombre }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            color: #111;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 6px;
        }
        .subtitle {
            color: #555;
            font-size: 12px;
        }
        .section {
            margin-top: 18px;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #e5e5e5;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f5f5f5;
        }
        .muted {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">{{ $rutina->nombre }}</div>
        @if(!empty($rutina->descripcion))
            <div class="subtitle">{{ $rutina->descripcion }}</div>
        @endif
        <div class="subtitle">Fecha de creación: {{ \Carbon\Carbon::parse($rutina->fecha_creacion)->format('d/m/Y') }}</div>
    </div>

    @forelse($ejercicios_por_dia as $dia => $lista)
        <div class="section">
            <div class="section-title">{{ $dia }}</div>
            <table>
                <thead>
                    <tr>
                        <th>Ejercicio</th>
                        <th>Series</th>
                        <th>Repeticiones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lista as $item)
                        <tr>
                            <td>{{ $item->ejercicio }}</td>
                            <td>{{ $item->total_series }}</td>
                            <td>{{ $item->repeticiones }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @empty
        <p class="muted">No hay ejercicios en esta rutina.</p>
    @endforelse
</body>
</html>
