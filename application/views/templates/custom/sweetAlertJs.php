<?php /* SWEET ALERT */ ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    <?php if ($this->session->flashdata('message')) : ?>
        let flashdata = [<?= json_encode($this->session->flashdata('message')) ?>]
        Swal.fire({
            icon: flashdata[0]['icon'],
            title: flashdata[0]['title'],
            text: (flashdata[0]['text']) ? flashdata[0]['text'] : '',
            html: (flashdata[0]['html']) ? flashdata[0]['html'] : '',
        })
    <?php endif ?>
</script>