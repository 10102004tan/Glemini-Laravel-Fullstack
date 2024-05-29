<!-- create components select -->
<select {{ $attributes->merge(['class' => 'form-select']) }}>
    {{ $slot }}
</select>