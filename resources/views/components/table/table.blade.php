@props([
    'header' => false,
    'min' => 60,
])
<div class="card overflow-hidden">
    <div class="card-body p-0 table-responsive" style="max-height: 60vh; min-height: {{$min}}vh;">
        <table class="table table-hover table-striped" {{$attributes}}>
            @if($header)
                <thead>
                {{$header}}
                </thead>
            @endif
            <tbody>
            {{$slot}}
            </tbody>
        </table>
    </div>
</div>
