<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; color: #212529;">
    <h2>Nuevo reporte registrado</h2>
    <table cellpadding="6" style="border-collapse: collapse;">
        <tr>
            <td><strong>Título</strong></td>
            <td>{{ $report->title }}</td>
        </tr>
        <tr>
            <td><strong>Descripción</strong></td>
            <td>{{ $report->description }}</td>
        </tr>
        <tr>
            <td><strong>Área</strong></td>
            <td>{{ $report->area->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Reportado por</strong></td>
            <td>{{ $report->user->name ?? 'N/A' }} ({{ $report->email }})</td>
        </tr>
        <tr>
            <td><strong>Teléfono</strong></td>
            <td>{{ $report->phone }}</td>
        </tr>
    </table>
    <p style="margin-top: 20px;">
        <a href="{{ route('reports.show', $report->id) }}">Ver el reporte en Opsdesk</a>
    </p>
</body>
</html>