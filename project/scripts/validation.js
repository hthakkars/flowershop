function validateHTML() {
   var path = "https://validator.w3.org/nu/?doc="+window.location.href;
   window.open(path, '_blank').focus();
}

function validateCSS() {
   var path = "https://jigsaw.w3.org/css-validator/validator?uri="+window.location.href;
   window.open(path, '_blank').focus();
}
