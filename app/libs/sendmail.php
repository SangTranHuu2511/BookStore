<?php
function xl_sendmail($to_email,$subject,$content)
{
    $message = "<p>Vui lòng bấm vào link bên dưới để kích hoạt tài khoản.</p>";
    $message .= '<p><a href='.$content.' target="_blank">'.$content.'</a></p>';
    $header = "From:trieuntgvt3h@gmail.com \r\n";
    $header = "Cc:nguyenthanhtrieu8x@gmail.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html; charset=UTF-8\r\n";

    $retval = mail ($to_email,$subject,$message,$header);
    if($retval)
    {
      return TRUE;
    }
    return FALSE;
}
?>