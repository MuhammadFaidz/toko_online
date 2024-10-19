<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        // $medicines = Medicine::simplePaginate(10);
        //simplepaginate : membuat pagination, 10:data yang muncul
        $medicines = Medicine::where('name', 'LIKE', '%'.
        $request->search_medicine.'%')->orderBy('name','ASC')->simplePaginate(10);
        return view('medicine.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicine.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required|min:3',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ], [
            'name.required' => 'Nama Barang harus diisi!',
            'type.required' => 'Jenis Barang harus diisi!',
            'price.required' => 'Harga harus diisi!',
            'stock.required' => 'Stok Barang harus diisi!',
            'name.max' => 'Nama Barang maksimal 100 karakter!',
            'type.min' => 'Jenis Barang minimal 3 karakter!',
            'price.numeric' => 'Harga harus berupa angka!',
            'stock.numeric' => 'Stok Barang harus berupa angka!',
        ]);

        $proses = Medicine::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        if ($proses) {
            return redirect()->route('medicines.index')->with('success', 'Berhasil mengubah data Barang!');
        } else {
            return redirect()->back()->with('failed', 'Gagal mengubah data Barang!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //ambil dlu data lama
        // cari berdasarkan id pada path /{id}
        // first() : mengambil data pertama (hanya satu data)
        $medicine = Medicine::where('id', $id)->first();
        // compact : kirim data ke view ($)
        return view('medicine.edit', compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required|min:3',
            'price' => 'required|numeric',
        ], [
            'name.required' => 'Nama Barang harus diisi!',
            'type.required' => 'Jenis Barang harus diisi!',
            'price.required' => 'Harga harus diisi!',
            'name.max' => 'Nama Barang maksimal 100 karakter!',
            'type.min' => 'Jenis Barang minimal 3 karakter!',
            'price.numeric' => 'Harga harus berupa angka!',
        ]);
        
        $proses = Medicine::where('id', $id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
        ]);

        if ($proses) {
            return redirect()->route('medicines.index')->with('success', 'Berhasil mengubah data Barang!');
        } else {
            return redirect()->back()->with('failed', 'Gagal mengubah data Barang!');
        }
    }

    public function updateStock(Request $request,$id) {

        $medicineBefore = Medicine::where('id',$id)->first();

        if (!isset($request->stock)) {
            return redirect()->back()->with([
                'failed' => 'pastikan stok diiisi',
                'id' => $id,
                'name' => $medicineBefore['name'],
                'stock' => $medicineBefore['stock'],
            ]);
        }

        if ((int)$request->stock < (int)$medicineBefore['stock']) {
            return redirect()->back()->with([
                'failed' => 'stok baru tidak boleh kurang dari stok sebelumnya!',
                'id' => $id,
                'name' => $medicineBefore['name'],
                'stock' => $medicineBefore['stock'],
            ]);
        }

        $medicineBefore->update(['stock' => $request->stock]);
        return redirect()->back()->with('success', 'Berhasil mengubah data stok!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dicari (where) berdasarkan id, lalu hapus
        $proses = Medicine::where('id', $id)->delete();

        if ($proses) {
            return redirect()->back()->with('success', 'Berhasil menghapus data Barang!');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus data Barang!');
        }
    }
}
