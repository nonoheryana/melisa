<button title="Unduh" id="downloads<?php echo $file ?>" data-file="<?php echo $file ?>"><i class="icon-download"></i></button>
<script type="text/javascript">
    $('#downloads<?php echo $file ?>').click(function(){
        file = $(this).attr('data-file');
        location.href("<?php echo base_url() ?>resource/"+file,"_blank");
        return false;
    });
</script>
