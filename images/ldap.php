<?php

$ldapserver = "ldap.technikum-wien.at";
$searchbase = "dc=technikum-wien,dc=at";

$ldap = ldap_connect($ldapserver);

if ($ldap){
  ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

  $dn = "uid=$usr,ou=People,$searchbase";
  $remote = @ldap_bind($ldap, $dn, $password_eingabe);

  if($remote) {
    $filter = "(&(uid=".$usr.")(objectClass=posixAccount))";
    $search = ldap_search($ldap, $searchbase, $filter);
    $result = ldap_get_entries($ldap, $search);

    @ldap_close($ldap);

    $vorname = $result[0]['givenname'][0];
    $nachname = $result[0]['sn'][0];
    $email = $result[0]['mail'][0];
    $_SESSION["logged-in-user"] = $usr;

    if($_POST['stay-logged-in' == true]) {
      // für 10 minuten automatisch eingeloggt bleiben          
      setcookie("username",$user_eingabe,time()+600); 
    }        
    return 0;
  }
}
?>