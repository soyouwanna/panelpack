<!DOCTYPE html>
<html lang="ro">
<head>
    <title>Confirmare email</title>
</head>
<body>
<style type="text/css">
.link_div{
    min-height:50px;
    width:50%;
    text-align: center;
    padding: 20px 0;
    margin: 30px auto;
    border: 1px solid royalblue;
}
.top{
    text-align: center;
}
.top h3{
    color: royalblue;
}
</style>

<div class="top">
    <h3>Salut, {{ $customerName }}</h3>
    <p>Iti multumim pentru inscrierea pe site-ul {{ $site_settings['site_name'] }}</p>
</div>

<div class="link_div">
    <p>Te rugam sa accesezi urmatorul link pentru a confirma adresa de mail:</p>
    <p><a href="{{ url('customer/confirmemail', $emailToken) }}" target="_blank">Confirma email</a></p>
    <br>
    <br>
    <p>Daca nu poti accesa linkul de mai sus, copiaza codul de mai jos (Ctrl+C) in url-ul browser-ului:</p>
    <p>{{ url('customer/confirmemail', $emailToken) }}</p>
    <br>
    <p>Cu multa consideratie,</p>
    <p>Echipa {{ $site_settings['site_name'] }}</p>
</div>
</body>
</html>