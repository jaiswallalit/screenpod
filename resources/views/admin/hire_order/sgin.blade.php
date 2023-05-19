
    


<form action="{{ route('signature.store') }}" method="POST" enctype="multipart/form-data>
 <div id="sign" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <form  >
                            {{ csrf_field() }}
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Signature</h4>
                                </div>
                                <div class="modal-body">
                                    <body>
        <div class="wrapper">
            <canvas id="signature-pad" name="signature-pad" class="signature-pad" width=540 height=200></canvas>
        </div>
        <div>
            <button type="submit" class="button save" data-action="save" id="save">Save</button>
            <input type="hidden" id="signature_data" name="signature_data" class="form-control" value="">
             
             
        </div>
        <div>
        <button id="clear">Clear</button>
        </div>
         
    </body>
</form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>

    <script>
         var signaturePad = new SignaturePad(document.getElementById("signature-pad"),
          {
          backgroundColor: 'rgba(255, 255, 255, 0)',
          penColor: '#222222'
    });

    var saveButton = document.querySelector('.btn-save');
    var clearButton = document.querySelector('[data-action=clear]');
        

    saveButton.addEventListener('click', function (e) {
        document.querySelector('[name=signature_data]').value = signaturePad.toDataURL('image/png', 100);
    });

    clearButton.addEventListener('click', function () {
        signaturePad.clear();
    });
   
    var form = $('#sign');

    $(saveButton).click(function() {
        $.ajax({
            url: "add/coupons",
            data: form.serialize(),
            type: 'POST',
            success: function(response, ui) {
                swal({
                  title: "Signature Saved",
                  text: "Your signature has now been stored.",
                  icon: "success",
                });
                window.setTimeout(function(){window.location.reload()}, 3000);
            },
            error: function(response) {
                console.log('Error!');
            }
        });
    });
                

 

    </script>  
    
