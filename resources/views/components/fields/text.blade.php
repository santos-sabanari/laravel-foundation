@props(['wrapper_class'=>'3','prepend'=> false,'prepend_icon' => '','field'])

<div class="input-group mb-$wrapper_class">
    @if($prepend)
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="{{$prepend_icon}}"></i>
            </span>
        </div>
    @endif

    <input class="form-control" type="text" placeholder="{{$field}}">
        <div class="valid-feedback">
            Looks good!
        </div>

        <div class="invalid-feedback">
            Please provide a valid city.
        </div>


    {{--    <input class="form-control" type="text" placeholder="Username">--}}
    {{--    <input class="form-control h-auto form-control-solid py-4 px-8 @error('identity') is-invalid @enderror"--}}
    {{--           type="text" placeholder="{{ __('Username or E-Mail Address') }}" name="identity" value="{{ old('identity') }}"--}}
    {{--           autocomplete="identity" autofocus/>--}}
    {{--    @error('identity')--}}
    {{--    <span class="invalid-feedback"> <strong>{{ $message }}</strong> </span>--}}
    {{--    @enderror--}}
</div>

<p class="invalid-feedback">
    <strong>TES</strong>
</p>SZDs
