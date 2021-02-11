@extends('layouts.page')
@section('page_content')
    @include('layouts.partials._breadcrumbs', ['breadcrumbs' => $model->breadcrumbs])
    <div class="page__section">
        @if($model->title != null && !empty($model->title))
            <div class="page__title">
                <h3>{{$model->title}}</h3>
            </div>
        @endif
        @if($model->description != null && !empty($model->description))
            <div class="page__description">
                {{$model->description}}
            </div>
        @endif
    </div>

    <article class="page__section private__section">
        @yield('auth_content')
    </article>
@endsection

