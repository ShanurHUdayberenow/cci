@extends('admin.layouts.layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/lib/daterangepicker-master/daterangepicker.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            {{ Breadcrumbs::render('fo_exhibitionsEdit', $fo_exhibition) }}
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $fo_exhibition->title }}</h4>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" enctype="multipart/form-data"
                            action="{{ route('exhibition.fo_exhibitions.update', ['fo_exhibition' => $fo_exhibition->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                {{-- Name --}}
                                <div class="form-group mb-2">
                                    <label for="name">Имя
                                        <span class="required text-danger">*</span>
                                    </label>

                                    <div class="card-header p-2 mb-1">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#ru" data-toggle="tab">Русский</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#tk" data-toggle="tab">Türkmen</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " href="#en" data-toggle="tab">English</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        {{-- Ru --}}
                                        <div class="active tab-pane" id="ru">
                                            <input type="text" id="title" name="title" placeholder="Имя"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   value="{{ old('title', $fo_exhibition->title) }}">

                                            @error('title')
                                            <span style="display: none" class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        {{-- Tk --}}
                                        <div class="tab-pane" id="tk">
                                            <input type="text" id="title_tk" name="title_tk" placeholder="Ady"
                                                   class="form-control @error('title_tk') is-invalid @enderror"
                                                   value="{{ old('title_tk', $fo_exhibition->title_tk) }}">

                                            @error('title_tk')
                                            <span style="display: none" class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        {{-- En --}}
                                        <div class="tab-pane" id="en">
                                            <input type="text" id="title_en" name="title_en" placeholder="Name"
                                                   class="form-control @error('title_en') is-invalid @enderror"
                                                   value="{{ old('title_en', $fo_exhibition->title_en) }}">

                                            @error('title_en')
                                            <span style="display: none" class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Дата новый</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" value="{{ old('date', $fo_exhibition->getStartEndTimes()) }}" name="date"
                                               class="form-control float-right" id="date">
                                    </div>
                                    <!-- /.input group -->
                                </div>

                                {{-- Image --}}
                                <div>
                                    <img style="width: 400px" src="{{ $fo_exhibition->getImage() }}"
                                        class="img-thumbnail img-fluid mt-2" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail">Изображение</label>
                                    <div class="custom-file">
                                        <input type="file" name="thumbnail" id="thumbnail" class="custom-file-input">
                                        <label class="custom-file-label @error('thumbnail') is-invalid @enderror"
                                            for="thumbnail">Выберите изображение</label>
                                    </div>
                                </div>
                                <img class="img-thumbnail m-1" id="img-preview" width="300" src="" /><br>

                                {{-- Files --}}
                                <div class="form-group">
                                    <label for="name">Прикрепить документ
                                    </label>

                                    <div class="card-header p-2 mb-1">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#ru_file" data-toggle="tab">Русский</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#tk_file" data-toggle="tab">Türkmen</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " href="#en_file" data-toggle="tab">English</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content">
                                        {{-- Ru --}}
                                        <div class="active tab-pane" id="ru_file">
                                            <div class="custom-file">
                                                <input type="file" name="file" id="file" class="custom-file-input"
                                                       placeholder="Выберите файл">
                                                <label class="custom-file-label @error('file') is-invalid @enderror"
                                                       for="file">Выберите файл</label>
                                            </div>

                                            @error('file')
                                            <span style="display: none" class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        {{-- Tk --}}
                                        <div class="tab-pane" id="tk_file">
                                            <div class="custom-file">
                                                <input type="file" name="file_tk" id="file_tk" placeholder="Faýl saýla"
                                                       class="custom-file-input">
                                                <label class="custom-file-label @error('file_tk') is-invalid @enderror"
                                                       for="file_tk">Faýl saýla
                                                </label>
                                            </div>

                                            @error('file_tk')
                                            <span style="display: none" class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        {{-- En --}}
                                        <div class="tab-pane" id="en_file">
                                            <div class="custom-file">
                                                <input type="file" name="file_en" id="file_en" class="custom-file-input"
                                                       placeholder="Choose file">
                                                <label class="custom-file-label @error('file_en') is-invalid @enderror"
                                                       for="file_en">Choose file</label>
                                            </div>

                                            @error('file_en')
                                            <span style="display: none" class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
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
        {{-- daterangepicker --}}
        <script src="{{ asset('assets/lib/daterangepicker/moment.min.js') }}"></script>
        <script src="{{ asset('assets/lib/daterangepicker-master/daterangepicker.js') }}"></script>

        <script type="text/javascript">
            $(function () {
                $('#date').daterangepicker({
                    autoUpdateInput: false,
                    // locale: {
                    //     cancelLabel: 'Clear'
                    // }
                    "locale": {
                        "format": "DD-MM-YYYY",
                        "separator": " - ",
                        "applyLabel": "Ок",
                        "cancelLabel": "Отмена",
                        "fromLabel": "От",
                        "toLabel": "До",
                        "customRangeLabel": "Произвольный",
                        "daysOfWeek": [
                            "Вс",
                            "Пн",
                            "Вт",
                            "Ср",
                            "Чт",
                            "Пт",
                            "Сб"
                        ],
                        "monthNames": [
                            "Январь",
                            "Февраль",
                            "Март",
                            "Апрель",
                            "Май",
                            "Июнь",
                            "Июль",
                            "Август",
                            "Сентябрь",
                            "Октябрь",
                            "Ноябрь",
                            "Декабрь"
                        ],
                        firstDay: 1
                    }
                });
                $('#date').on('apply.daterangepicker', function (ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));
                });
                $('#date').on('cancel.daterangepicker', function (ev, picker) {
                    $(this).val('');
                });
            });
        </script>

        <script>
            $('#datemask').inputmask('dd.mm.yyyy', {
                'placeholder': 'dd.mm.yyyy'
            });
            $('[data-mask]').inputmask()
        </script>
    @endpush
@endsection
