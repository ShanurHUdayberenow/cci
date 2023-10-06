@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            {{ Breadcrumbs::render('fo_exhibitions') }}
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>КАЛЕНДАРЬ ЗАРУБЕЖНЫХ ВЫСТАВОК</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('exhibition.fo_exhibitions.create') }}" class="btn btn-primary mb-3">Добавить</a>
                            @if (count($fo_exhibitions))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Action </th>
                                                <th>Имя</th>
                                                <th>Дата</th>
                                                <th>Изображение</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($fo_exhibitions as $fo_exhibition)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('exhibition.fo_exhibitions.edit', ['fo_exhibition' => $fo_exhibition->id]) }}"
                                                            class="btn btn-info btn-sm float-left mb-1 mr-1">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>

                                                        <form
                                                            action="{{ route('exhibition.fo_exhibitions.destroy', ['fo_exhibition' => $fo_exhibition->id]) }}"
                                                            method="post" class="float-left">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Подтвердите удаление')">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>{{ $fo_exhibition->title }}</td>
                                                    <td>
                                                        {{ $fo_exhibition->getStartEndTimes() }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ $fo_exhibition->getImage() }}"
                                                            class="img-fluid img-thumnail" width="100" alt=""></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Предложении пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $fo_exhibitions->links() }}
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
