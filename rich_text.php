<!DOCTYPE html>
<html>
<head>
  <script src="tinymce/tinymce.min.js"></script>
  <script>
    tinymce.init({
    selector: 'textarea',
    height: 300,
    theme: 'modern',
    branding: false,
    plugins: ['lists preview searchreplace table contextmenu directionality paste wordcount'],
    menu: {},
    toolbar1: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent'
   });
 </script>
</head>
<body>
  <textarea>Next, get a free TinyMCE Cloud API key!</textarea>
  <button type="button" name="button" onClick="showText()">Show text</button>
  <script type="text/javascript">
    function showText() {
      var txt = tinymce.activeEditor.getContent();
      console.log(txt);
    }
  </script>
</body>
</html>
