
<!-- On appelle la template qui contient la navbar -->
@extends("template")

@section("title", "Ma Todo List")

@section("content")
<div class="container pt-4">
    <div class="card">
        <div class="card-body">
            <!-- Action -->
            <form action="{{ route('todo.save') }}" method="POST" class="add">
                @csrf <!-- <<L'annotation ici ! -->
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="oi oi-pencil"></span></span>
                    <input id="texte" name="texte" type="text" class="form-control" placeholder="Prendre une note..." aria-label="My new idea" aria-describedby="basic-addon1">
                    @if (session('message'))
                        <p class="alert alert-danger">{{ session('message') }}</p>
                    @endif
                </div>
                <!-- boites à cocher pour les catégories -->
                <div class="form-group pt-2">
                    <select name="liste" id="liste">
                        <option value=""></option>
                        @foreach($listes as $liste)
                            <option value="{{ $liste->id }}">{{ $liste->libelle }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group pt-2">
                    <label>Catégories</label>
                        @foreach($categories as $categorie)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $categorie->id }}">
                                <label class="form-check-label">{{ $categorie->libelle }}</label>
                            </div>
                        @endforeach
                </div>
                <div class="priority-choice pt-2">
                    Importance : 
                    <input type="radio" name="priority" id="lowpr" value="0" checked><label for="lowpr"><i class="bi bi-reception-1"></i></label>
                    <input type="radio" name="priority" id="highpr" value="1"><label for="highpr"><i class="bi bi-reception-4"></i></label>
                </div>
                <div class="priority-choice pt-2">
                    Date butoire : 
                    <input type="datetime-local" name="due_date" id="due_date" class="form-control">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i></button>
                </div>
            </form>

            <!-- Liste -->
            <ul class="list-group">
                @forelse ($todos as $todo)
                    <li class="list-group-item">
                        <!-- Affichage de la priorité -->
                        @if ($todo->important == 0)
                            <i class="bi bi-reception-1"></i>
                        @elseif ($todo->important == 1)
                            <i class="bi bi-reception-4"></i>
                        @endif

                        <!-- Affichage du texte -->
                        @if($todo->due_date)
                            <span>{{ $todo->texte }} - {{ \Carbon\Carbon::parse($todo->due_date)->format('d/m/Y H:i') }}</span>
                        @else
                            <span>{{ $todo->texte }}</span>
                        @endif
                        <br>

                            @if ($todo->listes)
                                <label><i class="bi bi-list"></i> Appartient a la liste : {{ $todo->listes->libelle }}</label>
                                <br>
                            @endif

                            @if (!empty($todo->categories)&& $todo->categories->count()>0)
                                <label><i class="bi bi-boxes"></i> Categories :</label>
                                <div class="form-group">
                                    <ul>
                                    @foreach($todo->categories as $category)
                                        <li>{{$category->libelle}}</li>
                                    @endforeach
                                    </ul>
                                </div>
                                <br>
                            @endif 

                        <!-- Action à ajouter pour Terminer et supprimer -->
                        @if ($todo->termine === 0)
                            <!-- Si un ToDo n'est pas terminé, Action à ajouter pour terminer -->
                            <a href="{{ route('todo.done', ['id' => $todo->id]) }}" class="btn btn-success"><i class="bi bi-check2-square"></i></a>
                            <!--<button class="btn btn-primary btn-lg"><span class="fa fa-user"></span><br>Terminer</button>-->
                        @elseif ($todo->termine === 1)
                            <!-- Si un ToDo est terminé, Action à ajouter pour supprimer -->
                            <form action="{{ route('todo.delete', ['id' => $todo->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                            </form>
                            @if (session('validation'))
                                <p class="alert alert-success">{{ session('validation') }}</p>
                            @endif
                        @endif
                        @if ($todo->important == 0)
                            <!-- Action à ajouter pour monter la priorité -->
                            <a href="{{ route('todo.raise', ['id'=> $todo->id]) }}"><i class="bi bi-arrow-up-circle"></i></a>
                        @elseif ($todo->important == 1)
                            <!-- Action à ajouter pour descendre la priorité -->
                            <a href="{{ route('todo.lower', ['id' => $todo->id]) }}"><i class="bi bi-arrow-down-circle"></i></a>
                        @endif
                    </li>
                @empty
                    <li class="list-group-item text-center">C'est vide !</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection