
<!-- On appelle la template qui contient la navbar -->
@extends("template")

@section("title", "Ma Todo List")

@section("content")
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h4>Listes</h4>
        </div>
        <div class="card-body">
            <!-- Action -->
            <form action="{{ route('liste.save') }}" method="POST" class="add">
                @csrf <!-- <<L'annotation ici ! -->
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="oi oi-pencil"></span></span>
                    <input id="texte" name="texte" type="text" class="form-control" placeholder="Nom de la liste" aria-label="My new list" aria-describedby="basic-addon1">
                    @if (session('message'))
                        <p class="alert alert-danger">{{ session('message') }}</p>
                    @endif
                </div>
                <!-- boites à cocher pour les catégories -->
                <div class="form-group pt-2">
                    <label>Catégories</label>
                        @foreach($todos as $todo)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="todos[]" value="{{ $todo->id }}">
                                <label class="form-check-label">{{ $todo->texte }}</label>
                            </div>
                        @endforeach
                </div>
                <div class="priority-choice pt-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i></button>
                </div>
            </form>

            <div class="row mt-4">

                @foreach($listes as $liste)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">{{ $liste->libelle }}</h5>
                            </div>

                            <div class="card-body">
                                @if($liste->todos->isEmpty())
                                    <p class="text-muted">Aucune todo associée.</p>
                                @else
                                    <ul class="list-group">
                                        @foreach($liste->todos as $todo)
                                            <li class="list-group-item">
                                                {{ $todo->texte }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


            <a href="{{ route('todo.liste') }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Retour à la liste</a>
        </div>
    </div>
</div>
@endsection