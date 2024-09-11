@php
$total = 0;
@endphp

@foreach ($cart as $item)
    @php
    $total += $item['price'] * $item['quantity'];
    @endphp
    <div class="row">
        <div class="col-xs-3">
            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" width="50">
            {{ $item['name'] }}
        </div>
        <div class="col-xs-2">
            {{ number_format($item['price']) }} ₫
        </div>
        <div class="col-xs-3">
            {{ $item['quantity'] }}
        </div>
        <div class="col-xs-2">
            {{ number_format($item['price'] * $item['quantity']) }} ₫
        </div>
    </div>
@endforeach
