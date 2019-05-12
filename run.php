<?php
function randHpr($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function post($link){
	$post = str_replace("", "\r", '--07e256a4-312c-4228-bf8c-a1754a90bd23
Content-Disposition: form-data; name="post_type"
Content-Transfer-Encoding: binary
Content-Type: text/plain; charset=utf-8
Content-Length: 4

link
--07e256a4-312c-4228-bf8c-a1754a90bd23
Content-Disposition: form-data; name="uuid_user"
Content-Transfer-Encoding: binary
Content-Type: text/plain; charset=utf-8
Content-Length: 36

855d2509-0cd1-483d-82d4-21b88b2def91
--07e256a4-312c-4228-bf8c-a1754a90bd23
Content-Disposition: form-data; name="url_site"
Content-Transfer-Encoding: binary
Content-Type: text/plain; charset=utf-8
Content-Length: 27

'.$link.'
--07e256a4-312c-4228-bf8c-a1754a90bd23
Content-Disposition: form-data; name="key_id"
Content-Transfer-Encoding: binary
Content-Type: text/plain; charset=utf-8
Content-Length: 5

10843
--07e256a4-312c-4228-bf8c-a1754a90bd23
Content-Disposition: form-data; name="content"
Content-Transfer-Encoding: binary
Content-Type: text/utf8mb4; charset=utf-8
Content-Length: 27

'.$link.'
--07e256a4-312c-4228-bf8c-a1754a90bd23
Content-Disposition: form-data; name="geotag"
Content-Transfer-Encoding: binary
Content-Type: text/plain; charset=utf-8
Content-Length: 0


--07e256a4-312c-4228-bf8c-a1754a90bd23--');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://social.klikgo.club/klikgo-api/posts/status/write');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "".$post);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Content-Type: multipart/form-data;';
    $headers[] = 'boundary=07e256a4-312c-4228-bf8c-a1754a90bd23';
    $headers[] = 'Host: social.klikgo.club';
    $headers[] = 'Connection: close';
    $headers[] = 'Accept-Encoding: gzip, deflate';
    $headers[] = 'User-Agent: okhttp/3.12.1';
    $headers[] = 'SOCIAL-KLIKGO-KEY: 5b3ddd6ce21a748ca4238ac3f1e765e666d68a02c4e6d81e945e0142f51a4bec';
    $headers[] = 'SESSION-TOKEN: o2656nqgimjatcqsp28tnjlid215575672362726074';
    $headers[] = 'FCM-TOKEN: f2_jCidlpU4:APA91bF-bBouknhqnA_YJT03IbsmmRdGC2B9deKi1B7PWlQGOaGW_sZxz0oc9Q3TME7skPZ99-rN3dt5jAo0vp_pGVvCcb-o6jvNco-2X0pLtyfItQ3_5gQFPDHhBRXmc4fZZzy4aaGk';
    $headers[] = 'APP-VERSION: 18';

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    return $result;
}
$x = 1;
while(true)
{
	$link = 'http://yourls.org/'.randHpr(10);
	$aplot = post($link);
	if(strpos($aplot, '"rc":"00","rd":"Success Upload"') or preg_match('/Success/', $aplot))
	{
		print PHP_EOL."".$x.". success";
		$x++;
        sleep(1);
	} else if (strpos($aplot, 'Forbidden')){
		print PHP_EOL."".$x.". Forbidden, Wait 2 sec...";
		sleep(2);
	}else{
		print_r($aplot);
		print PHP_EOL."".$x.". Failed!";
	}
}

?>
