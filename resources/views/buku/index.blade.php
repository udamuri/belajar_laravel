@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Buku</div>
                <div class="row" >
                    <div class="col-md-8" >
                        <a href="{{route('buku.create')}}" class="btn btn-primary">Tambah Buku</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{route('buku.index')}}">
                        <div class="row" >
                            <div class="col-md-10" >
                                <input type="text" class="form-control" name="search" value="{{$search}}" >
                            </div>
                            <div class="col-md-2" >
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($model as $value)
                            <tr>
                                <td>{{$value->isbn}}</td>
                                <td>{{$value->judul}}</td>
                                <td>{{$value->nama_kategori}}</td>
                                <td>
                                    <a href="{{route('buku.edit', ['id' => $value->id])}}" >Edit</a>
                                    <a href="{{route('buku.destroy', ['id' => $value->id])}}" >Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div>
                        {{$model->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

