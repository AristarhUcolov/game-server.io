<? 

if ($_POST["sendsms"]) { 
    $r = send_sms($_POST["phone"], "��� ��� �������������: ".ok_code($_POST["phone"])); 

    if ($r[1] > 0) 
        echo "��� ������������� ��������� �� ����� ".$_POST["phone"]; 
}

if ($_POST["ok"]) {
    $oc = ok_code($_POST["phone"]);

    if ($oc == $_POST["code"])
        echo "����� �����������";
    else
        echo "�������� ��� �������������";
}

function ok_code($s) {
    return hexdec(substr(md5($s."<��������� ������>"), 7, 5));
}
?>
