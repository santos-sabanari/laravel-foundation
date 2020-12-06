@props(['title' => 'Modal title', 'type' => 'primary', 'id' => md5(\Carbon\Carbon::now() . Str::random(40))])

<button class="btn btn-{{$type}}" type="button" data-toggle="modal" data-target="#{{$id}}">Tambah</button>
<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-{{$type}}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$title}}</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
