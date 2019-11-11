<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
class BukuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Buku::leftJoin('kategoris', 'kategoris.id', '=', 'bukus.kategori_id')
                ->orderBy('bukus.id');
       
        $query->when($request->search, function ($query) use ($request) {
            $query->where(function($queryx) use ($request) {
                    $queryx->where('bukus.judul', 'like', "%{$request->search}%")
                            ->orWhere('bukus.isbn', 'like', "%{$request->search}%");
            });
        });
        
        $model = $query->select(
                    'bukus.id',
                    'bukus.judul',
                    'bukus.isbn',
                    'kategoris.nama as nama_kategori'
                )
                ->paginate(10)
                ->appends(request()
                ->query());
        
        return view('buku.index')->with([
           'search' => $request->search,
           'model' => $model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::get();
        return view('buku.create')->with([
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'isbn' => 'required|max:10',
            'judul' => 'required|max:100'
        ]);
        
        $model = new Buku;
        
        $model->kategori_id = $request->get('kategori_id');
        $model->isbn = $request->get('isbn');
        $model->judul = $request->get('judul');
        if($model->save()) {
            return redirect()->route('buku.index');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Buku::findOrFail($id);
        $kategori = Kategori::get();
        return view('buku.edit')->with([
            'id' => $id,
            'model' => $model,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'isbn' => 'required|max:10',
            'judul' => 'required|max:100',
        ]);
        
        $model = Buku::findOrFail($id);
        
        $model->kategori_id = $request->get('kategori_id');
        $model->isbn = $request->get('isbn');
        $model->judul = $request->get('judul');
        if($model->save()) {
            return redirect()->route('buku.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Buku::findOrFail($id);
        
        if($model->delete()) {
            return redirect()->route('buku.index');
        }
    }
}
