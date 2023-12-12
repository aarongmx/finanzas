@props([
    'header' => false,
    'min' => 60,
])
<div class="card">
    <div class="card-body p-0 table-responsive" style="max-height: 60vh; min-height: {{$min}}vh;">
        <table class="table table-hover">
            @if($header)
                <thead class="table-primary">
                {{$header}}
                </thead>
            @endif
            <tbody>
            {{$slot}}
            </tbody>
        </table>
    </div>
</div>
