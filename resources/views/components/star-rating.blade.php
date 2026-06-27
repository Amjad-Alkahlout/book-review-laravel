@props(['rating'])

<div class="flex items-center gap-1">

    @for($i = 1; $i <= 5; $i++)
        <span class="{{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}">
            ★
        </span>
    @endfor

    <span class="ml-2 text-sm font-medium text-gray-600">
        {{ number_format($rating, 1) }}
    </span>

</div>
