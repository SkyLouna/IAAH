
<script>

    function reloadForm(){
        $('#iaah').empty()
        $('#iaah').load('IAAHAjaxGenerate.php #iaah_form', function(){addEventHandler()});
        return false;
    }

    function addEventHandler(){
         $('#iaah_ajaxsendbtn').click(function(){
            var form = $('.IAAHFormCheck');

            if(form == null){
                return;
            }
            

            $.ajax({
                type: "POST",
                url: 'IAAHAjaxCheck.php',
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data == 0){
                        $('#iaah_ajaxsendbtn').hide();
                        $('#iaah_content').empty();
                        $('#iaah_content').append('<p>IAAH échoué</p>');
                        $('#iaah_content').append('<button onclick="return reloadForm();">Retry</button>')
                        return;
                    }

                    if(data == 1){
                        $('#iaah_ajaxsendbtn').hide();
                        $('#iaah_content').empty();
                        $('#iaah_content').append('<p>IAAH réussi</p>');
                    }
                }
            });
        });
    }

    $(document).ready(function(){
        addEventHandler();
    })

   
    
</script>