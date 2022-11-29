@if ( session('message') )
    @component('components.alert')
        @slot('class', 'success')
        @slot('icon', 'fa-regular fa-thumbs-up')
        @slot('name', 'Exito')
        @slot('message', session('message'))
    @endcomponent
@endif

@if ( session('info') )
    @component('components.alert')
        @slot('class', 'info')
        @slot('icon', 'fa-solid fa-circle-info')
        @slot('name', 'Atención')
        @slot('message', session('info'))
    @endcomponent
@endif

@if ( session('warning') )
    @component('components.alert')
        @slot('class', 'warning')
        @slot('icon', 'fa-solid fa-triangle-exclamation')
        @slot('name', 'Advertencia')
        @slot('message', session('warning'))
    @endcomponent
@endif

@if ( $errors->any() )
    @foreach ($errors->all() as $error)
        @component('components.alert')
            @slot('class', 'error')
            @slot('icon', 'fa-solid fa-circle-exclamation')
            @slot('name', 'Error')
            @slot('message', $error)
        @endcomponent
    @endforeach
@endif