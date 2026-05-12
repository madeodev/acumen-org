@if(!empty($id))
    {!! wp_get_attachment_image($id, $size, null, [
        'class' => $class,
        'sizes' => $sizes,
        ...$attributes->merge(['style' => $focal_point,])
    ]) !!}
@endif