$(document).ready(function(){
    
    // CK Editor 5
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
        console.error( error );
    } );

    //Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    } );
});










