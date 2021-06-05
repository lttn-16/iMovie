  $(document).ready(function(){
    //Checkbox
    $('#selectAllBoxes').click(function(e){
        
      if(this.checked){
          $('.checkBoxes').each(function(){
              this.checked = true;
          })
      } else {
          $('.checkBoxes').each(function(){
              this.checked = false;
          })
      }
    });

    //Data Table
    $('#example').DataTable();

    //CK Editor 5
    var editor = CKEDITOR.replace( 'editor' );
    CKFinder.setupCKEditor( editor );


});










