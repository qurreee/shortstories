
<script src="{{URL('storage/assets/vendor/ckeditor5/build/ckeditor.js')}}"></script>

<div id="editor"></div>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ))
        .then(editor => {
        // Set initial content with multiple lines
        editor.ui.view.editable.element.style.height = '500px';
        })
        .catch( error => {
            console.error( error );
        } );
</script>