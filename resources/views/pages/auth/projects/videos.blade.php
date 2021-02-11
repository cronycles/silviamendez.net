@extends('layouts.auth')

@section('auth_content')
    @include('custom.form._form', ['model' => $model->formData])

    <div>
        @if($model->videos != null)
            @foreach ($model->videos as $video)
                <div>
                    <p>{{$video->name}}</p>
                    <span><a href="{{route('auth.projects.videos.delete', [$model->projectId, $video->id])}}">ELIMINA VIDEO</a></span>
                </div>
                
            @endforeach
        @endif

    </div>
@endsection
