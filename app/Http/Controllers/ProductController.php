<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $products = Product::query();

        if ($request->ajax()) {
            return Datatables::of($products)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // kita tambahkan button edit dan hapus
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm editProduk"><i class="fa fa-edit"></i>Edit</a>';

                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteProduk"><i class="fa fa-trash"></i>Delete</a>';

                    return $btn;
                })
                ->editColumn('harga', function ($row) {
                    return "Rp. " . number_format($row->harga);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.product.index', [
            "title" => 'Product',
        ], compact('products'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.product.tambah', [
            "title" => 'Tambah Produk',
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

       
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'qty' => 'required|numeric',
            'harga' => 'required|numeric',
        ], [
            'nama.required' => 'Nama Wajib Diisi',
            'qty.required' => 'Stok Wajib Diisi',
            'qty.numeric' => 'Stok Hanya Angka',
            'harga.required' => 'Harga Wajib Diisi',
            'harga.numeric' => 'Harga Hanya Angka',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $data = [
                'nama' => $request->input('nama'),
                'qty' => $request->input('qty'),
                'harga' => $request->input('harga'),
            ];

            Product::create($data);
            return response()->json(['Success' => "Produk baru ditambahkan"]);
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return response()->json(['result' => $product]);
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
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'qty' => 'required|numeric',
            'harga' => 'required|numeric',
        ], [
            'nama.required' => 'Nama Wajib Diisi',
            'qty.required' => 'Stok Wajib Diisi',
            'qty.numeric' => 'Stok Hanya Angka',
            'harga.required' => 'Harga Wajib Diisi',
            'harga.numeric' => 'Harga Hanya Angka',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $data = [
                'nama' => $request->input('nama'),
                'qty' => $request->input('qty'),
                'harga' => $request->input('harga'),
            ];

            Product::where('id', $id)->update($data);
            return response()->json(['Success' => "Berhasil Update Data"]);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request)
    {
        $id = $request->post('id');

        $empdata = Product::find($id);

        if ($empdata->delete()) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return response()->json($response);
    }

    public function simpanProduk(Request $request)
    {
        Product::updateOrCreate(
            ['id' => $request->id],
            [
                'nama' => $request->name,
                'qty' => $request->qty,
                'harga' => $request->harga,
            ]
        );

        return response()->json(['success' => 'Produk saved successfully.']);
    }
}
