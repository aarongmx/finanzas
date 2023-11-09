@props([
    'id' => Str::random(),
    'title' => 'Modal',
    'footer' => false,
])

<div class="modal fade" id="{{$id}}" tabindex="-1" aria-labelledby="{{$id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{$id}}-title">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{$slot}}
            </div>
            @if($footer)
                <div class="modal-footer">
                    {{$footer}}
                </div>
            @endif
        </div>
    </div>
</div>
