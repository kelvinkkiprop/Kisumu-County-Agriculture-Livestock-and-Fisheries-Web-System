@extends('layouts.app')

<!-------------------------------section------------------------------->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card vacancy">
            <form enctype="multipart/form-data" method="POST" action="applyvacancy">
                @csrf     
                <div class="card-header">
                    <i class="fa fa-list-alt fa-2x" aria-hidden="true">&nbsp;{{ __('Appy Vacancy') }}</i>
                </div>

                <div class="card-body">    
                    <!-------------------------------Input------------------------------->
                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>
                            <div class="col-md-6">
                                <select id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" 
                                name="position" value="{{old('position')}}">
                                @foreach($vacancies as $vacancy)
                                <option>{{$vacancy->position}}</option>
                                @endforeach
                            </select>
                                @if ($errors->has('position'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                name="name" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cv" class="col-md-4 col-form-label text-md-right">{{ __('Curriculum vitae') }}</label>
                            <div class="col-md-6">
                                <input id="cv" type="file" class="form-control-file{{ $errors->has('cv') ? ' is-invalid' : '' }}" 
                                name="cv" value="{{old('cv')}}">
                                @if ($errors->has('cv'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cv') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    <!-------------------------------./Input------------------------------->
                                           
                </div>

                <div class="card-footer">
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit"  class="btn btn-info form-control">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>                
                </div>
            </form>    
            </div>
        </div>
    </div>
</div>
@endsection
<!-------------------------------./section------------------------------->
