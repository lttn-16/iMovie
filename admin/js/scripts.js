$(document).ready(function(){
    //alert("Hello");
    
    //CK Editor 5
    var editor = CKEDITOR.replace( 'editor' );
    CKFinder.setupCKEditor( editor );


    //Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    } );
});










