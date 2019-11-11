@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Form Create</div>

                <div class="card-body">
                    <form action="{{route('buku.store')}}" method="POST" >
                        @csrf
                        <div>
                            <label for="judul">Judul</label>
                            <input type="text" id="judul" name="judul" value="{{old('judul')}}" >
                            @error('judul')
                            <strong>{{$message}}</strong>
                            @enderror
                        </div>
                        <div>
                            <label for="ISBN">ISBN</label>
                            <input type="text" id="isbn" name="isbn" value="{{old('isbn')}}" >
                            @error('isbn')
                            <strong>{{$message}}</strong>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="kategori_id">Kategori</label>
                            <select id="kategori_id" name="kategori_id" >
                                @foreach($kategori as $key => $value)
                                <option value="{{$value->id}}"
                                    @if ($value->id == old('kategori_id'))
                                    selected="selected"
                                    @endif
                                    >{{$value->nama}}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                            <strong>{{$message}}</strong>
                            @enderror
                        </div>
                        <button type="submit" >Simpan</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

