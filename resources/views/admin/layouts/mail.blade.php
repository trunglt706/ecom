<div style="background-color:#bdbdbd;padding:20px">
    <div style="background-color:#fafafa;width:600px;margin:0px auto">
        <div style="background-color:#ffffff;padding:10px 20px;border-bottom:5px solid #0281c3">
            <img src="{{ Path::url('images/logo.png') }}" />
        </div>
        <div style="padding:20px">
            <?php
                echo isset($mainContent) ? $mainContent : '';
            ?>
        </div>
    </div>
</div>