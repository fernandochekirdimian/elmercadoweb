<?php
require_once 'resources/connectDb.php';
$DB->SetFetchMode(ADODB_FETCH_ASSOC);
$data = $_REQUEST;
$cliente = $DB->Execute('SELECT * FROM clientes WHERE mail = ? AND passwd = ?', array($data['reg-mail'], sha1($data['reg-pass'])));
echo json_encode($cliente->fields);

