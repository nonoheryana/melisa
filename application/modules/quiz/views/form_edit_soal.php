<h3 style="margin-top: 0px;padding-top: 0px;">Edit Soal <?php //echo $option; ?></h3>
<form id="update-quiz-soal">
    <div class="input-control textarea">
        <textarea name="soal" id="soal" placeholder="Soal"><?php echo $soal;?></textarea>
    </div>
     <br />

     <br />
     <hr />
     <div id="resource-detail" style="word-wrap: break-word;">
         <?php if ($resource !=null){
             ?>
                Anda memilih attachment dengan id : <br/> <?php echo $resource->title?>
                <a title="Hapus Attachment ini.." href="javascript:void(0)" id="btn-delete-attachment" data-id="0"  ><i class="icon-cancel fg-color-pink"></i></a>
                    
            <?php
         } else {
             ?>
                Anda tidak memilih attachment manapun..
             <?php
         }?>
     </div> <br />
     <div id="list-resource" style="width:700px;height:150px;overflow:scroll;overflow-x:hidden">
     </div>
      
     <hr />
     <br />
     <br />
     <hr />
     <div id="summary-detail" style="word-wrap: break-word;">
         <?php if ($summary !=null){
             ?>
                Anda memilih pembahasan dengan id : <br/> <?php echo $summary->title?>
                <a title="Hapus Attachment ini.." href="javascript:void(0)" id="btn-delete-summary" data-id="0"  ><i class="icon-cancel fg-color-pink"></i></a>
                    
            <?php
         } else {
             ?>
                Anda tidak memilih pembahasan manapun..
             <?php
         }?>
    </div> 
     
    <br />
    
    <div id="list-summary" style="width:700px;height:150px;overflow:scroll;overflow-x:hidden">
    </div>
    
    <hr />
    <br />
    <br />

    <h4 style="margin-top: 0px;padding-top: 0px;">Jawaban <?php //echo $option; ?></h4>
    <div class="input-control select span2">
        <select name="answer" id="answer">
            <?php 
            if (count($list_choice) != 0){
            
            foreach ($list_choice as $choice){

                if ($answer == $choice->option_idx){
                    ?>
                        <option selected value="<?php echo $choice->option_idx; ?>"><?php echo $choice->option_text; ?></option>
                    <?php
                }
                else {
                    ?>
                        <option value="<?php echo $choice->option_idx; ?>"><?php echo $choice->option_text; ?></option>
                    <?php
                }
            }
            }
            else {
                ?>
                <option value="x">Tak Ada Jawaban</option>    
                <?php
            }
            ?>
        </select>
    </div>

    <br /><br /><br />

    <h4 style="margin-top: 0px;padding-top: 0px;">Sembunyikan soal ? <?php //echo $option; ?></h4>
    <div class="input-control select span2">
        <select name="status" id="status">
            <?php
                if ($status == 1){
                    ?>
                    <option value="1">Tampilkan</option>
                    <option value="0">Sembunyikan</option>
                    <?php
                }
                else {
                    ?>
                    <option value="1">Tampilkan</option>
                    <option value="0" selected>Sembunyikan</option>
                    <?php
                }
            ?>
        </select>
    
    </div>
    <br /><br /><br />
    <input type="hidden" name="id_soal" id="id_soal" value="<?php echo $id_soal ?>"/>
    <input type="submit" value="Update"/>
   <input class="bg-color-red" style="color:white" type="button" name="btn-cancel" id="btn-cancel" value="Cancel"/>
</form>
<input type="hidden" name="quiz_id" id="quiz_id" value="<?php echo $quiz_id ?>"/>
<script type="text/javascript">

    $('#list-resource').load("<?php echo site_url('quiz/list_all_quiz_attachment') ?>/<?php echo $id_soal?>",function(){
        
    });
    $('#list-summary').load("<?php echo site_url('quiz/list_all_quiz_summary') ?>/<?php echo $id_soal?>",function(){
        
    });


    $('#btn-cancel').click(function(){
            $('#message').html('Loading ... ');
            $('#loading-template').show();
            var id_quiz = $('#quiz_id').val();
            $('#content-right').load("<?php echo site_url('quiz/list_all_soal') ?>/"+id_quiz,function(){
                $('#loading-template').fadeOut("slow");
            });
        });
        
    $('#update-quiz-soal').submit(function(){
        $('#message').html('Proses Update ...');
        $('#loading-template').show();
        var quiz_id = $('#quiz_id').val();
        
        
        var soal = $('#soal').val();
        
        if (soal == ''){
            var message = '[PERINGATAN]<br><br>';
            if (soal == ''){
                message += '- Anda belum mengisikan soal <br>';
            }
            
            $('#message-error').html(message);
            $('#loading-template').fadeOut("slow");
            $('#error-template').show()

            return false;
        }
        
        
        $.ajax({
            type:'POST',
            url:"<?php echo site_url('quiz/update_quiz_soal') ?>",
            data:$(this).serialize(),
            success:function (data) {
                $('#content-right').load("<?php echo site_url('quiz/list_all_soal') ?>/"+quiz_id,function(){
                    $('#loading-template').fadeOut("slow");
                });
            },
            error:function (data){
                $('#loading-template').fadeOut("slow");
                alert('gagal');
            }
        });
        return false;
    });
</script>