@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Category</h2>
            </div>
            <div class="pull-right">
                @can('category-create')
                    <a class="btn btn-success btn-sm mb-2" href="{{ route('categories.create') }}">
                        <i class="fa fa-plus"></i> Create New Category
                    </a>
                @endcan
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>

        @php
            $i = ($categories->currentPage() - 1) * $categories->perPage();
        @endphp

        @foreach ($categories as $category)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        <a class="btn btn-info btn-sm" href="{{ route('categories.show', $category->id) }}">
                            <i class="fa-solid fa-list"></i> Show
                        </a>

                        @can('category-edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('categories.edit', $category->id) }}">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        @endcan

                        @csrf
                        @method('DELETE')

                        @can('category-delete')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $categories->links() !!}

    <p class="text-center text-primary"><small></small></p>
@endsection
