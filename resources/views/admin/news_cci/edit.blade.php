@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid ml-3">
            <h6>{{ Breadcrumbs::render('newsEditCci', $newsCci) }}</h6>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-created_at">{{ $newsCci->title }}</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" enctype="multipart/form-data"
                            action="{{ route('news_cci.update', $newsCci->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Заголовок (русский)*</label>
                                    <input type="text" name="title" required
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        placeholder="Заголовок" value="{{ $newsCci->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="title_tk">Заголовок (türkmen)*</label>
                                    <input type="text" name="title_tk"
                                        class="form-control @error('title_tk') is-invalid @enderror" id="title_tk"
                                        placeholder="Заголовок" value="{{ $newsCci->title_tk }}">
                                </div>

                                <div class="form-group">
                                    <label for="title_en">Заголовок (english)</label>
                                    <input type="text" name="title_en"
                                        class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                        placeholder="Заголовок" value="{{ $newsCci->title_en }}">
                                </div>

                                <div class="form-group">
                                    <label for="desc">Описание (русский)*</label>
                                    <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc"
                                        required rows="5" placeholder="Описание">{{ $newsCci->desc }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="desc_tk">Описание (türkmen)*</label>
                                    <textarea class="form-control @error('desc_tk') is-invalid @enderror" name="desc_tk"
                                        id="desc_tk" rows="5" placeholder="türkmen">{{ $newsCci->desc_tk }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="desc_en">Описание (english)</label>
                                    <textarea class="form-control @error('desc_en') is-invalid @enderror" name="desc_en"
                                        id="desc_en" rows="5" placeholder="english">{{ $newsCci->desc_en }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="publish_at">Дата добавление</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        <input type="date" name="publish_at" value="{{ $newsCci->publish_at }}" data-mask
                                            class="form-control @error('publish_at') is-invalid @enderror"
                                            data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy">
                                    </div>
                                </div>

                                <div>
                                    <img style="width: 400px" src="{{ $newsCci->getImage() }}" class="img-thumbnail" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail">Изображение</label>
                                    <div class="custom-file">
                                        <input type="file" name="thumbnail" id="thumbnail" class="custom-file-input">
                                        <label class="custom-file-label @error('thumbnail') is-invalid @enderror"
                                            for="thumbnail">Выберите
                                            изображение</label>
                                    </div>
                                    <div>
                                        <img id="img-preview" class="img-responsive img-thumbnail" width="300" src="" />
                                    </div>
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
