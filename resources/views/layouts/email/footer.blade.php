<?php
$email = 'news@eliteproxy.co.id';

?>

<tr>
    <td colspan="4">
        <hr />
    </td>
</tr>
<tr>
    <td style="font-size: 11px !important; color: grey !important;" colspan="4" align="center">
        <a href="{{ url('/' . config('appConfig.app.link.privacy_policy')) }}">Kebijakan Privasi</a> | <a
            href="{{ url('/' . config('appConfig.app.link.terms_condition')) }}">Syarat Layanan</a>
        <br>
        Ini adalah email otomatis. Mohon untuk tidak membalas email ini.<br>
        Tambahkan {{ $email }} pada daftar kontak untuk memastikan email dari {{ config('appConfig.app.name')}} masuk ke
        inbox-mu.<br>
        {{ config('appConfig.app.company_address') }}
    </td>
</tr>
</tbody>
</table>
