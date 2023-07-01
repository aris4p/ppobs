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
<<<<<<< HEAD

=======
        
>>>>>>> 01a85b3 (Update 1 july)
        if ($request->ajax()) {
            return Datatables::of($products)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                //kita tambahkan button edit dan hapus
                $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm editProduk"><i class="fa fa-edit"></i>Edit</a>';
<<<<<<< HEAD

                $btn = $btn . ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteProduk"><i class="fa fa-trash"></i>Delete</a>';

=======
                
                $btn = $btn . ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteProduk"><i class="fa fa-trash"></i>Delete</a>';
                
>>>>>>> 01a85b3 (Update 1 july)
                return $btn;
            })
            ->editColumn('harga', function($row){
                return "Rp. ".number_format($row->harga);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
<<<<<<< HEAD


=======
        
               
>>>>>>> 01a85b3 (Update 1 july)
        return view('admin.product.index',[
            "title" => 'Product'
        ],compact('products'));
    }
<<<<<<< HEAD

=======
    
>>>>>>> 01a85b3 (Update 1 july)
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
<<<<<<< HEAD

=======
        
>>>>>>> 01a85b3 (Update 1 july)
        // $response = Http::asForm()->post('https://vip-reseller.co.id/api/game-feature', [
            //     'key' => 'Y5DIx6x6fBlCAtgkNuoneOnyMdem2q1cW179dVI0vk7HCWcfqVFUlsYw8PWLQ6oT',
            //     'sign' => '1b1b80cc71a67ee15a91d641b81733d2',
            //     'type' => 'services',
            //     'filter_type' => 'game',
            //     'filter_value' => 'Mobile Legends B',
            //     ])->json('data');
<<<<<<< HEAD

            // dd($response);
            // foreach ($response as $responses) {
                //        return $responses['game'];


                //     }

                return view('admin/product/tambah',[
                    "title" => 'Tambah Produk',

                ]);
            }

=======
            
            // dd($response);
            // foreach ($response as $responses) {
                //        return $responses['game'];
                
                
                //     }
                
                return view('admin/product/tambah',[
                    "title" => 'Tambah Produk',
                    
                ]);
            }
            
>>>>>>> 01a85b3 (Update 1 july)
            /**
            * Store a newly created resource in storage.
            *
            * @param  \Illuminate\Http\Request  $request
            * @return \Illuminate\Http\Response
            */
            public function store(Request $request)
            {
<<<<<<< HEAD


=======
                
                
>>>>>>> 01a85b3 (Update 1 july)
                $validasi = validator::make($request->all(), [
                    'nama' => 'required',
                    'qty' => 'required|numeric',
                    'harga' => 'required|numeric',
                ],[
                    'nama.required' => 'Nama Wajib Diisi',
                    'qty.required' => 'Stok Wajib Diisi',
                    'qty.numeric' => 'Stok Hanya Angka',
                    'harga.required' => 'Harga Wajib Diisi',
                    'harga.numeric' => 'Harga Hanya Angka',
<<<<<<< HEAD

                ]);

                if ($validasi->fails()){
                    return response()->json(['errors' => $validasi->errors()]);
                }else{

=======
                    
                ]);
                
                if ($validasi->fails()){
                    return response()->json(['errors' => $validasi->errors()]);
                }else{
                    
>>>>>>> 01a85b3 (Update 1 july)
                    $data = [
                        'nama' => $request->input('nama'),
                        'qty' => $request->input('qty'),
                        'harga' => $request->input('harga'),
<<<<<<< HEAD

                    ];

                    Product::create($data);
                    return response()->json(['Success'=>"Produk baru ditambahkan"]);
                }


            }

=======
                        
                    ];
                    
                    Product::create($data);
                    return response()->json(['Success'=>"Produk baru ditambahkan"]);
                }
                
                
            }
            
>>>>>>> 01a85b3 (Update 1 july)
            /**
            * Display the specified resource.
            *
            * @param  \App\Models\Product  $product
            * @return \Illuminate\Http\Response
            */
            public function show(Product $product)
            {
                //
            }
<<<<<<< HEAD

=======
            
>>>>>>> 01a85b3 (Update 1 july)
            /**
            * Show the form for editing the specified resource.
            *
            * @param  \App\Models\Product  $product
            * @return \Illuminate\Http\Response
            */
            public function edit($id)
            {
                $product = Product::where('id',$id)->first();
<<<<<<< HEAD


                return response()->json(['result' =>$product]);
                // return view('admin.product.index', compact('product'));
            }

=======
                
                
                return response()->json(['result' =>$product]);
                // return view('admin.product.index', compact('product'));
            }
            
>>>>>>> 01a85b3 (Update 1 july)
            /**
            * Update the specified resource in storage.
            *
            * @param  \Illuminate\Http\Request  $request
            * @param  \App\Models\Product  $product
            * @return \Illuminate\Http\Response
            */
            public function update(Request $request, $id)
            {
<<<<<<< HEAD

=======
                
>>>>>>> 01a85b3 (Update 1 july)
                $validasi = validator::make($request->all(), [
                    'nama' => 'required',
                    'qty' => 'required|numeric',
                    'harga' => 'required|numeric',
                ],[
                    'nama.required' => 'Nama Wajib Diisi',
                    'qty.required' => 'Stok Wajib Diisi',
                    'qty.numeric' => 'Stok Hanya Angka',
                    'harga.required' => 'Harga Wajib Diisi',
                    'harga.numeric' => 'Harga Hanya Angka',
<<<<<<< HEAD

                ]);

                if ($validasi->fails()){
                    return response()->json(['errors' => $validasi->errors()]);
                }else{

=======
                    
                ]);
                
                if ($validasi->fails()){
                    return response()->json(['errors' => $validasi->errors()]);
                }else{
                    
>>>>>>> 01a85b3 (Update 1 july)
                    $data = [
                        'nama' => $request->input('nama'),
                        'qty' => $request->input('qty'),
                        'harga' => $request->input('harga'),
<<<<<<< HEAD

                    ];

=======
                        
                    ];
                    
>>>>>>> 01a85b3 (Update 1 july)
                    Product::where('id', $id)->update($data);
                    return response()->json(['Success'=>"Berhasil Update Data"]);
                }
            }
<<<<<<< HEAD


                /**
                * Remove the specified resource from storage.
                *
                * @param  \App\Models\Product  $product
                * @return \Illuminate\Http\Response
                */
                public function delete(Request $request){

                    ## Read POST data
                    $id = $request->post('id');

                    $empdata = Product::find($id);

                    if($empdata->delete()){
                        $response['success'] = 1;
                        $response['msg'] = 'Delete successfully';
                    }else{
                        $response['success'] = 0;
                        $response['msg'] = 'Invalid ID.';
                    }

                    return response()->json($response);
                }

                public function simpanProduk(Request $request)
                {

                    //kita gunakan laravel laravel eloquent untuk update dan create agar lebih mudah
                    //jadi jika request ada id maka akan melakukan update
                    Product::updateOrCreate(
                        ['id' => $request->id],
                        [
                            'nama' => $request->name,
                            'qty' => $request->qty,
                            'harga' => $request->harga
                            ]
                        );

                        return response()->json(['success' => 'Produk saved successfully.']);
                    }
                }
=======
            
            
            /**
            * Remove the specified resource from storage.
            *
            * @param  \App\Models\Product  $product
            * @return \Illuminate\Http\Response
            */
            public function delete(Request $request){
                
                ## Read POST data
                $id = $request->post('id');
                
                $empdata = Product::find($id);
                
                if($empdata->delete()){
                    $response['success'] = 1;
                    $response['msg'] = 'Delete successfully';
                }else{
                    $response['success'] = 0;
                    $response['msg'] = 'Invalid ID.';
                }
                
                return response()->json($response);
            }
            
            public function simpanProduk(Request $request)
            {
                
                //kita gunakan laravel laravel eloquent untuk update dan create agar lebih mudah
                //jadi jika request ada id maka akan melakukan update
                Product::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'nama' => $request->name,
                        'qty' => $request->qty,
                        'harga' => $request->harga
                        ]
                    );
                    
                    return response()->json(['success' => 'Produk saved successfully.']);
                }
            }
            
>>>>>>> 01a85b3 (Update 1 july)
