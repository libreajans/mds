<?php

function mds($key,$level = 0)
{
  /******************************************************************
  *
  * Tayland, Songkhala'da 2013 yılında yazılmıştır.
  * 
  * http://randomkeygen.com sitesi ile random key oluşturuyorum :)
  *
  * @Level değeri
  * md5 yapılmış şifreleri
  * mds şekline dönüştürmek için kullanılır
  *
  * Tek farkı, ilk aşamadaki key değerini md5 yapmak yerine, 
  * yapılmış haliyle kullanmasıdır
  *
  * 
  * 
  * en son aşamada md5 kullanılmasının amacı çıktıyı normal bir
  * md5 çıktısıymış gibi göstermektir
  *
  *******************************************************************/

  $salt0 	= 'XvX0kGeG:4{05g9%ijnX4Z7kT^Ia3Hc'; //hash 1
  $salt1 	= 'jBCFQiaEm(PM06(i511uKM99Ooos7J['; //hash 2
  $salt2 	= '7!8FBkeEM]bzWYoI?{qK{C/HC)wO70y'; //hash 3
  $s0 	= md5($salt0);
  $s1 	= md5($salt1);
  $s2 	= md5($salt2);
  if($level == 1 )
  {
    $f0 	= $key.md5($s0);
  }
  else
  {
    $f0 	= md5($key).md5($s0);
  }
  $f0 	= md5($f0);

  //aşama 1
  $f1 = hash('sha1', 		$s0.$f0);
  //aşama 2
  $f2 = hash('sha256', 	$s1.$f1);
  //aşama 3
  $f3 = hash('sha512', 	$s2.$f2);
  //aşama 2 ters
  $f2 = hash('sha256', 	$s1.$f3);
  //aşama 1 ters
  $f1 = hash('sha1', 		$s0.$f2);
  //sadece maskeleme
  $f0 = hash('md5', 		$s2.$f1);

  return $f0;
}
