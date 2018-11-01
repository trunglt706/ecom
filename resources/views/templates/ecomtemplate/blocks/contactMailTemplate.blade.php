@extends(Path::viewCurrentTemplate( \Input::get('lang'), 'layouts.mailTemplate'))

@section('mailContent')
    <?php echo Language::getTemplate('emaptemplate.lbl_mail_content', ['Name'=>$mainContent['fullname']]); ?>
    <b style="text-transform: uppercase">{{ Language::getTemplate('emaptemplate.lbl_detail') }}:</b>
    <table border="0" style="border-collapse:collapse;border-spacing:0px">
        <tbody>
            <tr>
                <td style="border:1px solid #ddd;padding:8px;background-color:#f9f9f9">{{ Language::getTemplate('emaptemplate.lbl_fullname') }}</td>
                <td style="border:1px solid #ddd;padding:8px;color:#419641">{{ $mainContent['fullname'] }}</td>
            </tr>
            <tr>
                <td style="border:1px solid #ddd;padding:8px;background-color:#f9f9f9">{{ Language::getTemplate('emaptemplate.lbl_address') }}</td>
                <td style="border:1px solid #ddd;padding:8px;color:#419641">{{ $mainContent['address'] }}</td>
            </tr>
            <tr>
                <td style="border:1px solid #ddd;padding:8px;background-color:#f9f9f9">{{ Language::getTemplate('emaptemplate.lbl_phone') }}</td>
                <td style="border:1px solid #ddd;padding:8px;color:#419641">{{ $mainContent['phone'] }}</td>
            </tr>
            <tr>
                <td style="border:1px solid #ddd;padding:8px;background-color:#f9f9f9">{{ Language::getTemplate('emaptemplate.lbl_fax') }}</td>
                <td style="border:1px solid #ddd;padding:8px;color:#419641">{{ $mainContent['fax'] }}</td>
            </tr>
            <tr>
                <td style="border:1px solid #ddd;padding:8px;background-color:#f9f9f9">{{ Language::getTemplate('emaptemplate.lbl_email') }}</td>
                <td style="border:1px solid #ddd;padding:8px;color:#419641">{{ $mainContent['email'] }}</td>
            </tr>
            <tr>
                <td style="border:1px solid #ddd;padding:8px;background-color:#f9f9f9">{{ Language::getTemplate('emaptemplate.lbl_message') }}</td>
                <td style="border:1px solid #ddd;padding:8px;color:#419641">{{ $mainContent['message'] }}</td>
            </tr>
        </tbody>
    </table>
@endsection
