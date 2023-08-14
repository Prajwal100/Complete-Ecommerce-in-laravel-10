@extends('user.layouts.master')

@section('title', 'Editar Comentario')

@section('main-content')
<div class="card">
  <h5 class="card-header">Editar Comentario</h5>
  <div class="card-body">
    <form action="{{ route('user.post-comment.update', $comment->id) }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="name">Por:</label>
        <input type="text" disabled class="form-control" value="{{ $comment->user_info->name }}">
      </div>
      <div class="form-group">
        <label for="comment">Comentario</label>
        <textarea name="comment" id="" cols="20" rows="10" class="form-control">{{ $comment->comment }}</textarea>
      </div>
      <div class="form-group">
        <label for="status">Estado :</label>
        <select name="status" id="" class="form-control">
          <option value="">--Seleccionar Estado--</option>
          <option value="active" {{ (($comment->status == 'active') ? 'selected' : '') }}>Activo</option>
          <option value="inactive" {{ (($comment->status == 'inactive') ? 'selected' : '') }}>Inactivo</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info, .shipping-info {
        background: #ECECEC;
        padding: 20px;
    }
    .order-info h4, .shipping-info h4 {
        text-decoration: underline;
    }
</style>
@endpush
