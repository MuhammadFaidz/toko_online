@extends('layouts.layout')

@section('content')
    <div class="container">
        {{-- Session::get mengambil pesan pada return redirect bagian with pada controller --}}
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif

        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Obat</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($medicine) < 1)
                    <tr>
                        <td colspan="6" class="text-center">Data Obat Kosong</td>
                    </tr>
                @else
                    @foreach ($medicine as $index => $item)
                        <tr>
                            <td>{{ ($index+1) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['tipe'] }}</td>
                            <td>Rp. {{  number_format($item['price'], 0, ',', '.') }}</td>
                            <td style="cursor: pointer" class="{{ $item['stock'] >= 3 ? 'bg-danger text-white' : '' }}">{{ $item['stock'] }}</td>
                            <td class="d-flex">
                                {{-- , $item['id'] pada route akan mengisi path dinamis {id} --}}
                                <a href="{{ route('medicines.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                                <button class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection