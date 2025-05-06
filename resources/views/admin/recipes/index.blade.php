@extends('admin.layouts.layout')

@section('content')
    <h1 class="h3 mb-3"><strong>Kelola</strong> Resep</h1>
    <a href="{{ route('admin.recipes.create') }}" class="btn btn-primary mb-3">Tambah Resep</a>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Steps</th>
                                    <th scope="col">Ingredients</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recipes as $recipe)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $recipe->title }}</td>
                                        <td>
                                            <a href="{{ route('admin.recipes.steps.index', $recipe->slug) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.recipes.ingredients.index', $recipe->slug) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.recipes.edit', $recipe->slug) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="{{ route('admin.recipes.destroy', $recipe->slug) }}"
                                                    class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .table {
                width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
                display: block;
            }
            .table thead {
                display: none;
            }
            .table tbody {
                display: block;
                width: 100%;
            }
            .table tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 0.25rem;
            }
            .table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem;
                border-top: none;
                border-bottom: 1px solid #dee2e6;
                position: relative;
                padding-left: 50%;
            }
            .table td:before {
                content: attr(data-label);
                position: absolute;
                left: 0.75rem;
                width: 45%;
                padding-right: 1rem;
                font-weight: bold;
                text-align: left;
            }
            .table td:last-child {
                border-bottom: none;
            }
            /* Perbaikan khusus untuk tombol aksi */
            .table td .btn-group {
                display: flex;
                gap: 0.25rem;
            }
            .table td .btn {
                margin: 0;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan data-label untuk responsive table
            const headers = document.querySelectorAll('thead th');
            const cells = document.querySelectorAll('tbody td');
            
            headers.forEach((header, index) => {
                const label = header.textContent;
                document.querySelectorAll(`tbody td:nth-child(${index + 1})`).forEach(cell => {
                    cell.setAttribute('data-label', label);
                });
            });
        });
    </script>
@endsection