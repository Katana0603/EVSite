{{-- tinymceScripts.blade.php --}}


<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

<script>
  tinymce.init({
    selector: '#contentEditor',
    theme: 'modern',
        skin: "test",
    plugins: [
    'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
    'searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking',
    'save table contextmenu directionality emoticons template paste textcolor giphy youtube'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image giphy youtube | print preview media | forecolor backcolor emoticons'
});

</script>