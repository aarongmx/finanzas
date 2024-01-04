@props([
    'header' => false,
    'min' => 60,
])
<div class="card overflow-hidden">
    <div class="card-body table-responsive" style="max-height: 60vh; min-height: {{$min}}vh;">
        <table class="table table-hover table-striped">
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
