@extends('layouts.layout')

@section('content')
    <div class="container mt-5 p-4 rounded-4 shadow-lg"
        style="background: linear-gradient(to bottom right, #f8fafc, #e3e7ed);">

        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="" method="GET" class="d-flex justify-content-end mb-3">
            <input type="text" name="search_medicine" placeholder="Cari nama obat..."
                class="form-control rounded-pill shadow-sm w-50" style="border: 1px solid #ced4da; background-color: #fff;">
            <button type="submit" class="btn btn-primary ms-2 rounded-pill shadow-sm">Cari</button>
        </form>

        <table class="table table-hover table-bordered rounded-3 shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($medicines->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">Data Barang Kosong</td>
                    </tr>
                @else
                    @foreach ($medicines as $index => $item)
                        <tr>
                            <td>{{ ($medicines->currentPage() - 1) * $medicines->perPage() + ($index + 1) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['type'] }}</td>
                            <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white' : '' }}" style="cursor: pointer;"
                                onclick="showModalStock('{{ $item->id }}', '{{ $item->name }}', '{{ $item->stock }}')">
                                {{ $item['stock'] }}
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('medicines.edit', $item['id']) }}"
                                    class="btn btn-warning me-2 rounded-pill shadow-sm">Edit</a>
                                <button class="btn btn-danger rounded-pill shadow-sm btn-delete"
                                    data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="d-flex justify-content-end my-3">{{ $medicines->links() }}</div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Hapus Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus <b id="name-medicine"></b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Event handler khusus untuk tombol Hapus
            $('.btn-delete').on('click', function(e) {
                e.preventDefault(); // Mencegah reload halaman

                let id = $(this).data('id');
                let name = $(this).data('name');

                // Set nama barang di modal
                $('#name-medicine').text(name);

                // Set action form delete secara dinamis
                let url = "{{ route('medicines.delete', ':id') }}".replace(':id', id);
                $('#delete-form').attr('action', url);

                // Tampilkan modal delete
                $('#modalDelete').modal('show');
            });

            @if (Session::get('failed'))
                showModalStock(
                    "{{ Session::get('id') }}",
                    "{{ Session::get('name') }}",
                    "{{ Session::get('stock') }}"
                );
            @endif
        });

        function showModalStock(id, name, stock) {
            $('#title_form_edit').text(name);
            $('#stock').val(stock);
            $('#modalEditStock').modal('show');

            let url = "{{ route('medicines.update.stock', ':id') }}".replace(':id', id);
            $('.stock-form').attr('action', url);
        }
    </script>
@endpush
