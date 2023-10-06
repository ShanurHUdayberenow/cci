@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Создание конференции</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Создание конференции</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" enctype="multipart/form-data"
                              action="{{ route('conferences.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Имя (русский)*</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name" placeholder="Имя" value="{{old('name')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="name_en">Имя (english)*</label>
                                    <input type="text" name="name_en"
                                           class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                                           placeholder="Имя (english)" value="{{old('name_en')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="name_tk">Имя (türkmen)*</label>
                                    <input type="text" name="name_tk"
                                           class="form-control @error('name_tk') is-invalid @enderror" id="name_tk"
                                           placeholder="Имя (türkmen)" value="{{old('name_tk')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="title">Заголовок (русский)*</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="Название" value="{{ old('title') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="title_en">Заголовок (english)</label>
                                    <input type="text" name="title_en"
                                           class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                           placeholder="english" value="{{ old('title_en') }}">
                                </div>

                                <div class="form-group">
                                    <label for="title_tk">Заголовок (türkmen)</label>
                                    <input type="text" name="title_tk"
                                           class="form-control @error('title_tk') is-invalid @enderror" id="title_tk"
                                           placeholder="türkmen" value="{{ old('title_tk') }}">
                                </div>

                                <div class="form-group">
                                    <label for="image">Изображение</label>

                                    <div class="custom-file">
                                        <input type="file" name="image" id="image" required
                                               class="custom-file-input">

                                        <label class="custom-file-label @error('image') is-invalid @enderror"
                                               for="image">Выберите изображение</label>
                                    </div>

                                    <div>
                                        <img id="img-preview" class="img-responsive img-image" width="300" src=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="desc">Описание (русский)*</label>
                                    <textarea class="form-control @error('desc') is-invalid @enderror" name="desc"
                                              id="desc"
                                              rows="5" placeholder="Описание">{{ old('desc') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="desc_tk">Описание (türkmen)</label>
                                    <textarea class="form-control @error('desc_tk') is-invalid @enderror" name="desc_tk"
                                              id="desc_tk" rows="5"
                                              placeholder="türkmen">{{ old('desc_tk') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="desc_en">Описание (english)</label>
                                    <textarea class="form-control @error('desc_en') is-invalid @enderror" name="desc_en"
                                              id="desc_en" rows="5"
                                              placeholder="english">{{ old('desc_en') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="datetime">Дата</label>
                                    <input type="text" name="date"
                                           class="form-control @error('date') is-invalid @enderror"
                                           id="datetime" data-mask data-inputmask-alias="datetime"
                                           data-inputmask-inputformat="dd.mm.yyyy" value="{{ old('date') }}">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{ url()->previous() }}" class="btn btn-danger mr-1">Отменить</a>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        {{-- ckeditor --}}
        <script src="{{ asset('assets/admin/ckeditor5/build/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/admin/ckfinder/ckfinder.js') }}"></script>

        <script src="{{ asset('assets/admin/js/ckfinder-desc.js') }}"></script>

    @endpush
@endsection
