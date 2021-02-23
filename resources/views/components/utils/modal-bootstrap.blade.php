@props(['title' => 'Modal title', 'type' => 'primary', 'size' => '', 'id' => '', 'scripts' => false])

<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog {{$size==''?'':"modal-$size"}}" role="document">
        <div class="modal-content">
            <div class="modal-header bg-{{$type}}">
                <h4 class="modal-title text-white">
                    {{$title}}
                </h4>
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
        window.addEventListener('close{{$id}}', event => {
            $('#{{$id}}').modal('hide');
        })

        window.addEventListener('show{{$id}}', event => {
            $('#{{$id}}').modal('show');
        })

        $(document).ready(function(){
            $("#{{$id}}").on('hidden.bs.modal', function(){
                livewire.emit('forcedClose{{$id}}');
            });
        });
    </script>

    @if($scripts)
        {{ $scripts }}
    @endif
@endpush
