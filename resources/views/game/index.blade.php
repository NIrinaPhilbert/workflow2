@extends('layouts.app')

@section('content')
<h1>Ajax</h1>
<form method="POST" action="">
    {{ csrf_field() }}
    <div class="container">
        <div class="form-group">
            <select id="plateforme" class="form-control">
                <option value="1">DEPSI</option>
                <option value="3">DRH</option>
                <option value="6">DPLMT</option>
            </select>
        </div>
        <button class="btn btn-success confirm-search" id="confirm-search">Rechercher</button>
        <br>
        <table class="table table-hover" id="resultsTable" style="display:none;">
            <thead>
                <th>Service</th>
            </thead>
            <tbody id="results">
            </tbody>

        </table>
    </div>       
</form>
@endsection