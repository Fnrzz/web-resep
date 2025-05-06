@extends('admin.layouts.layout')

@section('content')
    <a href="{{ route('admin.recipes.index') }}" class="text-decoration-none">Kembali</a>
    <h1 class="h3 my-3">Kelola Steps untuk <strong>{{ $title }}</strong></h1>
    <a href="{{ route('admin.recipes.steps.create', $slug) }}" class="btn btn-primary mb-3">Tambah Step</a>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">No</th>
                                    <th scope="col" style="width: 50%">Steps</th>
                                    <th scope="col" style="width: 20%">Gambar</th>
                                    <th scope="col" style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($steps as $step)
                                    <tr>
                                        <td data-label="No">{{ $loop->iteration }}</td>
                                        <td data-label="Steps">{{ $step->description }}</td>
                                        <td data-label="Gambar">
                                            <a href="{{ route('admin.recipes.steps.images.index', $step->id) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                        <td data-label="Aksi">
                                            <div class="d-flex flex-wrap gap-2 justify-content-start">
                                                <a href="{{ route('admin.recipes.steps.edit', $step->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.recipes.steps.destroy', $step->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada step ditambahkan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
            padding: 12px 15px;
            background-color: #f8f9fa;
        }

        .table tbody tr {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-top: none;
            border-bottom: 1px solid #f0f0f0;
            word-break: break-word;
        }

        .table tbody td:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .table tbody td:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .btn {
            padding: 6px 12px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .table-responsive {
                border: none;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            thead {
                display: none;
            }

            tr {
                display: block;
                margin-bottom: 20px;
                border: 1px solid #dee2e6;
                border-radius: 8px;
                background: white;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            td {
                display: block;
                width: 100%;
                padding: 10px 15px;
                border-bottom: 1px solid #f0f0f0;
                position: relative;
                text-align: left;
                box-sizing: border-box;
            }

            td:before {
                content: attr(data-label);
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
                color: #495057;
            }

            td:last-child {
                border-bottom: none;
            }

            /* Perbaikan agar tombol aksi tetap sejajar */
            .d-flex.flex-wrap {
                display: flex !important;
                flex-wrap: nowrap !important;
                gap: 10px;
                justify-content: flex-start;
            }

            .d-flex.flex-wrap .btn,
            .d-flex.flex-wrap form {
                margin-bottom: 0 !important;
            }

            .d-flex.flex-wrap form {
                display: inline;
            }

            .d-flex.flex-wrap button {
                white-space: nowrap;
            }
        }
    </style>
@endsection
