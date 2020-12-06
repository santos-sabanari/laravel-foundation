@props(['title' => 'Modal title', 'type' => 'primary', 'size' => '', 'id' => md5(\Carbon\Carbon::now() . Str::random(40)), 'scripts' => false])

<button class="btn btn-{{$type}}" type="button" data-toggle="modal" data-target="#{{$id}}">Tambah</button>

<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-{{$type}} {{$size==''?'':"modal-$size"}}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$title}}</h4>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        window.addEventListener('closeModal', event => {
            $('#tambah').trigger('click');
        })
    </script>

    @if($scripts)
        {{ $scripts }}
    @endif
@endpush
