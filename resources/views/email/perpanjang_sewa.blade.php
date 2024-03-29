<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="style.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">

    <?php 
    $time = strtotime($rent->ended()->started_at);
    $started_at = date('d M Y',$time);
    $time = strtotime($rent->ended()->ended_at);
    $ended_at = date('d M Y',$time);
    ?>
    <!-- HIDDEN PREHEADER TEXT -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#0FB08F" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 20px 10px;"> 
                            <img src="https://i.postimg.cc/qg5NMQ2P/logo.png" width="150" height="130" style="display: block; border: 0px;" />
                        </td>
                    </tr>
                </table>

            </td>
            
        </tr>
        <tr>
            <td bgcolor="#0FB08F" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Arial;  line-height: 48px; margin: 2;">
                            <h1 style="font-size: 48px; font-weight: 700; ">Hallo, {{$rent->history->kostSeeker->first_name}} {{$rent->history->kostSeeker->last_name}} !</h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 20px 30px 10px 30px; color: #f51616; font-family: 'Lato', Helvetica, Arial, sans-serif; line-height: 25px;">
                            <p style="margin: 0; font-weight: 800; text-align:center;font-size: 18px;" >Penyewaan anda hampir mendekati batas durasi yang akan berakhir pada tanggal {{$ended_at}}</p>
                            <hr>
                        </td>
                    </tr>
                    <tr>                    
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#ffffff" align="center" style="">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td bgcolor="#ffffff" style="padding: 20px 30px 10px 30px; color: #f51616; font-family: 'Lato', Helvetica, Arial, sans-serif; line-height: 25px;">
                                                    <p style="margin: 0; font-weight: 800; text-align:center;font-size: 18px;" >Harap segera melakukan perpanjangan sewa jika akan memperpanjang penyewaan kamar kost ini</p>
                                                    <hr>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>                
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#ffffff" align="left" style="padding: 5px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 200; line-height: 25px;">
                                        <table>
                                            <tr align="left">
                                                <th>Rincian Pemesanan</th>
                                                <th></th>
                                            </tr>
                                            <tr align="left">
                                                <th>Nama Kost</th>
                                                <th>: {{$rent->room->kost->name}} </th>
                                            </tr>
                                            <tr align="left">
                                                <th>Tipe Kamar</th>
                                                <th>: {{$rent->room->roomType->name}} </th>
                                            </tr>
                                            <tr align="left">
                                                <th>Nama Kamar</th>
                                                <th>: {{$rent->room->name}} </th>
                                            </tr>
                                            <tr align="left">
                                                <th>Durasi Penyewaan</th>
                                                <th>: {{$rent->ended()->priceList->rentDuration->name}} </th>
                                            </tr>
                                            <tr align="left">
                                                <th>Jarak Penyewaan</th>
                                                <th>: {{$started_at}} - {{$ended_at}}</th>
                                            </tr>
                                            <tr align="left">
                                                <th>Total Biaya</th>
                                                <th>: {{Helper::rupiah($rent->ended()->total_price)}} </th>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
                    
                </table>
                
                
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#0FB08F" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Terima kasih telah mempercayakan kost kami</h2><br>
                            <img src="https://i.postimg.cc/tCXWkMJ4/logo.png" width="150" height="130" style="display: block; border: 0px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
