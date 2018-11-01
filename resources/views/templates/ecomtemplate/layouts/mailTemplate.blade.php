<div style="background-color:#bdbdbd;padding:20px">
    <div style="background-color:#fafafa;width:600px;margin:0px auto">
        <div style="background-color:#2E4053;padding:10px 20px;">
            <img src="{{ Path::url('images/logo.png') }}" />
        </div>
        <div style="padding:20px">
            <?php echo isset($mainContent) ? $mainContent : ''; ?>
            @yield('mailContent')
        </div>
        <div style="padding: 10px 20px; background-color: #E0E0E0; color: #333;">
            Copyright <a href="http://vnpangasius.com.vn/" target="_blank">Vietnam Pangasius Association</a>
        </div>
    </div>
</div>
