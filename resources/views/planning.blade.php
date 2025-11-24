
<!-- On appelle la template qui contient la navbar -->
@extends("template")

@section("title", "Ma Todo List")

@section("content")
<div class="container mt-5">
    <h1 class="mb-4">Planning des Todos</h1>

    @if($todos->isEmpty())
        <p>Aucun todo actif avec une date butoire.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Texte</th>
                    <th>Date butoire</th>
                    <th>Priorité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($todos as $todo)
                    <tr @if($todo->due_date < now()) class="table-danger" @endif>
                        <td>{{ $todo->texte }}</td>
                        <td>{{ \Carbon\Carbon::parse($todo->due_date)->format('d/m/Y H:i') }}</td>
                        <td>
                            @if ($todo->important == 1)
                                <span class="badge bg-danger">Haute</span>
                            @elseif ($todo->important == 0)
                                <span class="badge bg-secondary">Normale</span>
                            @endif
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
